<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Ambil semua ID dokter yang ada di tabel dokter
        $dokterIds = DB::table('dokter')->pluck('id')->toArray();

        // Jika belum ada dokter, hentikan seeding pasien
        if (empty($dokterIds)) {
            $this->command->warn('Tidak ada data dokter. Jalankan DokterSeeder terlebih dahulu.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            DB::table('pasien')->insert([
                'nama'             => $faker->name(),
                'alamat'           => $faker->address(),
                'jenis_kelamin'    => $faker->randomElement(['L', 'P']),
                'no_telp'           => $faker->phoneNumber(),
                'keluhan'           => $faker->sentence(3),
                'tanggal_berobat'   => $faker->date(),
                'dokter_id'         => $faker->randomElement($dokterIds),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
