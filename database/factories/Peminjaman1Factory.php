<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Peminjaman1;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\peminjaman1>
 */
class Peminjaman1Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Peminjaman1::class;

    public function definition(): array
    {
        $pokok = $this->faker->randomFloat(2, 1000000, 5000000);
        $bunga = 0.5;
        $pembayaranKe = $this->faker->numberBetween(1, 12);
        $totalBunga = $pokok * $bunga / 100 * $pembayaranKe;
        $totalPembayaran = $pokok + $totalBunga;

        return [
            'pinjaman_id' => User::factory(),
            'ttotalpeminjaman1' => $totalPembayaran,
            'pokok1' => $pokok,
            'tpembayaran1' => $pembayaranKe,
            'tbunga1' => $bunga,
            'ttotalpokok1' => $pokok,
            'ttotalbunga1' => $totalBunga,
            'ttotalpembayaran1' => $totalPembayaran,
            'deskripsi1' => $this->faker->sentence,
            'bunga_sebelumnya' => $totalBunga,
            'denda' => 0,
            'status_denda' => false,
            'status_lunas' => false,
        ];
    }
}
