<?php

namespace App\Http\Controllers\Web\Admin\Kesehatan;

use App\Http\Controllers\Controller;
use App\Http\Requests\OPDKesehatanRequest;
use App\Services\ApiClient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RumahSakitController extends Controller
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    public function index(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        $filters = $request->only(["region", "category", "ownership", "acreditation"]);

        try {
            $data = $this->apiClient->get("/kesehatan/rs", $filters);
            $regions = $this->apiClient->get("/wilayah/data");
            $acreditations = $this->apiClient->get("/kesehatan/rs/akreditasi");
            $categories = $this->apiClient->get("/kesehatan/rs/kategori");
            $ownerships = $this->apiClient->get("/kesehatan/rs/kepemilikan");

            if ($data["status_code"] === 200) {
                return view("admin.kesehatan.rs.index", [
                    "rumah_sakit" => $data["data"],
                    "acreditations" => $acreditations["data_akreditasi_rs"],
                    "categories" => $categories["data_kategori_rs"],
                    "ownerships" => $ownerships["data"],
                    "regions" => $regions["data"],
                ]);
            }

            throw new Exception($data["message"]);
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }

    public function import(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $formRequest = new OPDKesehatanRequest("hospital_import");
            $this->validate($request, $formRequest->rules(), $formRequest->messages());

            $import = $this->apiClient->post("/kesehatan/rs/import", [], $request->files);

            if ($import["status_code"] === 201) {
                flash("Data rumah sakit berhasil di import");
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
