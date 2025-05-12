<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman1s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_id')->constrained(
                table: 'users', indexName: 'posts_peminjaman_id'
            );
            $table->decimal('ttotalpeminjaman1', 15, 2);
            $table->decimal('pokok1', 15, 2);
            $table->integer('tpembayaran1');
            $table->float('tbunga1');
            $table->decimal('ttotalpokok1', 15, 2);
            $table->decimal('ttotalbunga1', 15, 2);
            $table->decimal('ttotalpembayaran1', 15, 2);
            $table->string('deskripsi1')->nullable();
            $table->decimal('bunga_sebelumnya', 15, 2)->default(0);
            $table->decimal('denda', 15, 2)->default(0);
            $table->boolean('status_denda')->default(0);
            $table->boolean('status_lunas')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman1s', function (Blueprint $table) {
            $table->dropColumn(['bunga_sebelumnya', 'denda']);
        });
    }
};
