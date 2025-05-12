<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran2 extends Model
{
    protected $fillable = [
        'pembayaran_id',
        'pokok2',
        'jenis2',
        'jumlah_pembayaran2',
        'pokok_dibayar2',
        'bunga_dibayar2',
        'denda_dibayar2'
    ];

    public function pembayaran2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pembayaran_id');
    }
    public function peminjaman2(): BelongsTo
    {
        return $this->belongsTo(Peminjaman2::class, "pinjaman_id");
    }
}
