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
        Schema::create('region_data', function (Blueprint $table) {
            $table->id('region_data_id');
            $table->foreignUuid('region_id')->references('region_id')->on('region')->onDelete('cascade');
            $table->year('region_data_year');
            $table->float('region_data_area');
            $table->text('region_data_polygon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('region_area');
    }
};
