<?php

namespace App\Http\Controllers\Web\Admin\Infrastruktur;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JalanController extends Controller
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    public function index(Request $request)
    {
        // Set token autentikasi API
        $this->apiClient->setToken($request->session()->get("auth_token"));

     // Ambil data jalan dari API
$filters = $request->only(["region"]);
$roads = $this->apiClient->get("/infrastruktur/jalan", $filters);

// Periksa apakah response API valid
if (isset($roads["status_code"]) && $roads["status_code"] === 200) {
    // Total panjang semua ruas jalan
    $total_panjang_jalan = array_sum(array_column($roads["data"], "panjang_ruas"));

    // Total panjang berdasarkan kondisi
    $total_panjang_baik = array_sum(array_column($roads["data"], "kondisi_baik_km"));
    $total_panjang_sedang = array_sum(array_column($roads["data"], "kondisi_sedang_km"));
    $total_panjang_rusak_ringan = array_sum(array_column($roads["data"], "kondisi_rusak_ringan_km"));
    $total_panjang_rusak_berat = array_sum(array_column($roads["data"], "kondisi_rusak_berat_km"));

    // Persentase kondisi jalan
    $persentase_baik = $total_panjang_jalan > 0 ? ($total_panjang_baik / $total_panjang_jalan) * 100 : 0;
    $persentase_rusak_berat = $total_panjang_jalan > 0 ? ($total_panjang_rusak_berat / $total_panjang_jalan) * 100 : 0;

    return view("admin.infrastruktur.jalan.index", [
        "roads" => $roads["data"],
        "total_panjang_jalan" => $total_panjang_jalan,
        "total_panjang_baik" => $total_panjang_baik,
        "total_panjang_sedang" => $total_panjang_sedang,
        "total_panjang_rusak_ringan" => $total_panjang_rusak_ringan,
        "total_panjang_rusak_berat" => $total_panjang_rusak_berat,
        "persentase_baik" => $persentase_baik,
        "persentase_rusak_berat" => $persentase_rusak_berat,
    ]);
}


        // Jika response API tidak valid, kembalikan halaman dengan data kosong
        return view("admin.infrastruktur.jalan.index", [
            "roads" => [],
            "total_panjang_jalan" => 0,
            "persentase_baik" => 0,
            "persentase_rusak_berat" => 0,
        ]);
    }

    // Jika terjadi error, tampilkan halaman dengan array kosong



    public function import(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $request->validate([
                "file" => "required|file|mimes:xls,xlsx|max:5000",
            ], [
                "file.required" => "File data komditas tidak boleh kosong",
                'file.file' => 'Data komditas harus berupa file',
                'file.mimes' => 'File data komditas harus berformat .xls atau .xlsx',
                'file.max' => 'File data komditas maksimal 5 Mb ',
                'year.required' => 'Tahun tidak boleh kosong'
            ]);

            $import = $this->apiClient->post("/infrastruktur/jalan/import", [], $request->files);

            //  dd($import);
             if (is_array($import) && isset($import["status_code"])) {
                if ($import["status_code"] === 400) {
                    flash($import["message"], "error");
                    return redirect()->back();
                }

                if ($import["status_code"] === 500) {
                    throw new Exception($import["message"]);
                }

                flash("Data Jalan berhasil diimpor", "success");
                return redirect()->back();
            }
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }
}
