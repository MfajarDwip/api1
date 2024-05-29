<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan', function (Blueprint $table) {
            $table->id('id'); 
            $table->char('nama_layanan', 25);
            $table->string('jenis_layanan', 50); 
            $table->string('info_layanan', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};

