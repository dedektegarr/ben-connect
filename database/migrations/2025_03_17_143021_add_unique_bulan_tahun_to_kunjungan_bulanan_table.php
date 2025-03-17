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
        Schema::table('kunjungan_bulanan', function (Blueprint $table) {
            $table->unique(["kunjungan_bulanan_bulan", "kunjungan_bulanan_tahun"], "unique_bulan_tahun");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kunjungan_bulanan', function (Blueprint $table) {
            //
        });
    }
};
