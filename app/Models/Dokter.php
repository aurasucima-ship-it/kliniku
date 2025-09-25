<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';

    protected $fillable = [
        'nama',
        'spesialis',
        'alamat',
        'foto',
    ];

    public function pasien()
    {
        return $this->hasMany(Pasien::class, 'dokter_id');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'dokter_id');
    }


    public function getFotoUrlAttribute()
    {
        if ($this->foto && Storage::disk('public')->exists('uploads/dokter/'.$this->foto)) {
            return asset('storage/uploads/dokter/'.$this->foto);
        }

        return null;
    }
}
