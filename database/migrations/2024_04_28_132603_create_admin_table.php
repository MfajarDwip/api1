<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_admin', 50);
            $table->string('email', 20);
            $table->char('password', 8);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
