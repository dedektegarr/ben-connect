<?php

namespace App\Http\Controllers\Web\Admin\Pendidikan;

use Exception;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\study\StudentRequest;
use App\Http\Requests\study\TeacherRequest;
use Illuminate\Validation\ValidationException;

class JumlahPesertaDidikController extends Controller
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    public function index(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        $filters = $request->only(["year"]);

        try {
            $pesertaDidik = $this->apiClient->get("/pendidikan/peserta-didik", $filters);
            $pesertaDidikByRegion = collect($pesertaDidik["data"])->groupBy("region.region_name");
            // $getTotalPerRegion = $pesertaDidikByRegion->map(function ($pesertaDidik) {
            //     return [
            //         "total" => $pesertaDidik->sum("male_count") + $pesertaDidik->sum("female_count"),
            //         "total_male" => $pesertaDidik->sum("male_count"),
            //         "total_female" => $pesertaDidik->sum("female_count")
            //     ];
            // });

            if ($pesertaDidik["status_code"] === 200) {
                return view("admin.pendidikan.peserta-didik.index", [
                    "peserta_didik" => $pesertaDidik["data"],
                    "regions" => $pesertaDidikByRegion,
                    "total_male" => collect($pesertaDidik["data"])->sum("male_count"),
                    "total_female" => collect($pesertaDidik["data"])->sum("female_count"),
                ]);
            }

            throw new Exception($pesertaDidik["message"]);
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }

    public function import(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $formRequest = new StudentRequest();
            $this->validate($request, $formRequest->rules(), $formRequest->messages());

            $import = $this->apiClient->post("/pendidikan/peserta-didik/import", ["year" => $request->year], $request->files);

            if ($import["status_code"] === 201) {
                flash("Data jumlah peserta didik berhasil di import");
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
