<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DaerahController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\MeanStudyController;
use App\Http\Controllers\SchoolController;
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

// Daerah
Route::apiResource('/opd/daerah',DaerahController::class);
// Dataset
Route::apiResource('/opd/dataset',DatasetController::class);
// Category
Route::apiResource('/opd/pendidikan/category',CategoryController::class);
// School
Route::apiResource('/opd/pendidikan/school',SchoolController::class);
Route::post('/opd/pendidikan/school/filter', [SchoolController::class, 'filter']);
// Mean Study
Route::apiResource('/opd/pendidikan/meanstudy',MeanStudyController::class);
Route::post('/opd/pendidikan/meanstudy/filter', [MeanStudyController::class, 'filter']);
