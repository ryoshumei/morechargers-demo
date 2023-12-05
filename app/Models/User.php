<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'name',
        'google_id',
        'ip_address',
        'signup_datetime',
        'last_login_datetime',
        'user_role',
        'account_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'signup_datetime' => 'datetime',
        'last_login_datetime' => 'datetime',
    ];

    public function desiredLocations(){
        return $this->hasMany(DesiredLocation::class);
    }

    // check if user has role
    /**
     * @param  string  $role
     * @return bool
     */
    public function hasRole($role){
        return $this->user_role === $role;
    }
}
