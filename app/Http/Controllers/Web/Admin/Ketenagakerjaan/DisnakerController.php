<?php

namespace App\Http\Controllers\Web\Admin\Ketenagakerjaan;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Exception;
use Illuminate\Http\Request;

class DisnakerController extends Controller
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
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




    // public function ptkIndex(Request $request)
    // {
    //     $this->apiClient->setToken($request->session()->get("auth_token"));
    //     $filters = $request->only(["year"]);

    //     try {
    //         $ptks = $this->apiClient->get("/ketenagakerjaan/penempatan-tenaga-kerja", $filters);
    //         $filters = $request->only(["year"]);

    //         if (!isset($ptks["status"]) || $ptks["status"] !== 200) {
    //             throw new Exception("Terjadi kesalahan saat mengambil data");
    //         }
    //         $totalLaki = collect($ptks)->sum('male');
    //         $totalPerempuan = collect($ptks)->sum('female');
    //         $grandTotal = $totalLaki + $totalPerempuan;
    //         return view("admin.ketenagakerjaan.ptk.index", [
    //             "ptks" => collect($ptks["data"] ?? [])->map(function ($ptk) {
    //                 return [
    //                     "id" => $ptk["id"] ?? null,
    //                     "region_name" => $ptk["region"]["region_name"] ?? "Data tidak tersedia",
    //                     "male" => $ptk["male"] ?? 0,
    //                     "female" => $ptk["female"] ?? 0,
    //                     "year" => $ptk["year"] ?? "Unknown"
    //                 ];
    //             }),
    //             "regions" => $regions["data"] ?? [],
    //             "total" => count($ptks["data"] ?? [])
    //         ]);

    //     } catch (Exception $e) {
    //         flash($e->getMessage(), "error");
    //         return redirect()->back();
    //     }
    // }
}

//     // Method import data
//     public function importPkt(Request $request)
//     {
//         return $this->import($request, "pencari-kerja-terdaftar");
//     }

//     public function importLkt(Request $request)
//     {
//         return $this->import($request, "lowongan-kerja");
//     }

//     public function importPtk(Request $request)
//     {
//         return $this->import($request, "pelatihan-tenaga-kerja");
//     }

//     private function import(Request $request, $type)
//     {
//         $this->apiClient->setToken(request()->session()->get("auth_token"));

//         try {
//             $request->validate([
//                 "file" => "required|file|mimes:xls,xlsx|max:5000",
//                 "year" => "required"
//             ], [
//                 "file.required" => "File data tidak boleh kosong",
//                 "file.file" => "Data harus berupa file",
//                 "file.mimes" => "File harus berformat .xls atau .xlsx",
//                 "file.max" => "File maksimal 5 MB",
//                 "year.required" => "Tahun tidak boleh kosong"
//             ]);

//             $import = $this->apiClient->post("/ketenagakerjaan/$type/import", [
//                 "year" => $request->year
//             ], $request->files);

//             if (!isset($import["status"])) {
//                 throw new Exception("Respons API tidak valid atau kosong.");
//             }

//             if ($import["status"] === 400) {
//                 flash($import["message"] ?? "Terjadi kesalahan saat import.", "error");
//                 return redirect()->back();
//             }

//             if ($import["status"] === 500) {
//                 throw new Exception($import["message"] ?? "Kesalahan server.");
//             }

//             flash("Data berhasil diimport");
//             return redirect()->back();
//         } catch (ValidationException $e) {
//             return redirect()->back()->withErrors($e->errors());
//         } catch (Exception $e) {
//             flash($e->getMessage(), "error");
//             return redirect()->back();
//         }
//     }

//     // Method untuk halaman pelatihan tenaga kerja
//     public function ptkIndex()
//     {
//         return view('admin.ketenagakerjaan.ptk.index');
//     }
// }
