<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargerType extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'charger_types';

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

    public function providerCompanies()
    {
        return $this->belongsToMany(ProviderCompany::class, 'charger_companies_charger_types');
    }
}
