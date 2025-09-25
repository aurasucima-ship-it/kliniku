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

    
    public function getJenisKelaminTextAttribute()
    {
        return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    }
}
