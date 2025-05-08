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
            $table->string('industry_ptname')->nullable();
            $table->string('industry_headoffice_address')->nullable();
            $table->string('industry_office_province')->nullable();
            $table->string('industry_city_office')->nullable();
            $table->text('industry_factory_address')->nullable();
            $table->string('industry_factory_province')->nullable();
            $table->foreignUuid('region_id')->references('region_id')->on('region')->onDelete('cascade');
            $table->string('industry_kd_kbli')->nullable();
            $table->text('industry_business_fields')->nullable();
            $table->year('year');
            $table->string('industry_business_scale')->nullable();
            $table->string('industry_registered_sinas')->nullable();
            $table->unique(['industry_ptname', 'industry_business_scale', 'region_id', 'year'], 'unique_industry');
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
