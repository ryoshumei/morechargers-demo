<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderCompany extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'provider_companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function desiredLocations(){
        return $this->hasMany(DesiredLocation::class);
    }

    public function chargerTypes()
    {
        return $this->belongsToMany(ChargerType::class, 'charger_companies_charger_types');
    }
}
