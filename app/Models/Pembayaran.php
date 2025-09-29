<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'pasien_id',
        'jumlah',
        'metode',
        'tanggal',
        'keterangan',
        'lunas',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'lunas' => 'boolean',
    ];

    // ------------------------
    // RELATIONS
    // ------------------------

    // Relasi ke pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    // ------------------------
    // ATTRIBUTE HELPERS
    // ------------------------

    // Status pembayaran
    public function getStatusAttribute()
    {
        return $this->lunas ? 'Lunas' : 'Belum Lunas';
    }

    // Format jumlah dalam rupiah
    public function getJumlahRupiahAttribute()
    {
        return 'Rp ' . number_format($this->jumlah, 0, ',', '.');
    }
}
