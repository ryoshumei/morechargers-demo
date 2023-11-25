<?php

namespace Database\Seeders;

use App\Models\ProviderCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProviderCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ProviderCompany::factory()->count(10)->create();
    }
}
