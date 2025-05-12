<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesan1 extends Model
{
    protected $fillable = [
        'pesan_id',
        'jenis1',
        'ttotalpeminjaman1',
        'tpembayaran1',
        'tbunga1',
        'ttotalpokok1',
        'ttotalbunga1',
        'ttotalpembayaran1',
        'deskripsi1',
        'penarikantabungan',
        'tabungansaatini',
        'sisatabungan'
    ];


    public function pesan1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pesan_id');
    }
}
