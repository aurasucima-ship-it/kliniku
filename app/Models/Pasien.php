<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';

    protected $fillable = [
        'user_id',
        'nama',
        'alamat',
        'jenis_kelamin',
        'no_telp',
        'keluhan',
        'tanggal_berobat',
        'dokter_id',
    ];

    // ------------------------
    // RELATIONS
    // ------------------------

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke dokter
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    // Relasi ke rekam medis
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'pasien_id');
    }

    // Relasi ke pembayaran
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'pasien_id');
    }

    // Ambil pembayaran terakhir
    public function lastPayment()
    {
        return $this->hasOne(Pembayaran::class, 'pasien_id')->latestOfMany();
    }

    // ------------------------
    // ATTRIBUTE HELPERS
    // ------------------------

    // Jenis kelamin full text
    public function getJenisKelaminTextAttribute()
    {
        return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    // Status pembayaran terakhir
    public function getStatusPembayaranAttribute()
    {
        $last = $this->lastPayment;
        if (!$last) return 'Belum Bayar';
        return $last->lunas ? 'Lunas' : 'Belum Lunas';
    }

    // Check jika ada pembayaran belum lunas
    public function getBelumLunasAttribute()
    {
        return $this->pembayaran()->where('lunas', false)->exists();
    }
}
