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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();

          
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

       
            $table->foreignId('pasien_id')
                  ->nullable()
                  ->constrained('pasien') 
                  ->onDelete('cascade');

            $table->foreignId('dokter_id')
                  ->constrained('dokter')
                  ->onDelete('cascade');

            
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('no_telp', 20);
            $table->string('alamat');
            $table->text('keluhan');
            $table->date('tanggal_berobat');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
