<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProviderCompany;
use App\Models\ChargerType;

class ProviderCompanyChargerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 创建一些 ProviderCompany 实例
        $providerCompanies = ProviderCompany::factory()->count(5)->create();

        // 创建一些 ChargerType 实例
        $chargerTypes = ChargerType::factory()->count(10)->create();

        // 为每个 ProviderCompany 分配 ChargerType
        $providerCompanies->each(function ($providerCompany) use ($chargerTypes) {
            // 随机选择几个 ChargerType 并关联
            $selectedChargerTypes = $chargerTypes->random(rand(1, 3));
            $providerCompany->chargerTypes()->attach($selectedChargerTypes);
        });
    }
}
