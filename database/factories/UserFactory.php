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
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'jeniskelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'nik' => fake()->unique()->nik(), // atau pakai fake()->numerify('##############') untuk 16 digit acak
            'ttl' => fake()->date('Y-m-d') . ', ' . fake()->city(),
            'nohp' => fake()->phoneNumber(),
            'alamat' => fake()->address(),
            'is_admin' => false,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('wahwik123'),
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
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_admin' => true,
        ]);
    }
}
