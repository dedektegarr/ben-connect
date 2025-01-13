<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DaerahController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\MeanStudyController;
use App\Http\Controllers\SchoolController;
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

// Routes dari OPDPendidikan
Route::apiResource('/opd/daerah', DaerahController::class);
Route::apiResource('/opd/dataset', DatasetController::class);
Route::apiResource('/opd/pendidikan/category', CategoryController::class);
Route::apiResource('/opd/pendidikan/school', SchoolController::class);
Route::post('/opd/pendidikan/school/filter', [SchoolController::class, 'filter']);
Route::apiResource('/opd/pendidikan/meanstudy', MeanStudyController::class);
Route::post('/opd/pendidikan/meanstudy/filter', [MeanStudyController::class, 'filter']);

// Routes dari main
Route::resource('/master/daerah', DaerahController::class);
Route::resource('/master/tahun-data', TahunDataController::class);
Route::resource('/infrastruktur/jalan/kategori-jalan', KategoriJalanController::class);
Route::resource('/infrastruktur/jalan', JalanController::class);
Route::get('/infrastruktur/jalan/filter-jalan/{tahun_id}/{daerah_id?}', [JalanController::class, 'filterJalan']);
