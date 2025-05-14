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
                $hospitals = collect($data["data"]);

                // Siapkan data untuk chart
                $chartData = [
                    'category' => $hospitals->groupBy('category_hospital.category_hospital_name')->map->count(),
                    'accreditation' => $hospitals->groupBy('hospital_acreditation.hospital_acreditation_name')->map->count(),
                    'class' => $hospitals->groupBy('hospital_data_class')->map->count(),
                    'region' => $hospitals->groupBy('region.region_name')->map->count(),
                    'ownership' => $hospitals->groupBy('hospital_ownership.hospital_ownership_name')->map->count()
                ];

                // Hitung jumlah RS per region
                $regionCounts = $hospitals->groupBy('region_id')->map->count();

                return view("admin.kesehatan.rs.index", [
                    "rumah_sakit" => $hospitals,
                    "acreditations" => $acreditations["data_akreditasi_rs"],
                    "categories" => $categories["data_kategori_rs"],
                    "ownerships" => $ownerships["data"],
                    "regions" => $regions["data"],
                    "regionCounts" => $regionCounts,
                    "chartData" => $chartData
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
