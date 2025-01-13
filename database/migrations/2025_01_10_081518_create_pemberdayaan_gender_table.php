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
        Schema::create('pemberdayaan_gender', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daerah_id')->constrained('daerah')->cascadeOnDelete();
            $table->foreignId('tahun_id')->constrained('tahun')->cascadeOnDelete();
            $table->float('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemberdayaan_gender');
    }
};
