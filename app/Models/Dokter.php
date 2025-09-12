<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter'; // ✅ wajib karena tabel singular

    protected $fillable = ['nama', 'alamat', 'spesialis'];

    public function pasien()
    {
        return $this->hasMany(Pasien::class, 'dokter_id');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'dokter_id');
    }
}
