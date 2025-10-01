<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';

    protected $fillable = [
        'nama',
        'spesialis',
        'alamat',
        'user_id', 
    ];

    public function pasien()
    {
        return $this->hasMany(Pasien::class, 'dokter_id');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'dokter_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
