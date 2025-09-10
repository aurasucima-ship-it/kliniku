<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'keluhan',
        'diagnosa',
        'tindakan',
        'resep_obat',
        'catatan',
        'tanggal_pemeriksaan',
    ];

    /**
     * Relasi ke model Pasien.
     */
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    /**
     * Relasi ke model Dokter.
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }
}
