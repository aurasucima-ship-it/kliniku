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

    protected $casts = [
        'tanggal_berobat' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'pasien_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'pasien_id');
    }

    public function lastPayment()
    {
        return $this->hasOne(Pembayaran::class, 'pasien_id')->latestOfMany();
    }

    public function getJenisKelaminTextAttribute()
    {
        return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    public function getStatusPembayaranAttribute()
    {
        $last = $this->lastPayment;
        if (!$last) return 'Belum Bayar';
        return $last->lunas ? 'Lunas' : 'Belum Lunas';
    }

    public function getBelumLunasAttribute()
    {
        return $this->pembayaran()->where('lunas', false)->exists();
    }

    public function getTanggalBerobatFormattedAttribute()
    {
        return $this->tanggal_berobat
            ? $this->tanggal_berobat->format('d/m/Y')
            : '-';
    }
}
