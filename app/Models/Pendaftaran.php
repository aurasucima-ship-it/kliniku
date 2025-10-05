<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';

    protected $fillable = [
        'user_id',
        'pasien_id',
        'dokter_id',
        'nama',
        'no_telp',
        'jenis_kelamin',
        'alamat',
        'keluhan',
        'tanggal_berobat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

public function pasien()
{
    return $this->belongsTo(User::class, 'pasien_id');
}



   public function dokter()
{
    return $this->belongsTo(User::class, 'dokter_id');
}

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'pendaftaran_id');
    }
}
