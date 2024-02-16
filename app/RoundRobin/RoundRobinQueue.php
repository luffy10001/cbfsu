<?php

namespace App\RoundRobin;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RoundRobinQueue
{
    public static function create($queueName,$areaId,$userIds=[])
    {

        $fileQueueName = $queueName."_queue_".$areaId;
        $currentIndex = 0;
        $lastAssignUser = 0;
        $newIndex = 0;
        $userId = 0;
        $oldData    =   (file_exists(storage_path($fileQueueName)))?json_decode(file_get_contents(storage_path($fileQueueName))):new \stdClass();
        if (!file_exists(storage_path($fileQueueName)) || !isset($oldData->currentIndex) ){
            $lastAssignUser =   $userIds[$currentIndex];
            $newIndex =0;
            $userId = $lastAssignUser;
            $file  = fopen(storage_path($fileQueueName),'w+');
            fwrite($file,json_encode([
                'currentIndex'  =>  $currentIndex,
                'lastAssignUser' => $lastAssignUser
            ]));
        } else{
            $oldData    =   json_decode(file_get_contents(storage_path($fileQueueName)));

            $userId = ($oldData->currentIndex >= (count($userIds)-1) )? $userIds[0]:$userIds[$oldData->currentIndex+1];
            //$newIndex = ($oldData->currentIndex >= (count($userIds)-1) )?0:$oldData->currentIndex+1;
            $newIndex = ($oldData->currentIndex + 1) % count($userIds);
            $oldData->lastAssignUser = $userId;
            $oldData->currentIndex = $newIndex;
            $file  = fopen(storage_path($fileQueueName),'w+');
            fwrite($file,json_encode($oldData));
        }

       return [
           'currentIndex'   =>  $newIndex,
           'userId'         =>  $userId
       ];
    }
}