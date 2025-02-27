<?php

namespace App\Http\Controllers\Web\Admin\Penduduk;

use App\Http\Controllers\Controller;
use App\Http\Requests\PopulationRequest;
use App\Services\ApiClient;
use App\Services\Penduduk\PendudukServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class JumlahPendudukController extends Controller
{
    private $apiClient;
    private $pendudukService;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
        $this->pendudukService = new PendudukServices();
    }

    public function index(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        $filters = $request->only(["year", "semester", "age_range", "region"]);

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
                "total_male" => collect($penduduk["data"])->sum("population_male"),
                "total_female" => collect($penduduk["data"])->sum("population_female"),
                "rentangUsia" => $rentangUsia["data"],
            ]);
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }

    public function statistikPenduduk(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        $filters = $request->only(["region"]);

        try {
            $regions = $this->apiClient->get("/wilayah/data")["data"];
            $penduduk = $this->apiClient->get("/kependudukan/data", $filters)["data"];

            if (empty($penduduk)) {
                return view("admin.penduduk.jumlah-penduduk.statistik", [
                    "regions" => $regions,
                    "genderPercentage" => [],
                    "ageRange" => [],
                    "populationCount" => []
                ]);
            }

            $genderPercentage = $this->pendudukService->getGenderPercentage($penduduk);
            $ageRange = $this->pendudukService->getAgeRange($penduduk);
            $populationCount = [
                "Pria" => $this->pendudukService->getTotal($penduduk, "population_male"),
                "Wanita" => $this->pendudukService->getTotal($penduduk, "population_female"),
                "Total" => $this->pendudukService->getTotal($penduduk, "population_male") +  $this->pendudukService->getTotal($penduduk, "population_female")
            ];

            return view("admin.penduduk.jumlah-penduduk.statistik", [
                "regions" => $regions,
                "genderPercentage" => $genderPercentage,
                "ageRange" => $ageRange,
                "populationCount" => $populationCount
            ]);
        } catch (Exception $e) {
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
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }
}
