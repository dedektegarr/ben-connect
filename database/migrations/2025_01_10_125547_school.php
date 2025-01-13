<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('school', function (Blueprint $table) {
            $table->id('school_id');
            $table->enum('level', ['SD', 'SMP', 'SMA', 'SMK']);
            $table->foreignId('daerah_id')->constrained('daerah', 'daerah_id');
            $table->foreignId('category_id')->constrained('category', 'category_id');
            $table->integer('quantity');
            $table->foreignId('year_id')->constrained('dataset', 'dataset_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school');
    }
};
