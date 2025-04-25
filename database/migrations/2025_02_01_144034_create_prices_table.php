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
        Schema::create('prices', function (Blueprint $table) {
            $table->id('prices_id');
            $table->string('prices_value');
            $table->date('date');
            $table->foreignUuid('region_id')->references('region_id')->on('region')->onDelete('cascade');
            $table->foreignUuid('variants_id')->references('variants_id')->on('variants')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['region_id', 'variants_id', 'date'], 'unique_region_variant_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
