<?php

namespace Database\Seeders;

use App\Models\TaskSubType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSubTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private $datas = [
        [
            'sub_type_name' => 'Introduction',
            'task_type_id' => '1',
        ],
        [
            'sub_type_name' => 'Follow up',
            'task_type_id' => '1',
        ],
        [
            'sub_type_name' => 'Listings Leech',
            'task_type_id' => '1',
        ],[
            'sub_type_name' => 'Renewal',
            'task_type_id' => '1',
        ],[
            'sub_type_name' => 'Upsell',
            'task_type_id' => '1',
        ],[
            'sub_type_name' => 'Payment',
            'task_type_id' => '1',
        ],[
            'sub_type_name' => 'Agency Verification Call',
            'task_type_id' => '1',
        ],[
            'sub_type_name' => 'Listing Verification Call',
            'task_type_id' => '1',
        ],[
            'sub_type_name' => 'Inter Departmental CAll',
            'task_type_id' => '1',
        ],[
            'sub_type_name' => 'Others',
            'task_type_id' => '1',
        ],[
            'sub_type_name' => 'Welcome Call',
            'task_type_id' => '1',
        ],[
            'sub_type_name' => 'Credit Utilization Call',
            'task_type_id' => '1',
        ],[
            'sub_type_name' => 'Survey Call',
            'task_type_id' => '1',
        ],[
            'sub_type_name' => 'Coaching/Guidance Call',
            'task_type_id' => '1',
        ],[
            'sub_type_name' => 'Query',
            'task_type_id' => '2',
        ],
        [
            'sub_type_name' => 'Others',
            'task_type_id' => '2',
        ],
        [
            'sub_type_name' => 'Agency Visit',
            'task_type_id' => '3',
        ],[
            'sub_type_name' => 'Walk in',
            'task_type_id' => '3',
        ],[
            'sub_type_name' => 'Renewal',
            'task_type_id' => '3',
        ],[
            'sub_type_name' => 'Upsell',
            'task_type_id' => '3',
        ],[
            'sub_type_name' => 'Agency Visit for Media',
            'task_type_id' => '3',
        ],
        [
            'sub_type_name' => 'Property Visit for Media',
            'task_type_id' => '3',
        ],
        [
            'sub_type_name' => 'Others',
            'task_type_id' => '3',
        ],
        [
            'sub_type_name' => 'Request for Virtual Tour 360',
            'task_type_id' => '3',
        ],
    ];

    public function run()
    {
        foreach ($this->datas as $data) {
            $task_types = TaskSubType::where('sub_type_name', $data['sub_type_name'])
                ->where('task_type_id',$data['task_type_id'])->first();
            if (!$task_types) {
                TaskSubType::insert($data);
            }

        }

        $task_types = TaskSubType::where('sub_type_name', 'New Package')
            ->where('task_type_id',3)->first();
        if (!$task_types) {
            TaskSubType::insert([
                'sub_type_name' => 'New Package',
                'task_type_id' => '3',
            ]);
        }
        $task_types = TaskSubType::where('sub_type_name', 'Property request for GPT')
            ->where('task_type_id',3)->first();
        if (!$task_types) {
            TaskSubType::insert([
                'sub_type_name' => 'Property request for GPT',
                'task_type_id' => '3',
            ]);
        }



    }
}
