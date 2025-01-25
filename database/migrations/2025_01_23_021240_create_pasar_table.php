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
        Schema::create('pasar', function (Blueprint $table) {
            $table->uuid('pasar_id')->primary();
            $table->string('pasar_name');
            $table->double('latitude');
            $table->double('longitude');
            $table->uuid('area_id')->nullable();
            $table->timestamps();

            $table->foreign('area_id')->references('area_id')->on('area')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasar');
    }
};
