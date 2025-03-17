<?php

namespace App\Http\Controllers\Kesehatan\RSUD;

use App\Services\ApiService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kesehatan\RSUD\KunjunganHarianModel;
use App\Models\Kesehatan\RSUD\KunjunganBulananModel;
use App\Services\ApiClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ApiRSUDController extends Controller
{
    protected $apiService;
    protected $apiClient;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
        $this->apiClient = new ApiClient(env("APP_BASE_URL_RSUD"), null, ["x-token" => env("APP_X_TOKEN")]);
    }

    public function kunjunganHarian()
    {
        $data = KunjunganHarianModel::orderBy('kunjungan_harian_tanggal', 'desc')
            ->take(7)
            ->get(['kunjungan_harian_pasien_lama', 'kunjungan_harian_pasien_baru', 'kunjungan_harian_tanggal']);

        return response()->json([
            'status_code' => 200,
            'data' => $data,
        ], 200);
    }

    public function kunjunganBulanan()
    {
        $data = KunjunganBulananModel::orderBy('kunjungan_bulanan_bulan', 'desc')
            ->take(7)
            ->get(['kunjungan_bulanan_pasien_lama', 'kunjungan_bulanan_pasien_baru', 'kunjungan_bulanan_bulan', 'kunjungan_bulanan_tahun']);

        return response()->json([
            'status_code' => 200,
            'data' => $data,
        ], 200);
    }

    public function synchronize()
    {
        $kunjunganHarian = $this->apiClient->get("/cc/getKunjunganHarian");
        $kunjunganBulanan = $this->apiClient->get("/cc/getKunjunganBulanan");

        // Mapping
        $kunjunganHarian = collect($kunjunganHarian)->map(function ($item) {
            return [
                "kunjungan_harian_pasien_baru" => $item["pasien_baru"],
                "kunjungan_harian_pasien_lama" => $item["pasien_lama"],
                "kunjungan_harian_tanggal" => $item["tanggal1"],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ];
        })->toArray();

        $kunjunganBulanan = collect($kunjunganBulanan)->map(function ($item) {
            return [
                "kunjungan_bulanan_pasien_baru" => $item["pasien_baru"],
                "kunjungan_bulanan_pasien_lama" => $item["pasien_lama"],
                "kunjungan_bulanan_bulan" => $item["bulan"],
                "kunjungan_bulanan_tahun" => $item["tahun"],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ];
        })->toArray();

        KunjunganHarianModel::insertOrIgnore($kunjunganHarian);
        KunjunganBulananModel::insertOrIgnore($kunjunganBulanan);
        return response()->json([
            "status_code" => 201,
            "message" => "Data berhasil disimpan ke database"
        ]);
    }
}
