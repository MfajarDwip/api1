<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('petugas', function (Blueprint $table) {
            $table->id('id'); 
            $table->string('nama_petugas', 25); 
            $table->char('no_hp', 13);
            $table->string('alamat', 25); 
            $table->string('email', 50); 
            $table->enum('role', ['RT', 'RW']);
            $table->string('wilayah', 100); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('petugas');
    }
};

