<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProviderCompany;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProviderCompany>
 */
class ProviderCompanyFactory extends Factory
{
    protected $model = ProviderCompany::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
        ];
    }
}
