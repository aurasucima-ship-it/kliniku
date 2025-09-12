<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dokter;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        Dokter::create([
            'nama'      => 'dr. Andi Pratama',
            'spesialis' => 'Umum',
            'alamat'    => 'Jl. Merdeka No. 1',
        ]);

        Dokter::create([
            'nama'      => 'dr. Riki Sanjaya',
            'spesialis' => 'Gigi',
            'alamat'    => 'Jl. Sudirman No. 2',
        ]);

        Dokter::create([
            'nama'      => 'dr. Budi Santoso',
            'spesialis' => 'Anak',
            'alamat'    => 'Jl. Diponegoro No. 3',
        ]);
    }
}
