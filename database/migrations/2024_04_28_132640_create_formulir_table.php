<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formulir', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_layanan'); 
            $table->foreign('id_layanan')->references('id')->on('layanan')->onDelete('cascade');
            $table->string('nama_formulir', 25); 
            $table->json('data_formulir');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formulir');
    }
};

