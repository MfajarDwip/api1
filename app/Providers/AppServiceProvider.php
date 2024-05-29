<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('no_hp', function ($attribute, $value, $parameters, $validator) {
            // Lakukan validasi khusus untuk nomor handphone di sini
            // Misalnya, Anda ingin memeriksa apakah hanya terdiri dari angka
            // dan memiliki panjang minimal 12 dan maksimal 13
        
            // Memeriksa apakah nomor handphone hanya terdiri dari angka
            $isNumeric = preg_match('/^[0-9]+$/', $value);
        
            // Memeriksa panjang nomor handphone
            $length = strlen($value);
            $isWithinLength = $length >= 12 && $length <= 13;
        
            // Kembalikan true jika nomor handphone sesuai dengan kriteria
            return $isNumeric && $isWithinLength;
        });
        
           
    }
}