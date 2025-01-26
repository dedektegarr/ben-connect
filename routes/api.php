<?php

use App\Http\Controllers\Infrastructure\RoadController;
use App\Http\Controllers\Infrastructure\RoadCategoryController;
use App\Http\Controllers\Komoditi\BahanPokokController;
use App\Http\Controllers\Komoditi\KomoditiController;
use App\Http\Controllers\Komoditi\PasarController;
use App\Http\Controllers\Master\AreaController;
use App\Http\Controllers\Master\DatasetController;
use App\Http\Controllers\Master\TagsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Social\SocialCategoryController;
use App\Http\Controllers\Social\SocialController;
use App\Http\Controllers\Study\SchoolController;
use App\Http\Controllers\Study\SchoolFilterController;
use App\Http\Controllers\Study\SchoolLevelController;
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


Route::middleware('auth:sanctum')->group(function () {
    // User Route
    Route::controller(UserController::class)->group(function(){
        Route::get('/user/daftar-user', 'index')->middleware('permission:user.get');
        Route::get('/user/data-user/{id}', 'show')->middleware('permission:user.get-by-id');
        Route::post('/user/tambah', 'store')->middleware('permission:user.create');
        Route::put('/user/ubah/{id}', 'update')->middleware('permission:user.update');
        Route::delete('/user/hapus/{id}', 'destroy')->middleware('permission:user.delete');
        Route::put('/user/ubah-password', 'updatePassword')->middleware('permission:user.update-password');
    });
    // Master Data Route

    // Dataset
    Route::controller(DatasetController::class)->group(function(){
        Route::get('/dataset/daftar-dataset', 'index')->middleware('permission:dataset.get');
        Route::get('/dataset/data-dataset/{id}', 'show')->middleware('permission:dataset.get-by-id');
        Route::post('/dataset/tambah', 'store')->middleware('permission:dataset.create');
        Route::put('/dataset/ubah/{id}', 'update')->middleware('permission:dataset.update');
        Route::delete('/dataset/hapus/{id}', 'delete')->middleware('permission:dataset.delete');
    });
   // Area (Wilayah)
    Route::controller(AreaController::class)->group(function(){
        Route::get('/wilayah/daftar-wilayah', 'index')->middleware('permission:wilayah.get');
        Route::get('/wilayah/data-wilayah/{id}', 'show')->middleware('permission:wilayah.get-by-id');
        Route::post('/wilayah/tambah', 'store')->middleware('permission:wilayah.create');
        Route::put('/wilayah/ubah/{id}', 'update')->middleware('permission:wilayah.update');
        Route::delete('/wilayah/hapus/{id}', 'delete')->middleware('permission:wilayah.delete');
    });
    //Berita
    Route::controller(NewsController::class)->group(function(){
        Route::get('/berita/daftar-berita', 'index')->middleware('permission:news.get');
        Route::get('/berita/data-berita/{id}', 'show')->middleware('permission:news.get-by-id');
        Route::post('/berita/tambah', 'store')->middleware('permission:news.create');
        Route::put('/berita/ubah/{id}', 'update')->middleware('permission:update');
        Route::delete('/berita/hapus/{id}', 'destroy')->middleware('permission:delete');
    });
    //Infrastruktur
    
});

Route::middleware('auth:sanctum', 'role:admin-infrastruktur')->group(function(){
    Route::resource('/infrastructure/road/road-category', RoadCategoryController::class);
    Route::resource('/infrastructure/road', RoadController::class);
    Route::post('/infrastructure/road/filter', [RoadController::class, 'filterRoad']);
});

//CRUD Admin OPD sosial
Route::middleware('auth:sanctum', 'role:admin-sosial')->group(function(){
    Route::resource('/master/area', AreaController::class);
    Route::resource('/master/dataset', DatasetController::class);
    Route::resource('/social/categorysocial', SocialCategoryController::class);
    Route::resource('/social', SocialController::class);
});

//CRUD Admin OPD DISPERINDAG(Komoditas)
Route::middleware('auth:sanctum', 'role:admin-disperindag')->group(function(){
    Route::resource('/master/area', AreaController::class);
    Route::resource('/master/dataset', DatasetController::class);
    Route::resource('/komoditi/pasar', PasarController::class);
    Route::resource('/komoditi/komoditi', KomoditiController::class);
    Route::resource('/komoditi/bahan-pokok', BahanPokokController::class);
});

// CRUD Admin OPD Pendidikan
Route::middleware('auth:sanctum', 'role:admin-pendidikan')->group(function(){
    Route::resource('/master/area', AreaController::class);
    Route::resource('/master/dataset', DatasetController::class);
    Route::resource('/pendidikan/jenjang-sekolah', SchoolLevelController::class);
    Route::resource('/pendidikan/sekolah', SchoolController::class);
    Route::resource('/pendidikan/rekap-data-sekolah', SchoolFilterController::class);
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



// =====================OPD PENDIDIKAN dashboard==============================
Route::get('/pendidikan/dashboard', [SchoolFilterController::class, 'filter']);
