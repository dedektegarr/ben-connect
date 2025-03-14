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
        Schema::create('upah_minimums', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("region_id")->references("region_id")->on("region")->cascadeOnDelete();
            $table->year("year");
            $table->integer("salary");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upah_minimums');
    }
};
