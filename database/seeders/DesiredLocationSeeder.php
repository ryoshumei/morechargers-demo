<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\ChargerType;
use App\Models\DesiredLocation;
use App\Models\ProviderCompany;
use App\Models\VehicleModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesiredLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //create 50 DesiredLocation instances with random data but with existing brand_id and vehicle_model_id values
         DesiredLocation::factory()->count(50)->create()->each(function ($desiredLocation){
             $desiredLocation->brand_id = Brand::inRandomOrder()->first()->id;
             $desiredLocation->model_id = VehicleModel::inRandomOrder()->first()->id;
             $desiredLocation->charger_type_id = ChargerType::inRandomOrder()->first()->id;
             // 通过 ChargerType 获取相关的 ProviderCompany
             $providerCompany = ChargerType::find($desiredLocation->charger_type_id)
                 ->providerCompanies()
                 ->inRandomOrder()
                 ->first();

             // 检查是否找到匹配的 ProviderCompany 记录
             if ($providerCompany) {
                 $desiredLocation->provider_company_id = $providerCompany->id;
             }
             $desiredLocation->save();
         });
    }
}
