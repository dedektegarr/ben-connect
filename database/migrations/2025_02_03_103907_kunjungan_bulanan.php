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
        Schema::create('kunjungan_bulanan', function (Blueprint $table) {
            $table->id('kunjungan_bulanan_id');
            $table->integer('kunjungan_bulanan_pasien_baru');
            $table->integer('kunjungan_bulanan_pasien_lama');
            $table->string('kunjungan_bulanan_bulan');
            $table->string('kunjungan_bulanan_tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan_bulanan');
    }
};
