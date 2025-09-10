<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';

    protected $fillable = [
        'user_id',        // ✅ tambahkan ini
        'nama',
        'alamat',
        'jenis_kelamin',
        'no_telp',
        'keluhan',
        'tanggal_berobat',
        'dokter_id',
    ];

    /**
     * Relasi ke User (akun login)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Dokter
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    /**
     * Relasi ke Rekam Medis
     */
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'pasien_id');
    }
}
