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
        try {
            $user = User::where('email', 'admin@gmail.com')->first();
            if (!$user) {
                \App\Models\User::factory()->create([
                    'name' => 'Test User',
                    'email' => 'admin@gmail.com',
                    'role_id' => 1,
                    'status' => true,
                    'password' => Hash::make('12345678')
                ]);
            }
        } catch (Exception $ex) {

        }
    }
}
