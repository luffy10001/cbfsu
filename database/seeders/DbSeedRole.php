<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Permission;
use App\Models\Role;
use App\Models\TaskAgency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class DbSeedRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('slug','super-admin')->first();
        if ($role){

        } else {
            $role = Role::create([
                'name'          =>  'SuperAdmin',
                'parent_id'     =>  0,
                'slug'          =>  'super-admin'
            ]);
        }

        $routes =  Route::getRoutes();
        $groups =  [];
        foreach($routes as $value){
            if (!empty($value->action['groupName'])){
                $types      =   is_array($value->action['groupName'])?$value->action['groupName']:[$value->action['groupName']];
                $new_types  =   $types[count($types)-1];

                $permission =   Permission::where('role_id',$role->id)
                    ->where('route_name',$value->action['as'])->first();
                if (!$permission){
                    Permission::create([
                        'route_name'    =>  $value->action['as'],
                        'role_id'       =>  $role->id,
                        'is_active'     =>  1
                    ]);
                }
            }
        }
    }
}
