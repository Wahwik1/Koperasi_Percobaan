<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'jeniskelamin',
        'nik',
        'ttl',
        'nohp',
        'alamat',
        'is_admin',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $with = ['peminjaman1', 'peminjaman2','tabungan', 'pesan1'];

    public function peminjaman1(): HasOne
    {
        return $this->hasOne(Peminjaman1::class, 'pinjaman_id'); // pastikan foreign key-nya benar
    }
    public function peminjaman2(): HasOne
    {
        return $this->hasOne(Peminjaman2::class, 'pinjaman_id');
    }
    public function tabungan(): HasOne
    {
        return $this->hasOne(Tabungan::class, 'tabungan_id');
    }
    public function pesan1(): HasOne
    {
        return $this->hasOne(Pesan1::class, 'pesan_id');
    }
}
