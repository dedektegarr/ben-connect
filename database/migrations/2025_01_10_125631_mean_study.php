<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mean_study', function (Blueprint $table) {
            $table->id('mean_study_id');
            $table->foreignId('daerah_id')->constrained('daerah', 'daerah_id');
            $table->foreignId('category_id')->constrained('category', 'category_id');
            $table->integer('quantity', false, true);
            $table->foreignId('year_id')->constrained('dataset', 'dataset_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mean_study');
    }
};
