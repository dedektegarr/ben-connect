<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackOffice\LoginController;
use App\Http\Controllers\FrontOffice\PageController;
use App\Http\Controllers\BackOffice\PageAdminController;
use App\Http\Controllers\FrontOffice\DashboardKomoditasController;
use App\Http\Controllers\FrontOffice\DashboardSosialController;
use App\Http\Controllers\FrontOffice\DashboardBencanaController;
use App\Http\Controllers\FrontOffice\DashboardKesehatanController;
use App\Http\Controllers\FrontOffice\DashboardPendidikanController;
use App\Http\Controllers\FrontOffice\DashboardInfrastrukturController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/syarat-ketentuan', [PageController::class, 'syarat_ketentuan'])->name('syarat');
Route::get('/tentang-kami', [PageController::class, 'tentang'])->name('tentang');
Route::get('/feedback', [PageController::class, 'feedback'])->name('feedback');
Route::get('/opd', [PageController::class, 'opd'])->name('opd');
Route::get('/dashboard/kesehatan', [DashboardKesehatanController::class, 'index'])->name('kesehatan.dashboard');
Route::get('/dashboard/pendidikan', [DashboardPendidikanController::class, 'index'])->name('pendidikan.dashboard');
Route::get('/dashboard/sosial', [DashboardSosialController::class, 'index'])->name('sosial.dashboard');
Route::get('/dashboard/kependudukan', [DashboardSosialController::class, 'kependudukan'])->name('kependudukan.dashboard');
Route::get('/dashboard/infrastruktur-jalan', [DashboardInfrastrukturController::class, 'index_jalan'])->name('infrastruktur-jalan.dashboard');
Route::get('/dashboard/bencana', [DashboardBencanaController::class, 'index'])->name('bencana.dashboard');
Route::get('/dashboard/komoditas', [DashboardKomoditasController::class, 'index'])->name('komoditas.dashboard');


// BACKOFFICE ===
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [PageAdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/pendidikan', [PageAdminController::class, 'pendidikan'])->name('pendidikan');
    Route::get('/admin/kesehatan-maps', [PageAdminController::class, 'kesehatan_maps'])->name('kesehatan_maps');
    Route::get('/admin/kesehatan', [PageAdminController::class, 'kesehatan'])->name('kesehatan');
    Route::get('/admin/kependudukan', [PageAdminController::class, 'kependudukan'])->name('kependudukan');
    Route::get('/admin/bencana', [PageAdminController::class, 'bencana'])->name('bencana');
    Route::get('/admin/komoditas', [PageAdminController::class, 'komoditas'])->name('komoditas');
    Route::get('/admin/infrastruktur', [PageAdminController::class, 'infrastruktur'])->name('infrastruktur');
    Route::get('/admin/keuangan', [PageAdminController::class, 'keuangan'])->name('keuangan');
    Route::post('/admin/mode', [PageAdminController::class, 'mode_dark_light'])->name('mode');
});
