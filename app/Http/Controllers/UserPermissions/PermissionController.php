<?php

namespace App\Http\Controllers\UserPermissions;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class PermissionController extends Controller
{

    public function getPermissions(Request $request,$roleId){
        $role = Role::find($roleId);
        $access ='';
        $routes =collect(Route::getRoutes())->filter(function ($value,$key)use($access){
            if (!empty($value->action['access'])){
                $routePermission  = $value->action['access'];
                return ((str_contains($routePermission,'all')) || str_contains($routePermission ,$access));
            }
        });
        $groups     =   [];
        foreach($routes as $value){
            if (!empty($value->action['groupName'])){
                $types      =   is_array($value->action['groupName'])?$value->action['groupName']:[$value->action['groupName']];
                $new_types  =   $types[count($types)-1];
                $groups[$new_types][]   =   [
                    'types'     =>  $new_types,
                    'route'     =>  $value->action['as']??'',
                    'method'    =>  $value->methods()[0]??'GET'
                ];
            }
        }

        return view('permissions.permissions',compact('role','groups'));
    }
    public function  store(Request $request)
    {
        $permissions    =   $request['permissions'];
        foreach ($permissions as $row){
            $roleId     =   $row['roleId'];
            $permission =   $row['permission'];
            $isChecked  =   $row['isChecked'];

            $permission_obj    =   Permission::where('role_id',$roleId)
                ->where('route_name',$permission)
                ->first();
            $data   =   [
                'role_id'           =>  $roleId,
                'route_name'              =>  $permission,
                'is_active'         =>  $isChecked
            ];
            if ($permission_obj){
                $permission_obj->update($data);
            }else {
                Permission::create($data);
            }
            try {
                Artisan::call('cache:clear');
                Log::info('Cache cleared successfully on permission change.');
            } catch (\Exception $e) {
                Log::info('Error clearing cache on permission change: ' . $e->getMessage());
            }
        }
        return response()->json([
            'success'       =>  true,
            'message'       =>  'Success'
        ],200);
    }
}
