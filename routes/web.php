<?php

use App\Http\Controllers\Web\Admin\Industri\IKMController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackOffice\LoginController;
use App\Http\Controllers\FrontOffice\PageController;
use App\Http\Controllers\BackOffice\PageAdminController;
use App\Http\Controllers\FrontOffice\DashboardBerandaController;
use App\Http\Controllers\FrontOffice\DashboardKomoditasController;
use App\Http\Controllers\FrontOffice\DashboardSosialController;
use App\Http\Controllers\FrontOffice\DashboardBencanaController;
use App\Http\Controllers\FrontOffice\DashboardKesehatanController;
use App\Http\Controllers\FrontOffice\DashboardPendidikanController;
use App\Http\Controllers\FrontOffice\DashboardInfrastrukturController;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\Industri\IndustriNasional;
use App\Http\Controllers\Web\Admin\Industri\KomoditasController;
use App\Http\Controllers\Web\Admin\Industri\IndustriNasionalController;
use App\Http\Controllers\Web\Admin\Infrastruktur\CiptakaryaController;
use App\Http\Controllers\Web\Admin\Infrastruktur\IrigasiController;
use App\Http\Controllers\Web\Admin\Infrastruktur\JalanController;
use App\Http\Controllers\Web\Admin\Infrastruktur\JembatanController;
use App\Http\Controllers\Web\Admin\Kesehatan\RSUDController;
use App\Http\Controllers\Web\Admin\Kesehatan\RumahSakitController;
use App\Http\Controllers\Web\Admin\Ketenagakerjaan\DisnakerController;
use App\Http\Controllers\Web\Admin\Pendidikan\JumlahGuruController;
use App\Http\Controllers\Web\Admin\Pendidikan\JumlahPesertaDidikController;
use App\Http\Controllers\Web\Admin\Pendidikan\JumlahSekolahController;
use App\Http\Controllers\Web\Admin\Penduduk\JumlahPendudukController;
use App\Http\Controllers\Web\Admin\Sosial\DatabansosController;

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
Route::get('/dashboard/beranda', [DashboardBerandaController::class, 'index'])->name('beranda.dashboard');
Route::get('/dashboard/pendidikan', [DashboardPendidikanController::class, 'index'])->name('pendidikan.dashboard');
Route::get('/dashboard/sosial', [DashboardSosialController::class, 'index'])->name('sosial.dashboard');
Route::get('/dashboard/kependudukan', [DashboardSosialController::class, 'kependudukan'])->name('kependudukan.dashboard');
Route::get('/dashboard/infrastruktur-jalan', [DashboardInfrastrukturController::class, 'index_jalan'])->name('infrastruktur-jalan.dashboard');
Route::get('/dashboard/bencana', [DashboardBencanaController::class, 'index'])->name('bencana.dashboard');
Route::get('/dashboard/komoditas', [DashboardKomoditasController::class, 'index'])->name('komoditas.dashboard');

