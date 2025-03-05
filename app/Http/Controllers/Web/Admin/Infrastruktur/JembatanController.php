<?php

namespace App\Http\Controllers\Web\Admin\Infrastruktur;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Illuminate\Http\Request;

class JembatanController extends Controller
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

        // Perbaiki endpoint (pastikan benar)
        $filters = $request->only(["region"]);
        $bridges = $this->apiClient->get("/infrastruktur/jembatan", $filters);
// dd($bridges);
        // Debugging: Periksa hasil API sebelum diproses
        if (isset($bridges["status"]) && in_array($bridges["status"], [200, 201])) {

            if (!empty($bridges["data"]) && is_array($bridges["data"])) {
                return view("admin.infrastruktur.jembatan.index", [
                    "bridges" => $bridges["data"],
                ]);
            }
        }

        // Jika data tidak valid, kirim array kosong
        return view("admin.infrastruktur.jembatan.index", [
            "bridges" => [],
        ]);
    }
}
