<?php

namespace App\Http\Controllers\Kesehatan\RSUD;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class RSUDController extends Controller
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    public function kunjungan()
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $kunjungan = $this->apiClient->get("/kesehatan");

            if ($kunjungan["status_code"] === 200) {
                $harian = collect($kunjungan["data"]["kunjungan_harian"])->map(function ($data) {
                    return [
                        "tanggal" => Carbon::parse($data["kunjungan_harian_tanggal"])->translatedFormat("l, d F Y"),
                        "pasien_lama" => $data["kunjungan_harian_pasien_lama"],
                        "pasien_baru" => $data["kunjungan_harian_pasien_baru"],
                    ];
                });
                $bulanan = collect($kunjungan["data"]["kunjungan_bulanan"])->map(function ($data) {
                    return [
                        "bulan" => Carbon::create()->month($data["kunjungan_bulanan_bulan"])->translatedFormat("F"),
                        "tahun" => $data["kunjungan_bulanan_tahun"],
                        "pasien_lama" => $data["kunjungan_bulanan_pasien_lama"],
                        "pasien_baru" => $data["kunjungan_bulanan_pasien_baru"],
                    ];
                });

                return view("admin.kesehatan.rsud.kunjungan", [
                    "kunjungan_harian" => $harian,
                    "kunjungan_bulanan" => $bulanan,
                ]);
            }

            throw new Exception("Terjadi Kesalahan");
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

            if ($synchronize["status_code"] === 200) {
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
