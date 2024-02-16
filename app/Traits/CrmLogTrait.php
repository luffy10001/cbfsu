<?php

namespace App\Traits;

use App\Models\CrmLog;
use Illuminate\Support\Facades\Log;

trait CrmLogTrait
{

    public static function createCrmLog($reference_id,$new_reference_id,$model_name,$log_action,$old_data,$new_data,$action='create', $old_json_data = '{}', $new_json_data = '{}' )
    {
        try {
            $old_data   =   json_decode($old_data);
            if (!empty($old_data->_token)){
                unset($old_data->_token);
            }
            $new_data   =   json_decode($new_data);
            if (!empty($new_data->_token)){
                unset($new_data->_token);
            }
            $log=  CrmLog::create([
                'user_id'               =>  auth()->user()->id??0,
                'reference_id'          =>  $reference_id,
                'new_reference_id'      =>  $new_reference_id,
                'model_name'            =>  $model_name,
                'log_action'            =>  $log_action,
                'action'                =>  $action,
                'old_data'              =>  json_encode($old_data),
                'new_data'              =>  json_encode($new_data),
                'old_json_data'         =>  $old_json_data,
                'new_json_data'         =>  $new_json_data,
            ]);
        }
        catch (\Exception $ex){
        }

    }
}