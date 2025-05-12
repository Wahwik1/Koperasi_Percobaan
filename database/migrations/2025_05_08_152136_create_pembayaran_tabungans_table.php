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
        Schema::create('pembayaran_tabungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembayarantabungan_id')->constrained(
                table: 'users', indexName: 'posts_pembayaran_tabungan_id'
            );
            $table->string('jenis1')->nullable();
            $table->decimal('pembayarantabungan', 15, 2)->default(0);
            $table->decimal('tabungansebelumnya', 15, 2)->default(0);
            $table->decimal('sisatabungan', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_tabungans');
    }
};
