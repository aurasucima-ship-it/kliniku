<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pasien_id',
        'dokter_id',
        'nama',
        'jenis_kelamin',
        'no_telp',
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
        return $this->belongsTo(Pasien::class);
    }

  
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
