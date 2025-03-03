<?php

namespace App\Http\Controllers\Web\Admin\Pendidikan;

use Exception;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\study\SchoolRequest;
use App\Http\Requests\study\TeacherRequest;
use Illuminate\Validation\ValidationException;

class JumlahGuruController extends Controller
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
            $guru = $this->apiClient->get("/pendidikan/guru", $filters);
            $guruByRegion = collect($guru["data"])->groupBy("region.region_name");
            $getTotalPerRegion = $guruByRegion->map(function ($guru) {
                return [
                    "total" => $guru->sum("male_count") + $guru->sum("female_count"),
                    "total_male" => $guru->sum("male_count"),
                    "total_female" => $guru->sum("female_count")
                ];
            });

            if ($guru["status_code"] === 200) {
                return view("admin.pendidikan.guru.index", [
                    "guru" => $getTotalPerRegion,
                    "total_male" => collect($guru["data"])->sum("male_count"),
                    "total_female" => collect($guru["data"])->sum("female_count"),
                ]);
            }

            throw new Exception($guru["message"]);
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }

    public function import(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $formRequest = new TeacherRequest();
            $this->validate($request, $formRequest->rules(), $formRequest->messages());

            $import = $this->apiClient->post("/pendidikan/guru/import", [], $request->files);

            if ($import["status_code"] === 201) {
                flash("Data jumlah guru berhasil di import");
                return redirect()->back();
            }

            throw new Exception($import["message"]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }
}
