<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\VehicleModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::factory()->count(10)->create()->each(function ($brand){
            $brand->vehicleModels()->saveMany(VehicleModel::factory()->count(5)->make());
        });
    }
}
