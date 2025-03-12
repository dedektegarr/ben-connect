<?php

namespace App\Http\Controllers\Web\Admin\Industri;

use Exception;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class IndustriNasionalController extends Controller
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    public function index(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        $filters = $request->only(["region", "skala"]);


        $industries = $this->apiClient->get("/disperindag/industries", $filters);
        $regions = $this->apiClient->get("/wilayah/data");

        if ($industries["status"] === 200) {
            return view("admin.industri.industri-nasional.index", [
                "industries" => $industries["data"],
                "regions" => $regions["data"],
                "total_kecil" => collect($industries["data"])->where("industry_business_scale", "Kecil")->count(),
                "total_besar" => collect($industries["data"])->where("industry_business_scale", "Besar")->count(),
            ]);
        }

        throw new Exception("Terjadi kesalahan");
    }

    public function import(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        $request->validate([
            "file" => "required|file|mimes:xls,xlsx|max:5000",
        ], [
            "file.required" => "File data SIINas tidak boleh kosong",
            'file.file' => 'Data SIInas harus berupa file',
            'file.mimes' => 'File data SIInas harus berformat .xls atau .xlsx',
            'file.max' => 'File data SIInas maksimal 5 Mb ',
        ]);

        $import = $this->apiClient->post("/disperindag/indusrty/import", [], $request->files);
        $test = $this->apiClient->get("/wilayah/data");
        dd($test);
        if ($import["status"] === "error") {
            flash($import["errors"], "error");
            return redirect()->back();
        }

        if ($import["status"] === 500) {
            throw new Exception($import["message"]);
        }

        flash("Data industri SIInas berhasil di import");
        return redirect()->back();
    }
}
