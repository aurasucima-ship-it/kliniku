<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'foto',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // === Role Checkers ===
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isDokter(): bool
    {
        return $this->role === 'dokter';
    }

    public function isPasien(): bool
    {
        return $this->role === 'pasien';
    }

    // === Relations ===
    public function dokter()
    {
        // 1 user -> 1 dokter
        return $this->hasOne(Dokter::class, 'user_id');
    }

    public function pasien()
    {
        // 1 user -> 1 pasien
        return $this->hasOne(Pasien::class, 'user_id');
    }

    public function rekamMedis()
    {
        // 1 user bisa input banyak rekam medis (jika pasien/dokter terkait)
        return $this->hasMany(RekamMedis::class, 'dokter_id')
            ->orWhere('pasien_id', $this->id);
    }

    public function pembayaran()
    {
        // 1 user -> banyak pembayaran (biasanya pasien)
        return $this->hasMany(Pembayaran::class, 'user_id');
    }
}
