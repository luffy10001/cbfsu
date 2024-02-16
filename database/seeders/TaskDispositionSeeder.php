<?php

namespace Database\Seeders;

use App\Models\TaskDisposition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskDispositionSeeder extends Seeder
{
    private $datas = [
        [
            'disposition_name' => 'Call',
            'parent_id' => '0',
        ], [
            'disposition_name' => 'Call In',
            'parent_id' => '0',
        ], [
            'disposition_name' => 'General',
            'parent_id' => '0',
        ], [
            'disposition_name' => 'Concerns',
            'parent_id' => '0',
        ], [
            'disposition_name' => 'Complaints',
            'parent_id' => '0',
        ], [
            'disposition_name' => 'Requests',
            'parent_id' => '0',
        ], [
            'disposition_name' => 'Actions',
            'parent_id' => '0',
        ], [
            'disposition_name' => 'Media Coverage',
            'parent_id' => '0',
        ], [
            'disposition_name' => 'Listing Leech',
            'parent_id' => '0',
        ], [
            'disposition_name' => 'Unavailability',
            'parent_id' => '0',
        ], [
            'parent_id' => '1',
            'disposition_name' => 'Number busy',
        ], [

            'disposition_name' => 'Not answering',
            'parent_id' => '1',
        ], [
            'disposition_name' => 'Number switched off',
            'parent_id' => '1',

        ], [
            'disposition_name' => 'Invalid number',
            'parent_id' => '1',

        ], [
            'disposition_name' => 'Wrong number',
            'parent_id' => '1',

        ], [
            'disposition_name' => 'Voice/Distortion issue',
            'parent_id' => '1',

        ], [
            'disposition_name' => 'Client busy - Will contact by himself',
            'parent_id' => '1',

        ],
        [
            'disposition_name' => 'Call hung up',
            'parent_id' => '1',

        ], [
            'disposition_name' => 'Client does not want to talk',
            'parent_id' => '1',

        ],
        [
            'disposition_name' => 'Voice/Distortion issue',
            'parent_id' => '2',

        ], [
            'disposition_name' => 'Call hung up',
            'parent_id' => '2',

        ], [
            'disposition_name' => 'General inquiry',
            'parent_id' => '3',

        ], [
            'disposition_name' => 'Client satisfied having no issue',
            'parent_id' => '3',

        ], [
            'disposition_name' => 'Others',
            'parent_id' => '3',

        ],
        [
            'disposition_name' => 'Website concern',
            'parent_id' => '4',

        ],
        [
            'disposition_name' => 'Mobile App concern',
            'parent_id' => '4',

        ],
        [
            'disposition_name' => 'Wrong posting concern',
            'parent_id' => '4',

        ],
        [
            'disposition_name' => 'Commitment concern',
            'parent_id' => '4',

        ],
        [
            'disposition_name' => 'Listing response concern',
            'parent_id' => '4',

        ],
        [
            'disposition_name' => 'Agency Logo concern',
            'parent_id' => '4',

        ],
        [
            'disposition_name' => 'Images delay concern',
            'parent_id' => '4',

        ],
        [
            'disposition_name' => 'Posting delay concern',
            'parent_id' => '4',

        ],
        [
            'disposition_name' => 'Listing quota concern',
            'parent_id' => '4',

        ],
        [
            'disposition_name' => 'Credit assignment concern',
            'parent_id' => '4',

        ],
        [
            'disposition_name' => 'listings posting concern',
            'parent_id' => '4',

        ],
        [
            'disposition_name' => 'listings ranking concern',
            'parent_id' => '4',

        ],
        [
            'disposition_name' => 'AM related concern',
            'parent_id' => '4',

        ], [
            'disposition_name' => 'Accounts related concern',
            'parent_id' => '4',

        ], [
            'disposition_name' => 'Does not want to work with Graana',
            'parent_id' => '5',

        ], [
            'disposition_name' => 'Not happy with services',
            'parent_id' => '5',

        ], [
            'disposition_name' => 'Wants to talk to seniors',
            'parent_id' => '5',

        ], [
            'disposition_name' => 'Listing edit request',
            'parent_id' => '6',


        ], [
            'disposition_name' => 'Listing removal request',
            'parent_id' => '6',

        ], [
            'disposition_name' => 'Package info request',
            'parent_id' => '6',

        ], [
            'disposition_name' => 'Package upgrade request',
            'parent_id' => '6',

        ], [
            'disposition_name' => 'Package renewal request',
            'parent_id' => '6',

        ], [
            'disposition_name' => 'Photo session  request',
            'parent_id' => '6',

        ], [
            'disposition_name' => 'Videography request',
            'parent_id' => '6',

        ], [
            'disposition_name' => 'Credits purchase request',
            'parent_id' => '6',

        ], [
            'disposition_name' => 'Profile update request',
            'parent_id' => '6',

        ], [
            'disposition_name' => 'Password reset request',
            'parent_id' => '6',

        ], [
            'disposition_name' => 'Account Close request',
            'parent_id' => '6',

        ], [
            'disposition_name' => 'Credentials request',
            'parent_id' => '6',

        ], [
            'disposition_name' => 'AM meeting request',
            'parent_id' => '6',

        ], [
            'disposition_name' => 'Training request',
            'parent_id' => '6',

        ], [
            'disposition_name' => 'Individual account created',
            'parent_id' => '7',

        ], [
            'disposition_name' => 'Agency account created',
            'parent_id' => '7',

        ], [
            'disposition_name' => 'Profile updated',
            'parent_id' => '7',

        ], [
            'disposition_name' => 'Callback scheduled',
            'parent_id' => '7',

        ], [
            'disposition_name' => 'Videography reschedule',
            'parent_id' => '7',

        ], [
            'disposition_name' => 'Photo session reschedule',
            'parent_id' => '7',

        ], [
            'disposition_name' => 'Services blocked',
            'parent_id' => '7',

        ], [
            'disposition_name' => 'Media captured',
            'parent_id' => '8',

        ], [
            'disposition_name' => 'Media copied',
            'parent_id' => '8',

        ], [
            'disposition_name' => 'Property not accessible',
            'parent_id' => '8',

        ], [
            'disposition_name' => 'No listings',
            'parent_id' => '9',

        ], [
            'disposition_name' => 'Will post listing by himself',
            'parent_id' => '9',

        ], [
            'disposition_name' => 'Listings received',
            'parent_id' => '9',

        ], [
            'disposition_name' => 'Listings received via whatsapp',
            'parent_id' => '9',

        ], [
            'disposition_name' => 'Listings received via email',
            'parent_id' => '9',

        ], [
            'disposition_name' => 'New listings posted',
            'parent_id' => '9',

        ], [
            'disposition_name' => 'Pending listing confirmation',
            'parent_id' => '9',

        ], [
            'disposition_name' => 'Concern person not available',
            'parent_id' => '10',

        ], [
            'disposition_name' => 'Contacted person does not belong to agency',
            'parent_id' => '10',

        ], [
            'disposition_name' => 'User left agency',
            'parent_id' => '10',

        ], [
            'disposition_name' => 'Left property business',
            'parent_id' => '10',

        ],


    ];

    public function run()
    {
        foreach ($this->datas as $data) {
            $task_disposition = TaskDisposition::where('disposition_name', $data['disposition_name'])
                ->where('parent_id', $data['parent_id'])->first();
            if (!$task_disposition) {
                TaskDisposition::insert($data);
            }

        }
    }
}
