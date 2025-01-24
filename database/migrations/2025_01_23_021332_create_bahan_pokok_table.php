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
        Schema::create('bahan_pokok', function (Blueprint $table) {
            $table->uuid('bahan_pokok_id')->primary();
            $table->string('bahan_pokok_name');
            $table->string('satuan');
            $table->integer('harga');
            $table->dateTime('waktu');
            $table->uuid('pasar_id')->nullable();
            $table->uuid('komoditi_id')->nullable();
            $table->timestamps();

            $table->foreign('komoditi_id')->references('komoditi_id')->on('komoditi')->onDelete('cascade');
            $table->foreign('pasar_id')->references('pasar_id')->on('pasar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_pokok');
    }
};