// BACKOFFICE ===
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware("auth")->group(function () {
    // SUPER ADMIN
    Route::prefix("admin")->middleware("role:admin")->group(function () {
        // Dashboard
        Route::controller(DashboardController::class)->group(function () {
            Route::get("/dashboard", "index")->name("admin.dashboard.index");
        });


        // Pemerintahan
        Route::prefix("pemerintahan")->group(function () {
            Route::get("/visi-misi", function () {
                return view("admin.pemerintahan.visimisi"); // ✅ Tambahkan path view yang benar
            })->name("admin.pemerintahan.visimisi");
        });


        // Kependudukan
        Route::prefix("kependudukan")->group(function () {
            Route::get("/statistik", [JumlahPendudukController::class, "statistikPenduduk"])->name("admin.kependudukan.statistik");
            Route::prefix("jumlah-penduduk")->controller(JumlahPendudukController::class)->group(function () {
                Route::get("/", "index")->name("admin.kependudukan.jumlah-penduduk.index");
                Route::post("/import", "import")->name("admin.kependudukan.jumlah-penduduk.import");
            });
        });

        // Industri & Perdagangan
        Route::prefix("perindustrian")->group(function () {
            Route::prefix("industri-nasional")->controller(IndustriNasionalController::class)->group(function () {
                Route::get("/", "index")->name("admin.perindustrian.industri-nasional.index");
                Route::post("/import", "import")->name("admin.perindustrian.industri-nasional.import");
            });

            Route::prefix("ikm")->controller(IKMController::class)->group(function () {
                Route::get("/", "index")->name("admin.perindustrian.ikm.index");
                Route::post("/import", "import")->name("admin.perindustrian.ikm.import");
            });

            Route::prefix("komoditas")->controller(KomoditasController::class)->group(function () {
                Route::get("/", "index")->name("admin.perindustrian.komoditas.index");
                Route::post("/import", "import")->name("admin.perindustrian.komoditas.import");
            });
        });

        // Kesehatan
        Route::prefix("kesehatan")->group(function () {
            Route::controller(RSUDController::class)->group(function () {
                Route::get("/rsud/kunjungan", "kunjungan")->name("admin.kesehatan.rsud.kunjungan");
                Route::get("/rsud/ketersediaan-kamar", "kamar")->name("admin.kesehatan.rsud.kamar");
                Route::get("/rsud/pelayanan-poli", "poli")->name("admin.kesehatan.rsud.poli");
                Route::post("/rsud/synchronize", "synchronize")->name("admin.kesehatan.rsud.synchronize");
            });

            Route::prefix("rumah-sakit")->controller(RumahSakitController::class)->group(function () {
                Route::get("/", "index")->name("admin.kesehatan.rs.index");
                Route::post("/import", "import")->name("admin.kesehatan.rs.import");
            });
        });

        // Pendidikan
        Route::prefix("pendidikan")->group(function () {
            Route::prefix("sekolah")->controller(JumlahSekolahController::class)->group(function () {
                Route::get("/", "index")->name("admin.pendidikan.sekolah.index");
                Route::post("/import", "import")->name("admin.pendidikan.sekolah.import");
            });
            Route::prefix("guru")->controller(JumlahGuruController::class)->group(function () {
                Route::get("/", "index")->name("admin.pendidikan.guru.index");
                Route::post("/import", "import")->name("admin.pendidikan.guru.import");
            });
            Route::prefix("peserta-didik")->controller(JumlahPesertaDidikController::class)->group(function () {
                Route::get("/", "index")->name("admin.pendidikan.peserta-didik.index");
                Route::post("/import", "import")->name("admin.pendidikan.peserta-didik.import");
            });
        });
        // infrastruktur
        Route::prefix("infrastruktur")->group(function () {
            Route::prefix("jalan")->controller(JalanController::class)->group(function () {
                Route::get("/", "index")->name("admin.infrastruktur.jalan.index");
                Route::post("/import", "import")->name("admin.infrastruktur.jalan.import");
            });

            Route::prefix("irigasi")->controller(IrigasiController::class)->group(function () {
                Route::get("/", "index")->name("admin.infrastruktur.irigasi.index");
                Route::post("/import", "import")->name("admin.infrastruktur.irigasi.import");
            });

            Route::prefix("jembatan")->controller(JembatanController::class)->group(function () {
                Route::get("/", "index")->name("admin.infrastruktur.jembatan.index");
                Route::post("/import", "import")->name("admin.infrastruktur.jembatan.import");
            });
            Route::prefix("ciptakarya")->controller(CiptakaryaController::class)->group(function () {
                Route::get("/", "index")->name("admin.infrastruktur.ciptakarya.index");
                Route::post("/import", "import")->name("admin.infrastruktur.ciptakarya.import");
            });
        });
        // sosial
        Route::prefix("sosial")->group(function () {
            Route::prefix("bansos")->controller(DatabansosController::class)->group(function () {
                Route::get("/", "index")->name("admin.sosial.databansos.index");
                Route::post("/import", "import")->name("admin.sosial.databansos.import");
            });
        });
        // ketenagakerjaan
        Route::prefix("ketenagakerjaan")->group(function () {
            Route::controller(DisnakerController::class)->group(function () {
                Route::post("/import", "import")->name("admin.ketenagakerjaan.import");

                Route::get("/wlkp", "wlkpIndex")->name("admin.ketenagakerjaan.wlkp.index");
                Route::get("/disnaker", "disnakerIndex")->name("admin.ketenagakerjaan.disnaker.index");
                Route::get("/pkt", "pktIndex")->name("admin.ketenagakerjaan.pkt.index");
                Route::get("/lkt", "lktIndex")->name("admin.ketenagakerjaan.lkt.index");
                Route::get("/ptk", "ptkIndex")->name("admin.ketenagakerjaan.ptk.index");

                Route::post("/upah-minimum-regional/import", "umrImport")->name("admin.ketenagakerjaan.umr.import");
                Route::get("/upah-minimum-regional", "umrIndex")->name("admin.ketenagakerjaan.umr.index");

            });
        });

    });
});
