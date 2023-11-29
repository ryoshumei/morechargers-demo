<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // password
            'name' => $this->faker->name(),
            'google_id' => Str::random(10), // random id
            'ip_address' => $this->faker->ipv4,
            'signup_datetime' => now(),
            'last_login_datetime' => now(),
            'user_role' => $this->faker->randomElement(['admin', 'user']), //  'admin' or 'user'
            'account_type' => $this->faker->randomElement(['anonymous', 'signed_up', 'google']), // 'anonymous', 'signed_up', or 'google'
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
