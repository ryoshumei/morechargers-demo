<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\VehicleModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleModel>
 */
class VehicleModelFactory extends Factory
{
    protected $model = VehicleModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'brand_id' => Brand::factory(),
        ];
    }
}
