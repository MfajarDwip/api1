<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_penduduk',
        'id_layanan',
        'tgl_pengajuan',
        'status',
        'catatan',
        'id_rt',
        'id_rw',
        'id_admin',
    ];

    protected $table = 'pengajuan';
}
