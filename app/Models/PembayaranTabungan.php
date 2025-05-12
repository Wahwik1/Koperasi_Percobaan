<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PembayaranTabungan extends Model
{
    protected $fillable = [
        'pembayarantabungan_id',
        'pembayarantabungan',
        'tabungansebelumnya',
        'sisatabungan',
        'jenis1'
    ];
    public function tabungan(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pembayarantabungan_id');
    }
    public function pembayarantabungan(): BelongsTo
    {
        return $this->belongsTo(Tabungan::class, "tabungan_id");
    }
}
