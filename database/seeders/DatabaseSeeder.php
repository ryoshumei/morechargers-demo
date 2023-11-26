<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BrandSeeder::class,
            VehicleModelSeeder::class,
            ChargerTypeSeeder::class,
            ProviderCompanySeeder::class,
            FeedbackSeeder::class,
            UserSeeder::class,
            DesiredLocationSeeder::class,
            ProviderCompanyChargerTypeSeeder::class,
        ]);
    }
}
