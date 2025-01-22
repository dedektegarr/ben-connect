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
        Schema::create('social', function (Blueprint $table) {
            $table->uuid('social_id')->primary(); // Primary Key
            $table->uuid('area_id'); // Foreign Key ke area
            $table->float('have')->nullable();
            $table->uuid('dataset_id')->nullable(); // Foreign Key ke dataset
            $table->uuid('social_category_id'); // Foreign Key ke social_category
            $table->float('nothing')->nullable();
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
            $table->date('date_notice')->nullable();
            $table->float('count')->nullable();
        
            // Foreign Key Constraints
            $table->foreign('area_id')->references('area_id')->on('area')->onDelete('cascade');
            $table->foreign('dataset_id')->references('dataset_id')->on('dataset')->onDelete('cascade');
            $table->foreign('social_category_id')->references('social_category_id')->on('social_category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social');
    }
};
