<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admin_Peminjaman extends Model
{
    protected $fillable = [
        'pinjaman_id',
        'ttotalpeminjaman1',
        'tpembayaran1',
        'tbunga1',
        'ttotalpokok1',
        'ttotalbunga1',
        'ttotalpembayaran1',
        'deskripsi1',
    ];
    public function pinjaman(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
