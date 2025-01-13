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
        Schema::create('akta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daerah_id')->constrained('daerah')->cascadeOnDelete();
            $table->float('jumlah_penduduk');
            $table->float('ada');
            $table->foreignId('tahun_id')->constrained('tahun')->cascadeOnDelete();
            $table->float('tidak_ada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akta');
    }
};
