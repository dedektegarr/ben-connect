<?php

namespace App\Http\Controllers\Web\Admin\Infrastruktur;

use App\Http\Controllers\Controller;
use App\Services\ApiClient; // Pastikan ini di-import
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class IrigasiController extends Controller
{
    private $apiClient;

    public function __construct()
    {
        // Inisialisasi ApiClient dengan URL API
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    public function index(Request $request)
    {
        // Set token autentikasi API
        $this->apiClient->setToken($request->session()->get("auth_token"));

        // Ambil data irigasi dari API
        $filters = $request->only(["region"]);
        $response = $this->apiClient->get("/infrastruktur/irigasi", $filters);

        // Debugging: Periksa isi response API


        // Pastikan response API sukses dan memiliki data
        if (isset($response["status"]) && $response["status"] === 200) {
            $irigations = $response["data"] ?? [];

            // Hitung total berdasarkan data API
            $total_daerah_irigasi = count($irigations);
            $total_luas_potensial = array_sum(array_map(fn($item) => $item["luas_potensial"] ?? 0, $irigations));
            $total_luas_fungsional = array_sum(array_map(fn($item) => $item["luas_fungsional"] ?? 0, $irigations));

            return view("admin.infrastruktur.irigasi.index", [
                "irigations" => $irigations,
                "total_daerah_irigasi" => $total_daerah_irigasi,
                "total_luas_potensial" => $total_luas_potensial,
                "total_luas_fungsional" => $total_luas_fungsional,
            ]);
        }

        // Jika API gagal atau kosong, tetap kirimkan variabel ke view dengan nilai default
        return view("admin.infrastruktur.irigasi.index", [
            "irigations" => [],
            "total_daerah_irigasi" => 0,
            "total_luas_potensial" => 0,
            "total_luas_fungsional" => 0,
        ]);
    }


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

            $import = $this->apiClient->post("/infrastruktur/irigasi/import", [], $request->files);

            //  dd($import);
             if (is_array($import) && isset($import["status_code"])) {
                if ($import["status_code"] === 400) {
                    flash($import["message"], "error");
                    return redirect()->back();
                }

                if ($import["status_code"] === 500) {
                    throw new Exception($import["message"]);
                }

                flash("Data Irigasi berhasil diimpor", "success");
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
