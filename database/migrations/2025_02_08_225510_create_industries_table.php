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
        Schema::create('industries', function (Blueprint $table) {
            $table->id('industry_id');
            $table->string('industry_ptname');
            $table->string('industry_headoffice_address');
            $table->string('industry_office_province');
            $table->string('industry_city_office');
            $table->string('industry_factory_address');
            $table->string('industry_factory_province');
            $table->foreignUuid('region_id')->references('region_id')->on('region')->onDelete('cascade');
            $table->string('industry_kd_kbli')->nullable();
            $table->string('industry_business_fields')->nullable();
            $table->string('industry_business_scale');
            $table->enum('industry_registered_sinas', ['Ya', 'Tidak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industries');
    }
};
