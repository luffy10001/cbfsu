<?php

namespace Database\Seeders;

use App\Models\PackageAddon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;


class PackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        $jsonData = file_get_contents(database_path('seeders/crm_package_addons.json'));
        $data = json_decode($jsonData, true);
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            die('Error decoding JSON: ' . json_last_error_msg());
        }
        if($data){
            foreach ($data as $addon) {
                $data = [
                    'id' => $addon['id'],
                    'name' => $addon['name'],
                    'type' => $addon['type'],
                    'min' => $addon['min'],
                    'max' => $addon['max'],
                    'is_active' => $addon['is_active'],
                    'is_addone' => $addon['is_addone'],
                    'price' => $addon['price'],
                    'is_strip' => $addon['is_strip'],
                    'only_for_agency' => $addon['only_for_agency'],
                    'addon_type' => $addon['addon_type'],
                    'description' => $addon['description'],
                ];
                $obj = PackageAddon::where('name', $addon['name'])->first();
                if ($obj) {
                    $obj->update(
                        [
                            'id' => $addon['id'],
                            'type' => $addon['type'],
                        ]
                    );
                }else{
                    PackageAddon::insert($data);
                }
            }
        }
    }
}
