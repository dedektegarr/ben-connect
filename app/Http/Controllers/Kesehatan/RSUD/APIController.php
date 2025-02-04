<?php

namespace App\Http\Controllers\Kesehatan\RSUD;

use App\Services\ApiService;
use App\Http\Controllers\Controller;
use App\Models\Kesehatan\RSUD\KunjunganBulananModel;
use App\Models\Kesehatan\RSUD\KunjunganHarianModel;
use Illuminate\Http\JsonResponse;

class APIController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getDataRSUD(): JsonResponse
    {
        try {
            // Endpoint yang akan dipanggil
            $endpoints = [
                'ketersediaan_kamar' => '/cc/getKetersediaanKamar',
                'pelayanan_poli' => '/cc/getPelayananPoli',
            ];

            // Ambil data dari API
            $responses = $this->apiService->sendMultipleRequests($endpoints);

            // Ambil 7 data terakhir dari kunjungan harian
            $kunjunganHarian = KunjunganHarianModel::orderBy('kunjungan_harian_tanggal', 'desc')
                                ->take(7)
                                ->get(['kunjungan_harian_pasien_lama','kunjungan_harian_pasien_baru','kunjungan_harian_tanggal']);

            // Ambil 6 data terakhir dari kunjungan bulanan
            $kunjunganBulanan = KunjunganBulananModel::orderBy('kunjungan_bulanan_tahun', 'desc')
                                ->orderBy('kunjungan_bulanan_bulan', 'desc')
                                ->take(6)
                                ->get(['kunjungan_bulanan_pasien_lama','kunjungan_bulanan_pasien_baru','kunjungan_bulanan_bulan','kunjungan_bulanan_tahun']);

            // Gabungkan semua data
            $data = [
                'kunjungan_harian' => $kunjunganHarian,
                'kunjungan_bulanan' => $kunjunganBulanan,
                'ketersediaan_kamar' => $responses['ketersediaan_kamar'] ?? null,
                'pelayanan_poli' => $responses['pelayanan_poli'] ?? null,
            ];

            // Jika semua data kosong, kembalikan response 500
            if (empty($responses) && $kunjunganHarian->isEmpty() && $kunjunganBulanan->isEmpty()) {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Gagal mengambil data dari server dan database',
                    'data' => null,
                ], 500);
            }

            return response()->json([
                'status_code' => 200,
                'data' => $data,
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => $error->getMessage(),
            ], 500);
        }
    }

    public function postDatabase(): JsonResponse
    {
        try{
            $endpoints = [
                'kunjungan_harian' => '/cc/getKunjunganHarian',
                'kunjungan_bulanan' => '/cc/getKunjunganBulanan',
            ];

            $responses = $this->apiService->sendMultipleRequests($endpoints);

            if ($responses === null) {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Gagal mengambil data dari server untuk semua endpoint',
                    'data' => null,
                ], 500);
            }

            // Simpan data kunjungan harian
            if (!empty($responses['kunjungan_harian'])) {
                foreach ($responses['kunjungan_harian'] as $kunjungan) {
                    KunjunganHarianModel::updateOrCreate(
                        ['kunjungan_harian_tanggal' => $kunjungan['tanggal1']], // unique constraint
                        [
                            'kunjungan_harian_pasien_lama' => $kunjungan['pasien_lama'],
                            'kunjungan_harian_pasien_baru' => $kunjungan['pasien_baru'],
                        ]
                    );
                }
            }

            // Simpan data kunjungan bulanan
            if (!empty($responses['kunjungan_bulanan'])) {
                foreach ($responses['kunjungan_bulanan'] as $kunjungan) {
                    KunjunganBulananModel::updateOrCreate(
                        ['kunjungan_bulanan_bulan' => $kunjungan['bulan'], 'kunjungan_bulanan_tahun' => $kunjungan['tahun']], // unique constraint
                        [
                            'kunjungan_bulanan_pasien_lama' => $kunjungan['pasien_lama'],
                            'kunjungan_bulanan_pasien_baru' => $kunjungan['pasien_baru'],
                        ]
                    );
                }
            }

            return response()->json([
                'status_code' => 200,
                'message' => 'Data berhasil disimpan ke database',
            ], 200);

        }
        catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => $error->getMessage(),
            ], 500);
        }
    }
}
