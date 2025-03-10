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
        Schema::create('bridges', function (Blueprint $table) {
            $table->uuid("bridge_id");
            $table->string("tahun");
            $table->string("nama_jembatan");
            $table->string("nama_ruas_jalan");
            $table->double("panjang");
            $table->double("lebar");
            $table->integer("jumlah_bentang");
            $table->string("bangunan_atas_tipe");
            $table->string("bangunan_atas_tipe_2");
            $table->string("bangunan_atas_kondisi");
            $table->string("bangunan_bawah_tipe");
            $table->string("bangunan_bawah_kondisi");
            $table->string("fondasi_tipe");
            $table->string("fondasi_kondisi");
            $table->string("lantai_jembatan_tipe");
            $table->string("lantai_jembatan_kondisi");
            $table->string("sungai_tipe");
            $table->string("sungai_kondisi");
            $table->year("tahun_konstruksi");
            $table->year("tahun_survei");
            $table->integer("NK");
            $table->enum("status", ["BAIK", "SEDANG", "RUSAK RINGAN", "RUSAK BERAT"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bridges');
    }
};
