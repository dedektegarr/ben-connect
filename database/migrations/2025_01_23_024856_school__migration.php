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
        Schema::create('school', function (Blueprint $table) {
            $table->uuid('school_id')->primary();
            $table->foreignUuid('school_level_id')->references('school_level_id')->on('school_level')->onDelete('cascade');
            $table->foreignUuid('region_id')->references('region_id')->on('region')->onDelete('cascade');
            $table->integer('negeri_count');
            $table->integer('swasta_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school');
    }
};
