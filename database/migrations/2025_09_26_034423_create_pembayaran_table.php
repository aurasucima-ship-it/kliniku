<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
Schema::create('pembayaran', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pasien_id')->constrained('pasien')->cascadeOnDelete();
    $table->decimal('jumlah', 15, 2);
    $table->string('metode');
    $table->date('tanggal');
    $table->text('keterangan')->nullable();
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
