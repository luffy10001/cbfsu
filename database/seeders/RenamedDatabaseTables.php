<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RenamedDatabaseTables extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $tables = [
            'failed_jobs',
            'personal_access_tokens',
            'departments',
            'permissions',
            'migrations',
            'password_reset_tokens',
            'roles',
            'task_types',
            'task_sub_types',
            'task_dispositions',
            'packages_items',
            'task_statuses',
            'contracts',
            'packages',
            'package_addons',
            'areas',
            'contracts_package_items',
            'users',
            'user_areas',
            'regions',
            'cities',
            'notifications',
            'agency_areas',
            'agency_poc_attachements',
            'agency_attachments',
            'zones',
            'payments',
            'contracts_quotas',
            'user_agency_logs',
            'user_area_logs',
            'task_reviews',
            'agencies',
            'app_notifications',
            'agency_point_of_contracts',
            'tasks',
            'app_logs',
            'task_agencies',
            'propertyReview'

        ];

        foreach ($tables as $row) {
            try {
                $tableName = str_replace('crm_', '', $row);

               /* $sql = "alter table public." . $tableName . " rename to crm_" . $tableName . ";";
                DB::statement($sql);*/
            } catch (\Exception $ex) {}
        }
        /* config()->set('database.connections.pgsql.prefix','crm_');*/

    }
}
