<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_penduduk');
            $table->foreign('id_penduduk')->references('id')->on('penduduk')->onDelete('cascade');
            $table->unsignedBigInteger('id_layanan');
            $table->foreign('id_layanan')->references('id')->on('layanan')->onDelete('cascade');
            $table->date('tgl_pengajuan');
            $table->enum('status', ['Diproses', 'Diterima', 'Ditolak']);
            $table->unsignedBigInteger('id_rt');
            $table->foreign('id_rt')->references('id')->on('petugas')->onDelete('cascade');
            $table->unsignedBigInteger('id_rw');
            $table->foreign('id_rw')->references('id')->on('petugas')->onDelete('cascade');
            $table->unsignedBigInteger('id_admin');
            $table->foreign('id_admin')->references('id')->on('admin')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
