<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pasien_id')
                  ->constrained('pasien') // singular
                  ->onDelete('cascade');

            $table->foreignId('dokter_id')
                  ->constrained('dokter') // singular
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

    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
