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
            $table->id('road_id');
            $table->foreignUuid('region_id')->references('region_id')->on('region')->onDelete('cascade');
            $table->foreignUuid('road_category_id')->references('road_category_id')->on('road_category')->onDelete('cascade');
            $table->float('road_long');
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
