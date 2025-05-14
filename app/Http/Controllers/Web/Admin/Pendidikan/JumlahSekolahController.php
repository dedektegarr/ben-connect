<?php

namespace App\Http\Controllers\Web\Admin\Pendidikan;

use App\Http\Controllers\Controller;
use App\Http\Requests\study\SchoolRequest;
use App\Services\ApiClient;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JumlahSekolahController extends Controller
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
            $sekolah = $this->apiClient->get("/pendidikan/sekolah", $filters);
            $sekolahByRegion = collect($sekolah["data"])->groupBy('region_name');

            // $sekolahByRegion = collect($sekolah["data"])->groupBy("region_name");
            // $getTotalPerRegion = $sekolahByRegion->map(function ($sekolah) {
            //     return [
            //         "total" => $sekolah->sum("negeri_count") + $sekolah->sum("swasta_count"),
            //         "total_negeri" => $sekolah->sum("negeri_count"),
            //         "total_swasta" => $sekolah->sum("swasta_count"),
            //         "tahun" => $sekolah[0]["school_year"]
            //     ];
            // });

            if ($sekolah["status_code"] === 200) {
                return view("admin.pendidikan.sekolah.index", [
                    "sekolah" => $sekolah["data"],
                    "regions" => $sekolahByRegion,
                    "total_negeri" => collect($sekolah["data"])->sum("negeri_count"),
                    "total_swasta" => collect($sekolah["data"])->sum("swasta_count"),
                ]);
            }

            throw new Exception($sekolah["message"]);
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }

    public function import(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $formRequest = new SchoolRequest();
            $this->validate($request, $formRequest->rules(), $formRequest->messages());

            $import = $this->apiClient->post("/pendidikan/sekolah/import", ["year" => $request->year], $request->files);

            if ($import["status_code"] === 201) {
                flash("Data jumlah sekolah berhasil di import");
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
