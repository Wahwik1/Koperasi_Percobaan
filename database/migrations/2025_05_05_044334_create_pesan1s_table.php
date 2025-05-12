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
        Schema::create('pesan1s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesan_id')->constrained(
                table: 'users', indexName: 'posts_pesan1_id'
            );
            $table->decimal('ttotalpeminjaman1', 15, 2)->default(0);
            $table->string('jenis1')->nullable();
            $table->integer('tpembayaran1')->default(0);
            $table->float('tbunga1')->default(0);
            $table->decimal('ttotalpokok1', 15, 2)->default(0);
            $table->decimal('ttotalbunga1', 15, 2)->default(0);
            $table->decimal('ttotalpembayaran1', 15, 2)->default(0);
            $table->string('deskripsi1')->nullable();
            $table->decimal('penarikantabungan', 15, 2)->default(0);
            $table->decimal('tabungansaatini', 15, 2)->default(0);
            $table->decimal('sisatabungan', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan1s');
    }
};
