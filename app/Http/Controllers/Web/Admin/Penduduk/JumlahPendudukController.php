<?php

namespace App\Http\Controllers\Web\Admin\Penduduk;

use App\Http\Controllers\Controller;
use App\Http\Requests\PopulationRequest;
use App\Services\ApiClient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class JumlahPendudukController extends Controller
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    public function index(Request $request)
    {
        $filters = $request->only(["year", "semester", "age_range", "region"]);

        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $penduduk = $this->apiClient->get("/kependudukan/data", $filters);
            $periode = $this->apiClient->get("/kependudukan/periode-data/data");
            $region = $this->apiClient->get("/wilayah/data");
            $rentangUsia = $this->apiClient->get("/kependudukan/kelompok-umur/data");

            $pendudukByRegion = collect($penduduk["data"])->groupBy("region.region_name")->map(function ($region) {
                return [
                    "population_male" => $region->sum("population_male"),
                    "population_female" => $region->sum("population_female"),
                    "total" => $region->sum("population_male") + $region->sum("population_female")
                ];
            });

            return view("admin.penduduk.jumlah-penduduk.index", [
                "penduduk" => $pendudukByRegion,
                "periode" => $periode["data"],
                "region" => $region["data"],
                "rentangUsia" => $rentangUsia["data"],
            ]);
        } catch (Exception $e) {
            return view("admin.penduduk.jumlah-penduduk.index", [
                "penduduk" => $penduduk["data"],
                "periode" => $periode["data"],
                "region" => $region["data"],
                "rentangUsia" => $rentangUsia["data"],
            ]);
        }
    }

    public function import(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $formRequest = new PopulationRequest('population_input');
            $this->validate($request, $formRequest->rules(), $formRequest->messages());

            $import = $this->apiClient->post("/kependudukan/import", ["population_period_id" => $request->population_period_id], $request->files);

            if ($import["status_code"] === 400) {
                flash($import["errors"], "error");
                return redirect()->back();
            }

            $year = $import["data"]["population_period_year"];
            $semester = $import["data"]["population_period_semester"];

            flash("Data penduduk tahun $year semester $semester berhasil di import");
            return redirect()->back();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }
    }
}
