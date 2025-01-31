<?php

use App\Http\Controllers\Infrastructure\RoadController;
use App\Http\Controllers\Infrastructure\RoadCategoryController;
use App\Http\Controllers\Master\DatasetController;
use App\Http\Controllers\Master\TagsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Population\PopulationAgeGroupController;
use App\Http\Controllers\Population\PopulationController;
use App\Http\Controllers\Population\PopulationPeriodController;
use App\Http\Controllers\Region\RegionController;
use App\Http\Controllers\Region\RegionDataController;
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
    // User Route (FIX)
    Route::controller(UserController::class)->group(function(){
        Route::get('/user/data', 'index')->middleware('permission:user.get');
        Route::get('/user/detail/{id}', 'show')->middleware('permission:user.get-by-id');
        Route::post('/user/register', 'store')->middleware('permission:user.register');
        Route::put('/user/ubah/{id}', 'update')->middleware('permission:user.update');
        Route::delete('/user/hapus/{id}', 'destroy')->middleware('permission:user.delete');
        Route::put('/user/ubah-password', 'updatePassword')->middleware('permission:user.update-password');
    });

    //Region routes (FIX)
    Route::controller(RegionController::class)->group(function(){
        Route::get('/wilayah/data', 'index');
        Route::get('/wilayah/detail/{id}', 'show');
        Route::post('/wilayah/tambah', 'store');
        Route::put('/wilayah/ubah/{id}', 'update');
        Route::delete('/wilayah/hapus/{id}', 'destroy');
    });

    //Region Data Routes (FIX)
    Route::controller(RegionDataController::class)->group(function(){
        Route::get('/wilayah/data-wilayah/data', 'index');
        Route::get('/wilayah/data-wilayah/detail/{id}', 'show');
        Route::post('/wilayah/data-wilayah/tambah', 'store');
        Route::post('/wilayah/data-wilayah/ubah', 'update');
        Route::delete('/wilayah/data-wilayah/hapus/{id}', 'destroy');
    });

     //Population Routes
     Route::controller(PopulationController::class)->group(function(){
        Route::post('/xx/import', 'stored');
    });

    //Population Period Routes (FIX)
    Route::controller(PopulationPeriodController::class)->group(function(){
        Route::get('/kependudukan/periode-data/data', 'index');
        Route::get('/kependudukan/periode-data/detail/{id}', 'show');
        Route::post('/kependudukan/periode-data/tambah', 'store');
        Route::put('/kependudukan/periode-data/ubah/{id}', 'update');
        Route::delete('/kependudukan/periode-data/hapus/{id}', 'destroy');
    });

    //Population Group Age Routes (FIX)
    Route::controller(PopulationAgeGroupController::class)->group(function(){
        Route::get('/kependudukan/kelompok-umur/data', 'index');
        Route::get('/kependudukan/kelompok-umur/detail/{id}', 'show');
        Route::post('/kependudukan/kelompok-umur/tambah', 'store');
        Route::put('/kependudukan/kelompok-umur/ubah/{id}', 'update');
        Route::delete('/kependudukan/kelompok-umur/hapus/{id}', 'destroy');
    });

   

    // Dataset
    Route::controller(DatasetController::class)->group(function(){
        Route::get('/dataset/daftar-dataset', 'index')->middleware('permission:dataset.get');
        Route::get('/dataset/data-dataset/{id}', 'show')->middleware('permission:dataset.get-by-id');
        Route::post('/dataset/tambah', 'store')->middleware('permission:dataset.create');
        Route::put('/dataset/ubah/{id}', 'update')->middleware('permission:dataset.update');
        Route::delete('/dataset/hapus/{id}', 'delete')->middleware('permission:dataset.delete');
    });
    //Berita
    Route::controller(NewsController::class)->group(function(){
        Route::get('/berita/daftar-berita', 'index')->middleware('permission:news.get');
        Route::get('/berita/data/{id}', 'show')->middleware('permission:news.get-by-id');
        Route::post('/berita/tambah', 'store')->middleware('permission:news.create');
        Route::put('/berita/ubah/{id}', 'update')->middleware('permission:update');
        Route::delete('/berita/hapus/{id}', 'destroy')->middleware('permission:delete');
    });

    // Pendidikan
    // Route::controller(SchoolController::class)->group(function(){
    //     Route::resource('/pendidikan/jenjang-sekolah', SchoolLevelController::class);
    //     Route::resource('/pendidikan/sekolah', SchoolController::class);
    // });
});
Route::resource('/population-period', PopulationPeriodController::class);
Route::middleware('auth:sanctum', 'role:admin-infrastruktur')->group(function(){
    Route::resource('/infrastructure/road/road-category', RoadCategoryController::class);
    Route::resource('/infrastructure/road', RoadController::class);
    Route::post('/infrastructure/road/filter', [RoadController::class, 'filterRoad']);
});

Route::resource('/pendidikan/rekap-data-sekolah', SchoolFilterController::class);
// //CRUD Admin OPD sosial
// Route::middleware('auth:sanctum', 'role:admin-sosial')->group(function(){
//     Route::resource('/master/region', RegionController::class);
//     Route::resource('/master/dataset', DatasetController::class);
//     Route::resource('/social/categorysocial', SocialCategoryController::class);
//     Route::resource('/social', SocialController::class);
// });

// CRUD Admin OPD Pendidikan
Route::middleware('auth:sanctum', 'role:admin-pendidikan')->group(function(){
    Route::resource('/pendidikan/jenjang-sekolah', SchoolLevelController::class);
    Route::resource('/pendidikan/sekolah', SchoolController::class);
    Route::resource('/pendidikan/rekap-data-sekolah', SchoolFilterController::class);
});

// route news
Route::get('/news', [NewsController::class, 'index']);

// route tag
Route::resource('/master/tag', TagsController::class);

Route::post('/search', [SearchController::class, 'searchByKeyword']);

//opd public dashboard sosial
Route::get('/dashboard/sosial', [SocialController::class, 'index_sosial']);
Route::get('/dashboard/socialcategori_filter', [SocialCategoryController::class, 'index_filter']);
Route::post('/dashboard/sosial/filter', [SocialController::class, 'filter']);
Route::get('/dashboard/kependudukan', [SocialController::class, 'index_akta']);
Route::post('/dashboard/kependudukan/filter', [SocialController::class, 'index_akta_filter']);



// =====================OPD PENDIDIKAN dashboard==============================
Route::get('/pendidikan/dashboard', [SchoolFilterController::class, 'filter']);
