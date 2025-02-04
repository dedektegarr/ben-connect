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
        Schema::create('kunjungan_harian', function (Blueprint $table) {
            $table->id('kunjungan_harian_id');
            $table->integer('kunjungan_harian_pasien_baru');
            $table->integer('kunjungan_harian_pasien_lama');
            $table->date('kunjungan_harian_tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan_harian');
    }
};
