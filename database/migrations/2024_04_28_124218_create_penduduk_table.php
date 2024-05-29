<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendudukTable extends Migration
{
    public function up()
    {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user'); 
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->string('nama_lengkap', 50);
            $table->string('no_hp', 20)->nullable(); 
            $table->string('alamat', 100)->nullable();
            $table->string('jenis_kelamin')->nullable(); 
            $table->string('tempat_lahir')->nullable(); 
            $table->date('tanggal_lahir')->nullable(); 
            $table->string('kebangsaan')->nullable(); 
            $table->string('pekerjaan')->nullable(); 
            $table->string('golongan_darah')->nullable(); 
            $table->string('status_nikah')->nullable(); 
            $table->string('foto_profil')->nullable(); 
            $table->string('nik')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penduduk');
    }
}
