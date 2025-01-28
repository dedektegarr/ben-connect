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
        Schema::create('school_filter', function (Blueprint $table) {
            $table->uuid('school_filter_id')->primary();
            $table->foreignUuid('school_id')->references('school_id')->on('school')->onDelete('cascade'); // Foreign key ke school id
            $table->foreignUuid('dataset_id')->references('dataset_id')->on('dataset')->onDelete('cascade'); // Foreign key ke school level
            $table->integer('school_filter_total_student');
            $table->integer('school_filter_total_teacher');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_filter');
    }
};
