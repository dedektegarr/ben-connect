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
        Schema::create('irrigations', function (Blueprint $table) {
            $table->uuid("irrigation_id");
            $table->string("daerah");
            $table->foreignUuid("region_id")->references("region_id")->on("region")->cascadeOnDelete();
            $table->double("luas_potensial");
            $table->double("luas_fungsional");
            $table->double("panjang_saluran");
            $table->text("keterangan")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irrigations');
    }
};
