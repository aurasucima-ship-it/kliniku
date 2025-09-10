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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('no_telp', 15);
            $table->text('keluhan');
            $table->date('tanggal_berobat');
            $table->unsignedBigInteger('dokter_id');
            $table->timestamps();

            $table->foreign('dokter_id')
                  ->references('id')
                  ->on('dokters')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
