<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Pendaftaran;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'pendaftaran_id',
        'dokter_id',
        'pasien_id',
        'tanggal',
        'layanan',
        'biaya',
        'status',
        'jumlah',
        'metode',
        'keterangan',
        'lunas',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'lunas'   => 'boolean',
        'biaya'   => 'decimal:2',
        'jumlah'  => 'decimal:2',
    ];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'pasien_id');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }

    public function getStatusPembayaranAttribute()
    {
        return $this->lunas ? 'Lunas' : 'Belum Lunas';
    }

    public function getJumlahRupiahAttribute()
    {
        return 'Rp ' . number_format($this->jumlah ?? 0, 0, ',', '.');
    }

    public function getBiayaRupiahAttribute()
    {
        return 'Rp ' . number_format($this->biaya ?? 0, 0, ',', '.');
    }
}
