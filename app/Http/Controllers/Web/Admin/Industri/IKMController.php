<?php

namespace App\Http\Controllers\Web\Admin\Industri;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Exception;
use Illuminate\Http\Request;

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

        $filters = $request->only(["region", "skala"]);

        try {
            $ikms = $this->apiClient->get("/disperindag/ikm", $filters);

            if ($ikms["status"] === 200) {
                return view("admin.industri.ikm.index", [
                    "ikms" => $ikms["data"],
                ]);
            }

            throw new Exception("Terjadi kesalahan");
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }
}
