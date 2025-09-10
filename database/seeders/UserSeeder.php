<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Klinik',
            'email' => 'admin@kliniku.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Dokter Klinik',
            'email' => 'dokter@kliniku.com',
            'password' => Hash::make('password'),
            'role' => 'dokter',
        ]);

        User::create([
            'name' => 'Pasien Klinik',
            'email' => 'pasien@kliniku.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);
    }
}
