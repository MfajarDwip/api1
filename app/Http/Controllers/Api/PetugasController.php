<?php

namespace App\Http\Controllers\Api;

use App\Models\Petugas;
use App\Http\Controllers\Controller;
use App\Http\Resources\PetugasResource;

class PetugasController extends Controller
{
    public function petugas()
    {
        $petugasData = Petugas::all();

        foreach ($petugasData as $petugas) {
            $petugas->foto_petugas = base64_encode($petugas->foto_petugas);
        }

        return new PetugasResource(true, 'List Data petugas', $petugasData);
    }
}
