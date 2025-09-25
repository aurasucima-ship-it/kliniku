<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        
        User::updateOrCreate(
            ['email' => 'admin@kliniku.com'],
            [
                'name' => 'Admin Klinik',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

      
        User::updateOrCreate(
            ['email' => 'dokter@kliniku.com'],
            [
                'name' => 'dr. Riki Sanjaya',
                'password' => Hash::make('password'),
                'role' => 'dokter',
            ]
        );

        
        User::updateOrCreate(
            ['email' => 'pasien@kliniku.com'],
            [
                'name' => 'Canva Narendra',
                'password' => Hash::make('password'),
                'role' => 'pasien',
            ]
        );
    }
}
