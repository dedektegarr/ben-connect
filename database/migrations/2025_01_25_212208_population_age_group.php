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
        Schema::create('population_age_group', function (Blueprint $table) {
            $table->uuid('population_age_group_id')->primary();
            $table->string('population_age_group_years');
            $table->enum('population_age_group_status', ['active', 'nonactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('population_age_group');
    }
};
