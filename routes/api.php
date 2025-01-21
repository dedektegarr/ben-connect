<?php

use App\Http\Controllers\Infrastructure\RoadController;
use App\Http\Controllers\Infrastructure\RoadCategoryController;
use App\Http\Controllers\Master\AreaController;
use App\Http\Controllers\Master\DatasetController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
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

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');;

Route::middleware('auth:sanctum', 'role:admin-infrastruktur')->group(function(){
    Route::resource('/master/area', AreaController::class);
    Route::resource('/master/dataset', DatasetController::class);
    Route::resource('/infrastructure/road/road-category', RoadCategoryController::class);
    Route::resource('/infrastructure/road', RoadController::class);
    Route::post('/infrastructure/road/filter', [RoadController::class, 'filterRoad']);

    // sementara
    Route::post('/news',[NewsController::class, 'store']);
    Route::get('/news/{news_id}',[NewsController::class, 'show']);
});

// route news
Route::get('/news', [NewsController::class, 'index']);

Route::resource('/user', UserController::class);