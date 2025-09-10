<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    // Tidak perlu $table, karena Laravel otomatis pakai "dokters"

    protected $fillable = [
        'nama',
        'alamat',
        'spesialis',
    ];

    /**
     * Relasi ke Pasien (satu dokter bisa punya banyak pasien)
     */
    public function pasien()
    {
        return $this->hasMany(Pasien::class, 'dokter_id');
    }

    /**
     * Relasi ke Rekam Medis (satu dokter bisa punya banyak rekam medis)
     */
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'dokter_id');
    }
}
