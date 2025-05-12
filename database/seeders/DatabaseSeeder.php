<?php

namespace Database\Seeders;

use App\Models\Pembayaran1;
use App\Models\Peminjaman1;
use App\Models\User;
use Database\Factories\Pembayaran1Factory;
use Database\Factories\peminjaman1Factory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(210)->create();
        Pembayaran1::factory(210)->create();
        // Peminjaman1::factory(100)->create();

        User::factory()->create([
            'id' => 500,
            'name' => 'admin',
            'password' => Hash::make('admin123'),
            'email' => 'admin@gmail.com',
            'jeniskelamin' => 'Laki - Laki',
            'nik' => '32840293',
            'ttl' => 'Denpasar, 11 - September 2002',
            'nohp'=> '08214329384',
            'alamat' => 'Jalan Jayagiri Denpasar',
            'is_admin' => true,
            "email_verified_at" => now(),
            "remember_token"=> Str::random(10)
        ]);


    }
}
