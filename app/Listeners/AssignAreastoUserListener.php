<?php

namespace App\Listeners;

use App\Http\Controllers\UserAreaZoneController;
use App\Models\Area;
use App\Models\UserArea;
use App\Models\UserCity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AssignAreastoUser;
use Illuminate\Support\Facades\Log;

class AssignAreastoUserListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AssignAreastoUser $event): void
    {
        $user = $event->user;
        if($user->department_id == 2 || $user->role_id==7) {
            $UserCity = TableName(UserCity::class);
            $Area = TableName(Area::class);
            $objs = UserCity::from($UserCity . " as " . $UserCity)
                ->leftJoin($Area . " as " . $Area, $UserCity . '.city_id', '=', $Area . '.cityId')
                ->select($Area . '.cityId' ,$Area . '.id as area_id', $UserCity . '.user_id as user_id','region_id as region_id','city_id as city_id')
                ->where('user_id',$user->id)
                ->get();
            if($objs){
                $inserted_cities = [];
                foreach($objs as $obj){
                    if(!UserArea::where(['user_id' => $obj->user_id,'city_id' => $obj->city_id,'area_id' => $obj->area_id])->exists()){
                        if($obj->area_id){
                            $data = [
                                'user_id'  => $obj->user_id,
                                'area_id'  => $obj->area_id,
                                'city_id'  => $obj->city_id,
                                'region_id' => $obj->region_id,
                                'zone_id'  => 0,
                            ];
                            UserArea::insert($data);
                        }
                    }
                    $inserted_cities[] = $obj->city_id;
                }
                $user_areas =   UserArea::whereNotIn('city_id',count($inserted_cities)>0?$inserted_cities:[-1])
                    ->where('user_id',$user->id)->get();
               UserAreaZoneController::removeAreaFromUser($user_areas,$user->id,[]);
            }
        }
    }
}
