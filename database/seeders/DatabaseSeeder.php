<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\TaskDisposition;
use App\Models\TaskType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DbSeedRole::class);
        $this->call(TaskDispositionSeeder::class);
        $this->call(TaskStatusSeeder::class);
        $this->call(TaskSubTypeSeeder::class);
        $this->call(TaskTypeSeeder::class);
        /*$this->call(PackagesSeeder::class);*/
        $this->call(DepartmentSeeder::class);

        $this->call(RenamedNotificationsSeeder::class);
        $this->call(RenamedDatabaseTables::class);
        /*$this->call(CloudinaryUpdateSeeder::class);*/
        /*$this->call(PackagesSeeder::class);*/
        // \App\Models\User::factory(10)->create();

        try {
            $user = User::where('email', 'admin@gmail.com')->first();
            if (!$user) {
                \App\Models\User::factory()->create([
                    'name' => 'Test User',
                    'email' => 'admin@gmail.com',
                    'account_status' => 'active',
                    'password' => Hash::make('12345678')
                ]);
            }
        } catch (Exception $ex) {

        }
        /*$taskTypes = TaskType::whereIn('type_name', ['Call (Only available for Call Type)',
            'Call In (Only available for Call Type)'])->get();

        $disps =['Call', 'Call In'];
        foreach ($taskTypes as $key=> $type){
            $type->update([
                'type_name' =>  $disps[$key]
            ]);
        }*/
        $taskTypes = TaskType::whereIn('type_name', ['Call', 'Call In'])->get();
        $disp = [
            'Call',
            'Call In'
        ];
        foreach ($taskTypes as $key => $type) {
            $typeId = $type->id;
            $task_disposition = TaskDisposition::where('disposition_name', $disp[$key])->first();
            if ($task_disposition) {
                $parentDispositionId = $task_disposition->id;

                $task_disposition->update([
                    'task_type_id' => $typeId
                ]);

                $subDispositions = TaskDisposition::where('parent_id', $parentDispositionId)->get();
                foreach ($subDispositions as $disposition) {
                    $disposition->update([
                        'task_type_id' => $typeId
                    ]);
                }

            }
        }
    }
}
