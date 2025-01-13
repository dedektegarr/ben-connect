<?php

use App\Http\Controllers\Master\DaerahController;
use App\Http\Controllers\Master\TahunDataController;
use App\Http\Controllers\Infrastruktur\JalanController;
use App\Http\Controllers\Infrastruktur\KategoriJalanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/master/daerah', DaerahController::class);
Route::resource('/master/tahun-data', TahunDataController::class);
Route::resource('/infrastruktur/jalan/kategori-jalan', KategoriJalanController::class);
Route::resource('/infrastruktur/jalan', JalanController::class);
Route::get('/infrastruktur/jalan/filter-jalan/{tahun_id}/{daerah_id?}', [JalanController::class, 'filterJalan']);
