<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman2 extends Model
{
    protected $fillable = [
        'pinjaman_id',
        'ttotalpeminjaman2',
        'pokok2',
        'tpembayaran2',
        'tbunga2',
        'ttotalpokok2',
        'ttotalbunga2',
        'ttotalpembayaran2',
        'deskripsi2',
        'denda2',
        'jumlah_pembayaran2'
    ];



    public function pinjaman2(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pembayaran2(): HasMany
    {
        return $this->hasMany(Pembayaran1::class);
    }
}
