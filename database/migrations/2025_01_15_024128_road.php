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
        Schema::create('road', function (Blueprint $table) {
            $table->uuid('road_id');
            $table->string("nama_ruas");
            $table->double("panjang_ruas")->nullable();
            $table->string("dari_km")->nullable();
            $table->string("sampai_km");
            $table->double("kondisi_baik_km")->nullable();
            $table->double("kondisi_sedang_km")->nullable();
            $table->double("kondisi_rusak_ringan_km")->nullable();
            $table->double("kondisi_rusak_berat_km")->nullable();
            $table->double("kondisi_baik_persentase");
            $table->double("kondisi_sedang_persentase");
            $table->double("kondisi_rusak_ringan_persentase");
            $table->double("kondisi_rusak_berat_persentase");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('road');
    }
};
