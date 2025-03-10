<?php

namespace App\Http\Controllers\Web\Admin\Infrastruktur;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JembatanController extends Controller
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    public function index(Request $request)
    {
        $this->apiClient->setToken($request->session()->get("auth_token"));

        $filters = $request->only(["year"]);
        $bridges = $this->apiClient->get("/infrastruktur/jembatan", $filters);

        $total_jembatan = 0;
        $total_panjang_jembatan = 0;

        if (isset($bridges["status"]) && in_array($bridges["status"], [200, 201])) {
            if (!empty($bridges["data"]) && is_array($bridges["data"])) {
                $total_jembatan = count($bridges["data"]);
                $total_panjang_jembatan = array_sum(array_column($bridges["data"], "panjang"));
            }
        }

        $rata_rata_panjang = $total_jembatan > 0 ? $total_panjang_jembatan / $total_jembatan : 0;

        return view("admin.infrastruktur.jembatan.index", [
            "bridges" => $bridges["data"] ?? [],
            "total_jembatan" => $total_jembatan,
            "total_panjang_jembatan" => $total_panjang_jembatan,
            "rata_rata_panjang" => $rata_rata_panjang,
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

            $import = $this->apiClient->post("/infrastruktur/jembatan/import", [], $request->files);

            //  dd($import);
            if (is_array($import) && isset($import["status_code"])) {
                if ($import["status_code"] === 400) {
                    flash($import["message"], "error");
                    return redirect()->back();
                }

                if ($import["status_code"] === 500) {
                    throw new Exception($import["message"]);
                }

                flash("Data Jembatan berhasil diimpor", "success");
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
