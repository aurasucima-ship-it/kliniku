<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Dokter extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'dokter';

    // Field yang bisa diisi mass assignment
    protected $fillable = [
        'nama',
        'spesialis',
        'alamat',
        'foto',
    ];

    /**
     * Relasi ke pasien
     * Satu dokter bisa punya banyak pasien
     */
    public function pasien()
    {
        return $this->hasMany(Pasien::class, 'dokter_id');
    }

    /**
     * Relasi ke rekam medis
     * Satu dokter bisa punya banyak rekam medis
     */
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'dokter_id');
    }

    /**
     * Helper untuk mendapatkan URL foto dokter
     * - Jika foto ada → kembalikan URL storage
     * - Jika tidak ada → null (tidak error)
     */
    public function getFotoUrlAttribute()
    {
        if ($this->foto && Storage::disk('public')->exists('uploads/dokter/'.$this->foto)) {
            return asset('storage/uploads/dokter/'.$this->foto);
        }

        return null; // bisa ditampilkan '-' di Blade
    }
}
