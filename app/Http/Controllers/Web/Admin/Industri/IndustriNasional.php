<?php

namespace App\Http\Controllers\Web\Admin\Industri;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class IndustriNasional extends Controller
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    public function index()
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $industries = $this->apiClient->get("/disperindag/industries");

            if ($industries["status"] === 200) {
                return view("admin.industri.industri-nasional.index", [
                    "industries" => $industries["data"]
                ]);
            }

            throw new Exception("Terjadi kesalahan");
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }

    public function import(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $request->validate([
                "file" => "required|file|mimes:xls,xlsx|max:5000",
            ], [
                "file.required" => "File data SIINas tidak boleh kosong",
                'file.file' => 'Data SIInas harus berupa file',
                'file.mimes' => 'File data SIInas harus berformat .xls atau .xlsx',
                'file.max' => 'File data SIInas maksimal 5 Mb ',
            ]);

            $import = $this->apiClient->post("/disperindag/indusrty/import", [], $request->files);

            if ($import["status"] === "error") {
                flash($import["errors"], "error");
                return redirect()->back();
            }

            if ($import["status"] === 500) {
                throw new Exception($import["message"]);
            }

            flash("Data industri SIInas berhasil di import");
            return redirect()->back();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }
}
