<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans'; // nama tabel di DB

    protected $fillable = [
        'user_id',        // pasien yang daftar (relasi ke users)
        'pasien_id',      // opsional, kalau ada tabel pasien terpisah
        'dokter_id',
        'nama',
        'jenis_kelamin',
        'no_telp',
        'alamat',
        'keluhan',
        'tanggal_berobat',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */

    // Relasi ke User (pasien login)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi opsional ke Pasien (jika ada tabel pasien terpisah)
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    // Relasi ke Dokter
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
