<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RenamedNotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $sql = "alter table public.crm_notifications rename to app_notifications;";
        $sql1 = "alter table public.crm_logs rename to app_logs;";
        try{
            DB::statement($sql);

        }
        catch (\Exception $ex){

        }
        try{
            DB::statement($sql1);
        }
        catch (\Exception $ex){

        }

    }
}
