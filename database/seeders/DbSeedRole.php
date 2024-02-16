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
                'department_id' =>  0,
                'slug'          =>  'super-admin'
            ]);
        }
        $admin_sales = Role::where('slug','admin-sales')->first();
        if ($admin_sales){

        } else {
            $admin_sales = Role::create([
                'name'          =>  'Admin Sales',
                'parent_id'     =>  0,
                'department_id' =>  1,
                'slug'          =>  'admin-sales'
            ]);
        }

        $admin_operations = Role::where('slug','admin-operations')->first();
        if ($admin_operations){

        } else {
            $admin_operations = Role::create([
                'name'          =>  'Admin Operations',
                'parent_id'     =>  0,
                'department_id' =>  2,
                'slug'          =>  'admin-operations'
            ]);
        }

        $area_manager_sales = Role::where('slug','area-manager-sales')->first();
        if ($area_manager_sales){

        } else {
            $area_manager_sales = Role::create([
                'name'          =>  'Area Manager Sales',
                'parent_id'     =>  0,
                'department_id' =>  1,
                'slug'          =>  'area-manager-sales'
            ]);
        }

        $account_manager = Role::where('slug','account-manager')->first();
        if ($account_manager){

        } else {
            $account_manager = Role::create([
                'name'          =>  'Account Manager',
                'parent_id'     =>  4,
                'department_id' =>  1,
                'slug'          =>  'account-manager'
            ]);
        }

        $telesales = Role::where('slug','telesales')->first();
        if ($telesales){

        } else {
            $telesales = Role::create([
                'name'          =>  'Telesales',
                'parent_id'     =>  4,
                'department_id' =>  1,
                'slug'          =>  'telesales'
            ]);
        }

        $finance_hq = Role::where('slug','finance-hq')->first();
        if ($finance_hq){

        } else {
            $finance_hq = Role::create([
                'name'          =>  'Finance HQ',
                'parent_id'     =>  0,
                'department_id' =>  1,
                'slug'          =>  'finance-hq'
            ]);
        }

        $area_manager_operations = Role::where('slug','area-manager-operations')->first();
        if ($area_manager_operations){

        } else {
            $area_manager_operations = Role::create([
                'name'          =>  'Area Manager Operations',
                'parent_id'     =>  0,
                'department_id' =>  2,
                'slug'          =>  'area-manager-operations'
            ]);
        }

        $agency_approver = Role::where('slug','agency-approver')->first();
        if ($agency_approver){

        } else {
            $agency_approver = Role::create([
                'name'          =>  'Agency Approver',
                'parent_id'     =>  8,
                'department_id' =>  2,
                'slug'          =>  'agency-approver'
            ]);
        }

        $leech_caller = Role::where('slug','leech-caller')->first();
        if ($leech_caller){

        } else {
            $leech_caller = Role::create([
                'name'          =>  'Leech Caller',
                'parent_id'     =>  8,
                'department_id' =>  2,
                'slug'          =>  'leech-caller'
            ]);
        }

        $package_selector = Role::where('slug','package-selector')->first();
        if ($package_selector){

        } else {
            $package_selector = Role::create([
                'name'          =>  'Package Selector',
                'parent_id'     =>  8,
                'department_id' =>  2,
                'slug'          =>  'package-selector'
            ]);
        }

        $media_associate_rider = Role::where('slug','media-associate-rider')->first();
        if ($media_associate_rider){

        } else {
            $media_associate_rider = Role::create([
                'name'          =>  'Media associate-Rider',
                'parent_id'     =>  8,
                'department_id' =>  2,
                'slug'          =>  'media-associate-rider'
            ]);
        }

        $data_entry = Role::where('slug','data-entry')->first();
        if ($data_entry){

        } else {
            $data_entry = Role::create([
                'name'          =>  'Data Entry',
                'parent_id'     =>  8,
                'department_id' =>  2,
                'slug'          =>  'data-entry'
            ]);
        }

        $listing_reviewer = Role::where('slug','listing-reviewer')->first();
        if ($listing_reviewer){

        } else {
            $listing_reviewer = Role::create([
                'name'          =>  'Listing Reviewer',
                'parent_id'     =>  8,
                'department_id' =>  2,
                'slug'          =>  'listing-reviewer'
            ]);
        }

        $routes =Route::getRoutes();
        $groups     =   [];
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

        $sale_rules =   [
            'account-manager','telesales'
        ];
        foreach ($sale_rules as $row){
            $role = Role::where('slug',$row)
                ->where('parent_id',0)
                ->first();
            if ($role){
                $role->update([
                    'parent_id' =>  4
                ]);
            }
        }
        $operation_rules =   [
            'listing-reviewer',
            'data-entry',
            'media-associate-rider',
            'package-selector',
            'leech-caller',
            'agency-approver'
        ];

        foreach ($operation_rules as $row){
            $role = Role::where('slug',$row)
                ->where('parent_id',0)
                ->first();
            if ($role){
                $role->update([
                    'parent_id' =>  8
                ]);
            }
        }

        $role   =   Role::where('slug','area-manager-operations')->first();
        if ($role){
            $role->update([
                'parent_id' =>  3
            ]);
        }
        $role   =   Role::where('slug','area-manager-sales')->first();
        if ($role){
            $role->update([
                'parent_id' =>  2
            ]);
        }


        $sql = "select table_name from information_schema.tables
where table_schema not in ('information_schema', 'pg_catalog') and
    table_type = 'BASE TABLE'";
        $results = DB::select($sql);
        foreach ($results as $row){

            $sql2="SELECT setval('".$row->table_name."_id_seq', (SELECT MAX(id) FROM ".$row->table_name."));";
            try {
                DB::statement($sql2);
            }
            catch (\Exception $ex){

            }
        }

        $taskAgencies = TaskAgency::whereNull('area_id')->get();
        foreach ($taskAgencies as $agency){
            $agency_new = Agency::find($agency->agency_id);
            $agency->update([
                'area_id'   =>  $agency_new->area_id??0
            ]);
        }
    }
}
