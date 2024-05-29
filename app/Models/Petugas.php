<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Petugas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_petugas',
        'no_hp',
        'alamat',
        'foto_petugas',
        'email',
    ];

    protected $table = 'petugas';
}
