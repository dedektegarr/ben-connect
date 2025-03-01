<?php

namespace App\Http\Controllers\Web\Admin\Pendidikan;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Exception;
use Illuminate\Http\Request;

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

        $filters = $request->only(["region"]);

        try {
            $sekolah = $this->apiClient->get("/pendidikan/sekolah", $filters);
            $sekolahByRegion = collect($sekolah["data"])->groupBy("region_name");
            $getTotalPerRegion = $sekolahByRegion->map(function ($sekolah) {
                return $sekolah->sum("negeri_count") + $sekolah->sum("swasta_count");
            });

            if ($sekolah["status_code"] === 200) {
                return view("admin.pendidikan.sekolah.index", [
                    "sekolah" => $getTotalPerRegion,
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
}
