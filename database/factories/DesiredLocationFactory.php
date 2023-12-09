<?php

namespace Database\Factories;

use App\Models\ChargerType;
use App\Models\ProviderCompany;
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
        // 随机选择一个 Brand 实例及其关联的 VehicleModel
        // random select a Brand instance and its related VehicleModel
        $brand = Brand::inRandomOrder()->first() ?? Brand::factory()->create();
        $vehicleModel = $brand->vehicleModels()->inRandomOrder()->first() ?? VehicleModel::factory()->create(['brand_id' => $brand->id]);

        // 确保至少存在一个 ChargerType 和 ProviderCompany，并且它们之间有关联
        $chargerType = ChargerType::inRandomOrder()->first() ?? ChargerType::factory()->create();
        $providerCompany = ProviderCompany::inRandomOrder()->first() ?? ProviderCompany::factory()->create();

        // 确保 ChargerType 和 ProviderCompany 之间有关联
        $chargerType->providerCompanies()->syncWithoutDetaching($providerCompany->id);
        return [
            // create 10 desired locations in japan with different latitude and longitude
            'latitude' => $this->faker->latitude(35.69167, 36.69167),
            'longitude' => $this->faker->longitude(132.68944, 140.68944),
            'hope_radius' => $this->faker->numberBetween(1, 100),
            'has_ev_car' => $this->faker->boolean,
            'brand_id' => $brand->id,
            'model_id' => $vehicleModel->id,
            'charger_type_id' => $chargerType->id,
            'provider_company_id' => $providerCompany->id,
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'comment' => $this->faker->sentence,
        ];
    }
}
