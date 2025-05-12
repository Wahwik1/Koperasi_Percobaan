<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman1 extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pinjaman_id',
        'ttotalpeminjaman1',
        'pokok1',
        'tpembayaran1',
        'tbunga1',
        'ttotalpokok1',
        'ttotalbunga1',
        'ttotalpembayaran1',
        'deskripsi1',
        'bunga_sebelumnya',
        'denda',
        'jumlah_pembayaran'
    ];

    protected $with = [];

    public function pinjaman1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pinjaman_id');
    }
}
