<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userType = ['Free User', 'Paid User', 'Developer'];
        return [
            'name' => fake()->name(),
            'address' => fake()->unique()->address(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'user_type' => fake()->randomElement($userType),

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
