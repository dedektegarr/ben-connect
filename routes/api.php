<?php

use App\Http\Controllers\Social\SocialCategoryController;
use App\Http\Controllers\Social\SocialController;
use App\Http\Controllers\Infrastructure\RoadController;
use App\Http\Controllers\Infrastructure\RoadCategoryController;
use App\Http\Controllers\Master\AreaController;
use App\Http\Controllers\Master\DatasetController;
use App\Http\Controllers\Master\TagsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SearchController;
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
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum', 'role:admin-infrastruktur')->group(function(){
    Route::resource('/master/area', AreaController::class);
    Route::resource('/master/dataset', DatasetController::class);
    Route::resource('/infrastructure/road/road-category', RoadCategoryController::class);
    Route::resource('/infrastructure/road', RoadController::class);
    Route::post('/infrastructure/road/filter', [RoadController::class, 'filterRoad']);

    // sementara untuk news
    Route::post('/news',[NewsController::class, 'store']);
    Route::get('/news/{news_id}',[NewsController::class, 'show']);
    Route::put('/news/{news_id}',[NewsController::class, 'update']);
    Route::delete('/news/{news_id}',[NewsController::class, 'destroy']);
});

//opd public dashboard sosial
Route::get('/dashboard/sosial', [SocialController::class, 'index_sosial']);
Route::get('/dashboard/socialcategori_filter', [SocialCategoryController::class, 'index_filter']);
Route::post('/dashboard/sosial/filter', [SocialController::class, 'filter']);
Route::get('/dashboard/kependudukan', [SocialController::class, 'index_akta']);
Route::post('/dashboard/kependudukan/filter', [SocialController::class, 'index_akta_filter']);

//opd CRUD Admin sosial
Route::middleware('auth:sanctum', 'role:admin-sosial')->group(function(){
    Route::resource('/master/area', AreaController::class);
    Route::resource('/master/dataset', DatasetController::class);
    Route::resource('/social/categorysocial', SocialCategoryController::class);
    Route::resource('/social', SocialController::class);
    Route::post('/infrastructure/road/filter', [RoadController::class, 'filtersocial']);
});

// route news
Route::get('/news', [NewsController::class, 'index']);

// route tag
Route::resource('/master/tag', TagsController::class);

Route::resource('/user', UserController::class);

Route::post('/search', [SearchController::class, 'searchByKeyword']);

//opd public dashboard sosial
Route::get('/dashboard/sosial', [SocialController::class, 'index_sosial']);
Route::get('/dashboard/socialcategori_filter', [SocialCategoryController::class, 'index_filter']);
Route::post('/dashboard/sosial/filter', [SocialController::class, 'filter']);
Route::get('/dashboard/kependudukan', [SocialController::class, 'index_akta']);
Route::post('/dashboard/kependudukan/filter', [SocialController::class, 'index_akta_filter']);

//opd CRUD Admin sosial
Route::middleware('auth:sanctum', 'role:admin-sosial')->group(function(){
    Route::resource('/master/area', AreaController::class);
    Route::resource('/master/dataset', DatasetController::class);
    Route::resource('/social/categorysocial', SocialCategoryController::class);
    Route::resource('/social', SocialController::class);
    Route::post('/infrastructure/road/filter', [RoadController::class, 'filtersocial']);
});