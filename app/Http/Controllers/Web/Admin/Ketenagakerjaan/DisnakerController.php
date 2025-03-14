<?php

namespace App\Http\Controllers\Web\Admin\Ketenagakerjaan;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DisnakerController extends Controller
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    public function import(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $request->validate([
                "file" => "required|file|mimes:xls,xlsx|max:5000",
                "year" => "required|numeric"
            ], [
                "file.required" => "File tidak boleh kosong",
                'file.file' => 'Data komditas harus berupa file',
                'file.mimes' => 'File harus berformat .xls atau .xlsx',
                'file.max' => 'File maksimal 5 Mb ',
                'year.required' => 'Tahun tidak boleh kosong'
            ]);

            $import = $this->apiClient->post("/ketenagakerjaan/pencari-kerja-terdaftar/import", ["year" => $request->year], $request->files);

            if (is_array($import) && isset($import["status_code"])) {
                if ($import["status_code"] === 400) {
                    flash($import["message"], "error");
                    return redirect()->back();
                }

                if ($import["status_code"] === 500) {
                    throw new Exception($import["message"]);
                }

                flash("Data naker berhasil diimpor", "success");
                return redirect()->back();
            }
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }

    public function umrImport(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $request->validate([
                "file" => "required|file|mimes:xls,xlsx|max:5000"
            ], [
                "file.required" => "File tidak boleh kosong",
                'file.file' => 'Data komditas harus berupa file',
                'file.mimes' => 'File harus berformat .xls atau .xlsx',
                'file.max' => 'File maksimal 5 Mb ',
            ]);

            $import = $this->apiClient->post("/ketenagakerjaan/upah-minimum-regional/import", ["year" => $request->year], $request->files);

            if (is_array($import) && isset($import["status_code"])) {
                if ($import["status_code"] === 400) {
                    flash($import["message"], "error");
                    return redirect()->back();
                }

                if ($import["status_code"] === 500) {
                    throw new Exception($import["message"]);
                }

                flash("Data UMR berhasil diimpor", "success");
                return redirect()->back();
            }
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }

    public function wlkpIndex()
    {
        return view('admin.ketenagakerjaan.wlkp.index');
    }

    public function disnakerIndex()
    {
        return view('admin.ketenagakerjaan.disnaker.index');
    }

    public function pktIndex(Request $request)
    {
        return $this->fetchData("pkt", "/ketenagakerjaan/pencari-kerja-terdaftar", "admin.ketenagakerjaan.pkt.index", $request);
    }

    public function lktIndex(Request $request)
    {
        return $this->fetchData("lkt", "/ketenagakerjaan/lowongan-kerja-terdaftar", "admin.ketenagakerjaan.lkt.index", $request);
    }

    public function ptkIndex(Request $request)
    {
        return $this->fetchData("ptk", "/ketenagakerjaan/penempatan-tenaga-kerja", "admin.ketenagakerjaan.ptk.index", $request);
    }

    private function fetchData($type, $endpoint, $view, Request $request)
{
    $this->apiClient->setToken($request->session()->get("auth_token"));

    $filters = $request->only(["year"]);

    try {
        $response = $this->apiClient->get($endpoint, $filters);

        if (!isset($response["status"]) || $response["status"] !== 200 || !isset($response["data"])) {
            throw new Exception("Gagal mengambil data $type dari API.");
        }

        // Ambil data dari response
        $data = collect($response["data"] ?? []);

        // Terapkan filter jika year dikirimkan
        if (isset($filters["year"])) {
            $data = $data->where("year", $filters["year"])->values();
        }

        $totalLaki = $data->sum("male") ?? 0;
        $totalPerempuan = $data->sum("female") ?? 0;
        $grandTotal = $totalLaki + $totalPerempuan;

        return view($view, [
            "{$type}s" => $data->map(function ($item) {
                return [
                    "id" => $item["id"] ?? null,
                    "region_name" => data_get($item, "region.region_name", "Data tidak tersedia"),
                    "male" => $item["male"] ?? 0,
                    "female" => $item["female"] ?? 0,
                    "year" => $item["year"] ?? "Unknown"
                ];
            }),
            "total" => count($data),
            "totalLaki" => $totalLaki,
            "totalPerempuan" => $totalPerempuan,
            "grandTotal" => $grandTotal
        ]);

    } catch (Exception $e) {
        flash($e->getMessage(), "error");
        return redirect()->back();
    }
}

    public function umrIndex(Request $request)
    {
        $this->apiClient->setToken($request->session()->get("auth_token"));

        try {
            $filters = $request->only(["year"]);
            $umrs = $this->apiClient->get("/ketenagakerjaan/upah-minimum-regional", $filters);

            if ($umrs !== null && $umrs["status"] === 200) {
                $years = $umrs["data"]["years"];
                $umrs = $umrs["data"]["data"];

                return view("admin.ketenagakerjaan.umr.index", [
                    "years" => $years,
                    "umrs" => $umrs
                ]);
            }

            throw new Exception("Terjadi kesalahan");
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }
}
