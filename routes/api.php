<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FiturController;
use App\Http\Controllers\Api\PetugasController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class, 'createUser']);
Route::post('/login', [UserController::class, 'loginUser']);
Route::post('/gantipassword', [UserController::class, 'updateUserPassword']);
Route::post('/editdata', [UserController::class, 'updateUser']);
Route::post('/upload-image', [UserController::class, 'uploadImage']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('get_user', [UserController::class, 'getUserFromToken']);
    Route::put('/update_user', [UserController::class, 'updateUser']);
});

Route::get('formulir/{id_layanan}', [FiturController::class, 'getFormulirByLayanan']);
Route::get('/layanan', [FiturController::class, 'layanan']);
Route::get('/berita', [FiturController::class, 'berita']);
Route::get('/petugas', [PetugasController::class, 'petugas']);

Route::post('/pengajuan', [FiturController::class, 'kirimPengajuan']);
Route::get('riwayat/{id_penduduk}', [FiturController::class, 'fetchRiwayatPengajuan']);
