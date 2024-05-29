<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berkas_pengajuan', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_pengajuan'); 
            $table->foreign('id_pengajuan')->references('id')->on('pengajuan')->onDelete('cascade'); 
            $table->string('nama_field', 100);
            $table->string('value', 100);
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berkas_pengajuan');
    }
};
