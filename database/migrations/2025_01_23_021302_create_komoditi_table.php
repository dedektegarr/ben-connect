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
        Schema::create('komoditi', function (Blueprint $table) {
            $table->uuid('komoditi_id')->primary();
            $table->string('komoditi_name');
            $table->string('color');
            $table->uuid('pasar_id')->nullable();
            $table->timestamps();

            $table->foreign('pasar_id')->references('pasar_id')->on('pasar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komoditi');
    }
};
