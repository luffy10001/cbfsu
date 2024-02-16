<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    private $datas = [
        [
            'status_name' => 'Open',

        ], [
            'status_name' => 'Started',

        ], [
            'status_name' => 'Pending - Accounts',

        ], [
            'status_name' => 'Pending - Operations',

        ], [
            'status_name' => 'Pending - Sales',

        ], [
            'status_name' => 'Pending - Client',

        ], [
            'status_name' => 'Escalated to Manager',

        ],[
            'status_name' => 'Closed - Done',

        ],[
            'status_name' => 'Closed - Not Done',

        ],


    ];

    public function run()
    {
        foreach ($this->datas as $data) {
            $task_status = TaskStatus::where('status_name', $data['status_name'])->first();
            if (!$task_status) {
                TaskStatus::insert($data);
            }

        }
    }
}
