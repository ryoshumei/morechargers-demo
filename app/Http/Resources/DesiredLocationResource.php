<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DesiredLocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'hope_radius' => $this->hope_radius,
            'brand_name' => $this->brand->name ?? '',
            'model_name' => $this->vehicleModel->name ?? '',
            'charger_type_name' => $this->chargerType->name ?? '',
            'provider_company_name' => $this->providerCompany->name ?? '',
            'comment' => $this->comment ?? '',
        ];
    }
}
