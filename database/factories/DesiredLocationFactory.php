<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DesiredLocation;
use App\Models\Brand;
use App\Models\VehicleModel;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DesiredLocation>
 */
class DesiredLocationFactory extends Factory
{
    protected $model = DesiredLocation::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'hope_radius' => $this->faker->numberBetween(1, 100),
            'has_ev_car' => $this->faker->boolean,
            'brand_id' => Brand::factory(),
            'model_id' => VehicleModel::factory(),
            'user_id' => User::factory(),
            'comment' => $this->faker->sentence,
        ];
    }
}
