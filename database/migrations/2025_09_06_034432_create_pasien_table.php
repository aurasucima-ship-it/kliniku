<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']); // L = Laki-laki, P = Perempuan
            $table->string('no_telp', 30)->nullable();
            $table->text('keluhan')->nullable();
            $table->date('tanggal_berobat');
            $table->foreignId('dokter_id')
                  ->nullable()
                  ->constrained('dokter') // tabel dokter singular
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
