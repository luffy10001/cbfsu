<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            'Sales', 'Operations'
        ];
        foreach ($datas as $row) {
            $department = Department::where('name',$row)->first();
            if (!$department){
                Department::create(['name' => $row]);
            }
        }
    }
}
