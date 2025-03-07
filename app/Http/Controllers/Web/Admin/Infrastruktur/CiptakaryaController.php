<?php

namespace App\Http\Controllers\Web\Admin\Infrastruktur;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Validation\ValidationException;

class CiptakaryaController extends Controller
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

        // Perbaiki endpoint (pastikan benar)
        $filters = $request->only(["region"]);
        $arts = $this->apiClient->get("/infrastruktur/ciptakarya", $filters);
// dd($arts);
        // Debugging: Periksa hasil API sebelum diproses
        if (isset($arts["status"]) && in_array($arts["status"], [200, 201])) {
            if (!empty($arts["data"]) && is_array($arts["data"])) {
                return view("admin.infrastruktur.ciptakarya.index", [
                    "arts" => $arts["data"],
                ]);
            }
        }

        // Jika data tidak valid, kirim array kosong
        return view("admin.infrastruktur.ciptakarya.index", [
            "arts" => [],
        ]);
    }

    public function import(Request $request)
    {
        $this->apiClient->setToken($request->session()->get("auth_token"));

        try {
            $request->validate([
                "file" => "required|file|mimes:xls,xlsx|max:5000",
                "year" => "required",
            ], [
                "file.required" => "File data komoditas tidak boleh kosong",
                'file.file' => 'Data komoditas harus berupa file',
                'file.mimes' => 'File data komoditas harus berformat .xls atau .xlsx',
                'file.max' => 'File data komoditas maksimal 5 Mb ',
                 'year.required' => 'Tahun tidak boleh kosong'
            ]);

            $import = $this->apiClient->post("/infrastruktur/ciptakarya/import",["year" => $request->year], $request->files);
// dd(vars:$import);
            if (is_array($import) && isset($import["status_code"])) {
                if ($import["status_code"] === 400) {
                    flash($import["message"], "error");
                    return redirect()->back();
                }

                if ($import["status_code"] === 500) {
                    throw new Exception($import["message"]);
                }

                flash("Data Ciptakarya berhasil diimpor", "success");
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
