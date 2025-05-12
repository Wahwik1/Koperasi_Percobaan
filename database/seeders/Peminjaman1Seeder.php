<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Peminjaman1;
use Database\Factories\Peminjaman1Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class Peminjaman1Seeder extends Seeder
{
    public function run(): void
    {
        // Ambil 10 user acak dari database
        $users = User::inRandomOrder()->take(10)->get();

        foreach ($users as $user) {
            // Setiap user punya 1–3 data peminjaman
            Peminjaman1Factory::factory(rand(1, 3))->create([
                'pinjaman_id' => $user->id,
            ]);
        }
    }
}
