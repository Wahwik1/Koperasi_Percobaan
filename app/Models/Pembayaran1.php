<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran1 extends Model

{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pembayaran_id',
        'pokok1',
        'jenis1',
        'jumlah_pembayaran',
        'pokok_dibayar',
        'bunga_dibayar',
        'denda_dibayar'
    ];

    protected $with = ['pembayaran1', 'peminjaman1'];

    public function pembayaran1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pembayaran_id');
    }
    public function peminjaman1(): BelongsTo
    {
        return $this->belongsTo(Peminjaman1::class, "pinjaman_id");
    }
}
