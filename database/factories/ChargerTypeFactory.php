<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ChargerType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChargerType>
 */
class ChargerTypeFactory extends Factory
{
    protected $model = ChargerType::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
