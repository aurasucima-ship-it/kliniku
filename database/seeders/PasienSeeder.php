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

        for ($i = 0; $i < 10; $i++) {
            DB::table('pasien')->insert([
                'nama' => $faker->name(),
                'alamat' => $faker->address(),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'no_telp' => $faker->phoneNumber(),
                'keluhan' => $faker->sentence(3),
                'tanggal_berobat' => $faker->date(),
                'dokter_id' => $faker->numberBetween(1, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
