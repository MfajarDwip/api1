<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id('id');
            $table->string('judul_berita', 100);
            $table->binary('foto_berita');
            $table->string('isi_berita', 1000);
            $table->datetime('tgl_berita');
            $table->unsignedBigInteger('id_admin'); 
            $table->foreign('id_admin')->references('id')->on('admin')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
