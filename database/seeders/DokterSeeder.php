<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dokter;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        $dokters = [
            ['nama'=>'dr. Andi Pratama','spesialis'=>'Umum','alamat'=>'Jl. Merdeka No. 1','foto'=>'zhanglinghe.jpg'],
            ['nama'=>'dr. Riki Sanjaya','spesialis'=>'Gigi','alamat'=>'Jl. Sudirman No. 2','foto'=>'jeno.jpg'],
            ['nama'=>'dr. Budi Santoso','spesialis'=>'Anak','alamat'=>'Jl. Diponegoro No. 3','foto'=>'mingyuz.jpeg'],
            ['nama'=>'dr. Jenara Alesa','spesialis'=>'Jantung','alamat'=>'Jl. Malio No. 12','foto'=>'jenara.jpg'],
        ];

        foreach ($dokters as $data) {
            Dokter::firstOrCreate(
                ['nama' => $data['nama']],
                $data
            );
        }
    }
}
