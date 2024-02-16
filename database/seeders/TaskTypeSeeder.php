<?php

namespace Database\Seeders;

use App\Models\TaskType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskTypeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */

    private $datas = [
        [
            'type_name' => 'Call',
        ],
        [
            'type_name' => 'Call In',
        ],
        [
            'type_name' => 'Meeting',
        ],
        [
            'type_name' => 'Market Survey',
        ],

    ];

    public function run()
    {
        foreach ($this->datas as $data) {
            $task_types = TaskType::where('type_name', $data['type_name'])->first();
            if (!$task_types) {
                TaskType::insert($data);
            }

        }
    }
}
