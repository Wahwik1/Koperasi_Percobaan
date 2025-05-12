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
        Schema::create('pembayaran2s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembayaran_id')->constrained(
                table: 'users', indexName: 'posts2_pembayaran_id'
            );
            $table->decimal('pokok2', 15, 2)->default(0);
            $table->string('jenis2')->nullable();
            $table->decimal('jumlah_pembayaran2', 15, 2)->default(0); // total pembayaran (pokok + bunga + denda)
            $table->decimal('pokok_dibayar2', 15, 2)->default(0);
            $table->decimal('bunga_dibayar2', 15, 2)->default(0);
            $table->decimal('denda_dibayar2', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran2s');
    }
};
