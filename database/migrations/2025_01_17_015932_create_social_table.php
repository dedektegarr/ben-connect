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
            $table->id('social_id');
            $table->foreignUuid('region_id')->references('region_id')->on('region')->onDelete('cascade');
            $table->foreignUuid('dataset_id')->references('dataset_id')->on('dataset')->onDelete('cascade');
            $table->foreignUuid('social_category_id')->references('social_category_id')->on('social_category')->onDelete('cascade');
            $table->float('have')->nullable();
            $table->float('nothing')->nullable();
            $table->date('date_notice')->nullable();
            $table->float('count')->nullable();
            $table->timestamps();
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
