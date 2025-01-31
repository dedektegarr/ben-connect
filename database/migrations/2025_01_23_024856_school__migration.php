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
            $table->integer('school_npsn');
            $table->string('school_name');
            $table->enum('school_status',['negeri','swasta']);
            $table->foreignUuid('school_level_id')->references('school_level_id')->on('school_level')->onDelete('cascade');
            $table->foreignUuid('region_id')->references('region_id')->on('region')->onDelete('cascade');
            $table->text('school_address');
            $table->double('latitude');
            $table->double('longitude');
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
