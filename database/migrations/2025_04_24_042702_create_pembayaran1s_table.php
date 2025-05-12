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
        Schema::create('pembayaran1s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembayaran_id')->constrained(
                table: 'users', indexName: 'posts1_pembayaran_id'
            );
            $table->decimal('pokok1', 15, 2)->default(0);
            $table->string('jenis1')->nullable();
            $table->decimal('jumlah_pembayaran', 15, 2)->default(0); // total pembayaran (pokok + bunga + denda)
            $table->decimal('pokok_dibayar', 15, 2)->default(0);
            $table->decimal('bunga_dibayar', 15, 2)->default(0);
            $table->decimal('denda_dibayar', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran1s');
    }
};
