<?php

namespace App\Http\Controllers\Web\Admin\Infrastruktur;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Illuminate\Http\Request;

class JalanController extends Controller
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    public function index(Request $request)
    {
        // Set token autentikasi API
        $this->apiClient->setToken($request->session()->get("auth_token"));

        // Ambil data jalan dari API
        $filters = $request->only(["region"]);
        $roads = $this->apiClient->get("/infrastruktur/jalan", $filters);

        // Periksa apakah response API valid
        if (isset($roads["status_code"]) && $roads["status_code"] === 200) {
            return view("admin.infrastruktur.jalan.index", [
                "roads" => $roads["data"],
            ]);
        }

        // Jika terjadi error, tampilkan halaman dengan array kosong
        return view("admin.infrastruktur.jalan.index", [
            "roads" => [],
        ]);
    }
}
