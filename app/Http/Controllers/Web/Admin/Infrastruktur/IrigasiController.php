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

        // Perbaiki endpoint (pastikan benar)
        $filters = $request->only(["region"]);
        $irigations = $this->apiClient->get("/infrastruktur/irigasi", $filters);
        $regions = $this->apiClient->get("/wilayah/data");

        // Debugging: Periksa hasil API sebelum diproses
        if (isset($irigations["status"]) && in_array($irigations["status"], [200, 201])) {
            if (!empty($irigations["data"]) && is_array($irigations["data"])) {
                return view("admin.infrastruktur.irigasi.index", [
                    "irigations" => $irigations["data"],
                    "regions" => $regions["data"],
                ]);
            }
        }

        // Jika data tidak valid, kirim array kosong
        return view("admin.infrastruktur.irigasi.index", [
            "irigations" => [],
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
