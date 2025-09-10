<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel pasiens
            $table->foreignId('pasien_id')
                  ->constrained('pasiens')
                  ->onDelete('cascade');

            // Relasi ke tabel dokters
            $table->foreignId('dokter_id')
                  ->constrained('dokters')
                  ->onDelete('cascade');

            $table->text('keluhan');
            $table->text('diagnosa')->nullable();
            $table->text('tindakan')->nullable();
            $table->text('resep_obat')->nullable();
            $table->text('catatan')->nullable();
            $table->date('tanggal_pemeriksaan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
