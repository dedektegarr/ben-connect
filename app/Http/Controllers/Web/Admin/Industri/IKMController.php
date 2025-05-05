<?php

namespace App\Http\Controllers\Web\Admin\Industri;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class IKMController extends Controller
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    public function index(Request $request)
    {

        $this->apiClient->setToken(request()->session()->get("auth_token"));

        $filters = $request->only(["region"]);

        try {
            $ikms = $this->apiClient->get("/disperindag/ikm", $filters);
            $regions = $this->apiClient->get("/wilayah/data");

            if ($ikms["status"] === 200) {
                $ikmData = collect($ikms["data"]);

                // Data untuk chart
                $chartData = [
                    'branch' => $ikmData->groupBy('ikm_branch')->map->count(),
                    'sentra' => $ikmData->groupBy('ikm_sentra')->map->count()->sortDesc()->take(10),
                    'category' => $ikmData->groupBy('ikm_category_product')->map->count()->sortDesc()->take(8),
                    'yearly' => $ikmData->groupBy('year')->map->count()
                ];

                return view("admin.industri.ikm.index", [
                    "ikms" => $ikmData,
                    "regions" => $regions["data"],
                    "total" => collect($ikmData)->count(),
                    "chartData" => $chartData
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
                "year" => "required"
            ], [
                "file.required" => "File data IKM tidak boleh kosong",
                'file.file' => 'Data IKM harus berupa file',
                'file.mimes' => 'File data IKM harus berformat .xls atau .xlsx',
                'file.max' => 'File data IKM maksimal 5 Mb ',
                'year.required' => 'Tahun tidak boleh kosong'
            ]);

            $import = $this->apiClient->post("/disperindag/ikm/import", ["year" => $request->year], $request->files);

            if ($import["status"] === 400) {
                flash($import["message"], "error");
                return redirect()->back();
            }

            if ($import["status"] === 500) {
                throw new Exception($import["message"]);
            }

            flash("Data IKM berhasil di import");
            return redirect()->back();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }
}
