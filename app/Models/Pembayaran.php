<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran'; 

    protected $fillable = [
        'dokter_id',
        'pasien_id',
        'tanggal',
        'layanan',
        'biaya',
        'status'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }


    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }
}
