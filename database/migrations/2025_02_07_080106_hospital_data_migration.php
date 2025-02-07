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
        Schema::create('hospital_data', function (Blueprint $table) {
            $table->uuid('hospital_data_id')->primary();
            $table->string('hospital_data_name');
            $table->string('hospital_data_nib');
            $table->foreignUuid('category_hospital_id')->references('category_hospital_id')->on('category_hospital')->onDelete('cascade');
            $table->foreignUuid('hospital_acreditation_id')->references('hospital_acreditation_id')->on('hospital_acreditation')->onDelete('cascade');
            $table->enum('hospital_data_class',['A','B','C','D','-'])->default('-');
            $table->foreignUuid('region_id')->references('region_id')->on('region')->onDelete('cascade');
            $table->foreignUuid('hospital_ownership_id')->references('hospital_ownership_id')->on('hospital_ownership')->onDelete('cascade');
            $table->string('hospital_data_telp');
            $table->string('hospital_data_email');
            $table->double('hospital_data_longitude');
            $table->double('hospital_data_latitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_data');
    }
};
