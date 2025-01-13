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
        Schema::create('jalan', function (Blueprint $table) {
            $table->id('jalan_id');
            $table->foreign('tahun_data_id')->references('tahun_data_id')->on('tahun_data')->onDelete('cascade');
            $table->foreign('daerah_id')->references('daerah_id')->on('daerah')->onDelete('cascade');
            $table->foreign('kategori_jalan_id')->references('kategori_jalan_id')->on('kategori_jalan')->onDelete('cascade');
            $table->float('panjang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jalan');
    }
};
