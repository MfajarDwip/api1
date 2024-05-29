<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulir extends Model
{
    protected $table = 'formulir';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = ['nama_lengkap', 'alamat'];
}