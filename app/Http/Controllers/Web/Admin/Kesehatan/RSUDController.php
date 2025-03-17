<?php

namespace App\Http\Controllers\Web\Admin\Kesehatan;

use Exception;
use Carbon\Carbon;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RSUDController extends Controller
{
    private $apiClient;
    private $rsClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
        $this->rsClient = new ApiClient(env("APP_BASE_URL_RSUD"), null, ["x-token" => env("APP_X_TOKEN")]);
    }

    public function kunjungan()
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        $bulanSekarang = Carbon::now();
        $bulanTerakhir = collect(range(0, 7))->map(function ($i) use ($bulanSekarang) {
            return $bulanSekarang->copy()->subMonths($i)->translatedFormat('F');
        })->reverse()->values()->toArray();

        try {
            $kunjunganHarian = $this->apiClient->get("/kesehatan/kunjungan-harian");
            $kunjunganBulanan = $this->apiClient->get("/kesehatan/kunjungan-bulanan");

            if ($kunjunganHarian["status_code"] === 200) {
                $harian = collect($kunjunganHarian["data"])->map(function ($data) {
                    return [
                        "tanggal" => Carbon::parse($data["kunjungan_harian_tanggal"])->translatedFormat("l, d F Y"),
                        "tanggal_short" => Carbon::parse($data["kunjungan_harian_tanggal"])->translatedFormat("d"),
                        "pasien_lama" => $data["kunjungan_harian_pasien_lama"],
                        "pasien_baru" => $data["kunjungan_harian_pasien_baru"],
                    ];
                });

                // Urutkan berdasarkan daftar bulan terakhir
                $bulanan = collect($kunjunganBulanan["data"])->map(function ($data) {
                    return [
                        "bulan" => Carbon::create()->month($data["kunjungan_bulanan_bulan"])->translatedFormat("F"),
                        "tahun" => $data["kunjungan_bulanan_tahun"],
                        "pasien_lama" => $data["kunjungan_bulanan_pasien_lama"],
                        "pasien_baru" => $data["kunjungan_bulanan_pasien_baru"],
                    ];
                })->sortBy(function ($item) use ($bulanTerakhir) {
                    return array_search($item["bulan"], $bulanTerakhir);
                })->values();

                // Calculate totals
                $total_kunjungan = $harian->sum(function ($data) {
                    return $data['pasien_baru'] + $data['pasien_lama'];
                });

                $total_pasien_baru = $harian->sum('pasien_baru');
                $total_pasien_lama = $harian->sum('pasien_lama');

                return view("admin.kesehatan.rsud.kunjungan", [
                    "kunjungan_harian" => $harian,
                    "kunjungan_bulanan" => $bulanan,
                    "total_kunjungan" => $total_kunjungan,
                    "total_pasien_baru" => $total_pasien_baru,
                    "total_pasien_lama" => $total_pasien_lama,
                ]);
            }

            throw new Exception("Terjadi Kesalahan");
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }

    public function kamar()
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $kamar = $this->rsClient->get("/cc/getKetersediaanKamar");

            $kamar = collect($kamar)->map(function ($item) {
                return [
                    "Kapasitas" => $item["cap"],
                    "Kelas_kamar" => $item["name_of_clinic"],
                    "Terisi" => $item["ISI"]
                ];
            })->filter(function ($item) {
                return $item["Kapasitas"] > 0;
            })->sortByDesc("Kapasitas")->toArray();

            return view("admin.kesehatan.rsud.kamar", [
                "ketersediaan_kamar" => $kamar
            ]);
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }

    public function poli()
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $pelayananPoli = $this->rsClient->get("/cc/getPelayananPoli");

            return view("admin.kesehatan.rsud.poli", [
                "pelayanan_poli" => $pelayananPoli
            ]);
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }

    public function synchronize()
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $synchronize = $this->apiClient->post("/kesehatan/synchronize");

            if ($synchronize["status_code"] === 201) {
                flash("Data berhasil di perbarui");
                return redirect()->back();
            }

            throw new Exception("Terjadi Kesalahan");
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }
}
