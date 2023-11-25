<?php

namespace Database\Seeders;

use App\Models\DesiredLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesiredLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DesiredLocation::factory()->count(10)->create();
    }
}
