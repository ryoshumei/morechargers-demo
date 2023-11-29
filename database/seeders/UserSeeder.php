<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();

        // add admin user
        User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'name' => 'admin',
            'google_id' => 'admin',
            'ip_address' => '192.168.1.1',
            'signup_datetime' => now(),
            'last_login_datetime' => now(),
            'user_role' => 'admin',
            'account_type' => 'signed_up',
            'remember_token' => Str::random(10),
        ]);
        //add user user
        User::factory()->create([
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            'name' => 'user',
            'google_id' => 'user',
            'ip_address' => '192.168.1.1',
            'signup_datetime' => now(),
            'last_login_datetime' => now(),
            'user_role' => 'user',
            'account_type' => 'signed_up',
            'remember_token' => Str::random(10),
        ]);
    }
}
