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
        Schema::create('adminpeminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_id')->constrained(
                table: 'users', indexName: 'posts_pinjaman_id'
            );
            $table->decimal('ttotalpeminjaman1');
            $table->integer('tpembayaran1');
            $table->float('tbunga1');
            $table->decimal('ttotalpokok1');
            $table->decimal('ttotalbunga1');
            $table->decimal('ttotalpembayaran1');
            $table->string('deskripsi1')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
