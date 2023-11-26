<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesiredLocation extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'desired_locations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'latitude',
        'longitude',
        'hope_radius',
        'has_ev_car',
        'brand_id',
        'model_id',
        'charger_type_id',
        'provider_company_id',
        'user_id',
        'comment',
    ];

    /**
     * Get the brand associated with the desired location.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * Get the vehicle model associated with the desired location.
     */
    public function vehicleModel()
    {
        return $this->belongsTo(VehicleModel::class, 'model_id');
    }

    /**
     * Get the user associated with the desired location.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function chargerType()
    {
        return $this->belongsTo(ChargerType::class, 'charger_type_id');
    }

    public function providerCompany()
    {
        return $this->belongsTo(ProviderCompany::class, 'provider_company_id');
    }
}
