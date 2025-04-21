<?php

use App\Http\Controllers\Kesehatan\RSUD\ApiRSUDController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Population\PopulationController;

// Kependudukan
Route::middleware(["guest"])->group(function () {
    Route::controller(PopulationController::class)->group(function () {
        Route::get('kependudukan/data', 'index');
        Route::get('kependudukan/detail/{id}', 'show');
    });

    Route::get('/kesehatan/kunjungan-harian', [ApiRSUDController::class, 'kunjunganHarian']);
});
