<?php

namespace App\Http\Controllers\Web\Admin\Industri;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Exception;
use Illuminate\Http\Request;

class KomoditasController extends Controller
{

    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }
    public function index(Request $request) {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        $filters = $request->only(["region", "skala"]);

        try {
            $data_price = $this->apiClient->get("/disperindag/price/data", $filters);

            if ($data_price["status_code"] === 200 && isset($data_price["data_price"]) && is_array($data_price["data_price"])) {
                return view("admin.industri.komoditas.index", [
                    "data_price" => $data_price["data_price"],
                ]);
            }


            throw new Exception("Terjadi kesalahan");
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }
}
