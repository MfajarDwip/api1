<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasPengajuan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pengajuan',
        'nama_field',
        'value',
    ];

    protected $table = 'berkas_pengajuan';
}
