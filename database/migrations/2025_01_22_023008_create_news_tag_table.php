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
        Schema::create('news_tag', function (Blueprint $table) {
            $table->uuid('news_tag_id')->primary();  // UUID sebagai primary key
            $table->foreignUuid('news_id')->references('news_id')->on('news')->onDelete('cascade'); // Foreign key ke news
            $table->foreignUuid('tag_id')->references('tag_id')->on('tags')->onDelete('cascade'); // Foreign key ke tags
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_tag');
    }
};
