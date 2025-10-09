<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        $dokters = [
            ['nama' => 'dr. Riki Sanjaya', 'spesialis' => 'Gigi', 'alamat' => 'Jl. Sudirman No. 2'],
            ['nama' => 'dr. Budi Santoso', 'spesialis' => 'Anak', 'alamat' => 'Jl. Diponegoro No. 3'],
            ['nama' => 'dr. Jenara Alesa', 'spesialis' => 'Jantung', 'alamat' => 'Jl. Malio No. 12'],
        ];

        foreach ($dokters as $data) {
          
            $dokter = Dokter::firstOrCreate(
                ['nama' => $data['nama']],
                $data
            );

          
            $user = User::firstOrCreate(
                ['name' => $dokter->nama, 'role' => 'dokter'],
                [
                    'email' => strtolower(str_replace(' ', '', $dokter->nama)) . '@kliniku.com',
                    'password' => Hash::make('password'),
                ]
            );

            if (!$dokter->user_id) {
                $dokter->user_id = $user->id;
                $dokter->save();
            }

            echo "Dokter {$dokter->nama} => User ID {$user->id} berhasil dibuat.\n";
        }
    }
}
