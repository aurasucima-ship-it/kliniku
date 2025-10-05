<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            if (!Schema::hasColumn('pembayaran', 'pendaftaran_id')) {
                $table->unsignedBigInteger('pendaftaran_id')->nullable()->after('id');
                $table->foreign('pendaftaran_id')
                      ->references('id')
                      ->on('pendaftarans')
                      ->onDelete('cascade');
            }

            if (!Schema::hasColumn('pembayaran', 'dokter_id')) {
                $table->unsignedBigInteger('dokter_id')->nullable()->after('pasien_id');
                $table->foreign('dokter_id')
                      ->references('id')
                      ->on('dokters')
                      ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            if (Schema::hasColumn('pembayaran', 'pendaftaran_id')) {
                $table->dropForeign(['pendaftaran_id']);
                $table->dropColumn('pendaftaran_id');
            }

            if (Schema::hasColumn('pembayaran', 'dokter_id')) {
                $table->dropForeign(['dokter_id']);
                $table->dropColumn('dokter_id');
            }
        });
    }
};
