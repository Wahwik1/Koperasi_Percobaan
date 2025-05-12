<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembayaran1>
 */
class Pembayaran1Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pokok = $this->faker->numberBetween(500000, 5000000);
        $bunga = $this->faker->numberBetween(10000, 100000);
        $denda = $this->faker->numberBetween(0, 50000);
        $jumlah = $pokok + $bunga + $denda;

        return [
            'pembayaran_id' => User::inRandomOrder()->first()?->id ?? User::factory(), // ambil user random atau buat baru
            'pokok1' => $pokok,
            'jenis1' => $this->faker->randomElement(['Bulanan', 'Tahunan', 'Khusus']),
            'jumlah_pembayaran' => $jumlah,
            'pokok_dibayar' => $pokok,
            'bunga_dibayar' => $bunga,
            'denda_dibayar' => $denda,
        ];
    }
}
