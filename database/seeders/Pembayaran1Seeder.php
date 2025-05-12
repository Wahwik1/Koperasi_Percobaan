<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pembayaran1;
use Database\Factories\Pembayaran1Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Pembayaran1Seeder extends Seeder
{
    public function run(): void
    {
        // Ambil 10 user acak dari database
        $users = User::inRandomOrder()->take(1)->get();

        foreach ($users as $user) {
            // Setiap user punya 1–3 data pembayaran
            Pembayaran1Factory::factory(rand(50, 100))->create([
                'pembayaran_id' => $user->id,
            ]);
        }
    }
}
