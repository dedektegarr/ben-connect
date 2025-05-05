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
        Schema::create('ikms', function (Blueprint $table) {
            $table->id('ikm_id');
            $table->string('ikm_ptname');
            $table->string('ikm_owner_name');
            $table->string('ikm_contact')->nullable();
            $table->string('ikm_sentra')->nullable();
            $table->string('ikm_address_street');
            $table->string('ikm_address_village');
            $table->string('ikm_address_subdistrict');
            $table->foreignUuid('region_id')->references('region_id')->on('region')->onDelete('cascade');
            $table->string('ikm_form');
            $table->string('ikm_number')->nullable();
            $table->string('ikm_kd_kbli');
            $table->string('ikm_category_product');
            $table->string('ikm_branch');
            $table->string('ikm_count');
            $table->string('year');
            $table->unique(['ikm_ptname', 'region_id', 'year'], 'unique_ikm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ikms');
    }
};
