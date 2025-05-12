<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tabungan extends Model
{
    protected $fillable = [
        'tabungan_id',
        'tabungan'
    ];
    public function tabungan(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }
}
