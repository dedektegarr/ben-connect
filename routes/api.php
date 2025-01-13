<?php

use App\Http\Controllers\AktaController;
use App\Http\Controllers\AngkaKemiskinanController;
use App\Http\Controllers\DaerahController;
use App\Http\Controllers\PembangunanGenderController;
use App\Http\Controllers\PembangunanManusiaController;
use App\Http\Controllers\PemberdayaanGenderController;
use App\Http\Controllers\TahunController;
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

Route::apiResource('daerah', DaerahController::class);
Route::apiResource('tahun', TahunController::class);
Route::apiResource('akta', AktaController::class);
Route::apiResource('angka-kemiskinan', AngkaKemiskinanController::class);
Route::apiResource('pembangunan-gender', PembangunanGenderController::class);
Route::apiResource('pembangunan-manusia', PembangunanManusiaController::class);
Route::apiResource('pemberdayaan-gender', PemberdayaanGenderController::class);