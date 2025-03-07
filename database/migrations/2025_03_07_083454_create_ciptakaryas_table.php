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
        Schema::create('ciptakaryas', function (Blueprint $table) {
            $table->uuid("ciptakarya_id");
            $table->string("indikator_sasaran");
            $table->double("target");
            $table->double("persentase_capaian");
            $table->string("faktor_pendorong");
            $table->string("faktor_penghambat");
            $table->string("rekom_tindak_lanjut");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciptakaryas');
    }
};
