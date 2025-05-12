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
        Schema::create('peminjaman2s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_id')->constrained(
                table: 'users', indexName: 'posts2_peminjaman_id'
            );
            $table->decimal('ttotalpeminjaman2', 15, 2);
            $table->decimal('pokok2', 15, 2);
            $table->integer('tpembayaran2');
            $table->float('tbunga2');
            $table->decimal('ttotalpokok2', 15, 2);
            $table->decimal('ttotalbunga2', 15, 2);
            $table->decimal('ttotalpembayaran2', 15, 2);
            $table->string('deskripsi2')->nullable();
            $table->decimal('bunga_sebelumnya2', 15, 2)->default(0);
            $table->decimal('denda2', 15, 2)->default(0);
            $table->boolean('status_denda2')->default(0);
            $table->boolean('status_lunas2')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman2s', function (Blueprint $table) {
            $table->dropColumn(['bunga_sebelumnya2', 'denda']);
        });
    }
};
