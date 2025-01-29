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
        Schema::create('population', function (Blueprint $table) {
            $table->id('population_id');
            $table->foreignUuid('population_period_id')->references('population_period_id')->on('population_period')->onDelete('cascade');
            $table->foreignUuid('region_id')->references('region_id')->on('region')->onDelete('cascade');
            $table->foreignUuid('population_age_group_id')->references('population_age_group_id')->on('population_age_group')->onDelete('cascade'); 
            $table->integer('population_male');
            $table->integer('population_female');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('population');
    }
};
