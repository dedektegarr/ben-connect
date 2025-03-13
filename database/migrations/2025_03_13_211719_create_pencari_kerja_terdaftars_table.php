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
        Schema::create('pencari_kerja_terdaftars', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("region_id")->references("region_id")->on("region")->cascadeOnDelete();
            $table->integer("male");
            $table->integer("female");
            $table->year("year");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencari_kerja_terdaftars');
    }
};
