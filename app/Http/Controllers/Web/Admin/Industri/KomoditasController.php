<?php

namespace App\Http\Controllers\Web\Admin\Industri;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KomoditasController extends Controller
{

    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    // public function index(Request $request)
    // {
    //     $this->apiClient->setToken(request()->session()->get("auth_token"));

    //     $filters = $request->only(["region", "variant"]);

    //     try {
    //         $data_price = $this->apiClient->get("/disperindag/price/data", $filters);
    //         $variants = $this->apiClient->get("/disperindag/variant/data");
    //         $regions = $this->apiClient->get("/wilayah/data");

    //         // Ambil daftar tanggal unik dan urutkan
    //         $dates = collect($data_price["data_price"])->pluck('date')->unique()->sort()->values()->all();
    //         $groupedData = collect($data_price["data_price"])->groupBy(["region_name", "variant_name"]);

    //         if ($data_price["status_code"] === 200 && isset($data_price["data_price"]) && is_array($data_price["data_price"])) {

    //             // Olah data untuk chart
    //             $dates = collect($data_price["data_price"])->groupBy("date")->keys();
    //             $dataByVariant = collect($data_price["data_price"])->groupBy("variant_name");

    //             $dates = collect($data_price['data_price'])->pluck('date')->unique()->sort()->values();

    //             $chartData = [];

    //             $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'];
    //             $colorIndex = 0;

    //             foreach ($dataByVariant as $variantName => $items) {
    //                 $prices = [];

    //                 foreach ($dates as $date) {
    //                     // Filter data per tanggal, lalu sum prices_value
    //                     $sum = $items->filter(function ($item) use ($date) {
    //                         return $item['date'] === $date;
    //                     })->sum(function ($item) {
    //                         return (int)$item['prices_value'];
    //                     });

    //                     $prices[] = $sum;
    //                 }

    //                 $chartData[] = [
    //                     'name' => $variantName,
    //                     'data' => $prices,
    //                     'color' => $colors[$colorIndex % count($colors)]
    //                 ];

    //                 $colorIndex++;
    //             }

    //             return view("admin.industri.komoditas.index", [
    //                 "data_price" => $groupedData,
    //                 "dates" => $dates,
    //                 "chartData" => $chartData,
    //                 "variants" => $variants["data_variant"],
    //                 "regions" => $regions["data"]
    //             ]);
    //         }

    //         throw new Exception("Terjadi kesalahan");
    //     } catch (Exception $e) {
    //         flash($e->getMessage(), "error");
    //         return redirect()->back();
    //     }
    // }
    public function index(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        $filters = $request->only(["region", "variant"]);

        try {
            $data_price = $this->apiClient->get("/disperindag/price/data", $filters);
            $variants = $this->apiClient->get("/disperindag/variant/data");
            $regions = $this->apiClient->get("/wilayah/data");

            if ($data_price["status_code"] === 200 && isset($data_price["data_price"]) && is_array($data_price["data_price"])) {

                // Hitung total komoditas
              // Hitung total komoditas unik
                $total_komoditas = collect($data_price["data_price"])
                ->pluck('variant_name')
                ->unique()
                ->count();

                // Hitung harga rata-rata semua komoditas
                $harga_rata_rata = collect($data_price["data_price"])
                ->groupBy('variant_name')
                ->map(function($items) {
                    return $items->avg('prices_value');
                })
                ->avg();

                // Ambil daftar tanggal unik dan urutkan
                $dates = collect($data_price["data_price"])->pluck('date')->unique()->sort()->values()->all();
                $groupedData = collect($data_price["data_price"])->groupBy(["region_name", "variant_name"]);

                // Olah data untuk chart
                $dates = collect($data_price["data_price"])->groupBy("date")->keys();
                $dataByVariant = collect($data_price["data_price"])->groupBy("variant_name");

                $dates = collect($data_price['data_price'])->pluck('date')->unique()->sort()->values();

                $chartData = [];

                $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'];
                $colorIndex = 0;

                foreach ($dataByVariant as $variantName => $items) {
                    $prices = [];

                    foreach ($dates as $date) {
                        // Filter data per tanggal, lalu sum prices_value
                        $sum = $items->filter(function ($item) use ($date) {
                            return $item['date'] === $date;
                        })->sum(function ($item) {
                            return (int)$item['prices_value'];
                        });

                        $prices[] = $sum;
                    }

                    $chartData[] = [
                        'name' => $variantName,
                        'data' => $prices,
                        'color' => $colors[$colorIndex % count($colors)]
                    ];

                    $colorIndex++;
                }

                return view("admin.industri.komoditas.index", [
                    "data_price" => $groupedData,
                    "dates" => $dates,
                    "chartData" => $chartData,
                    "variants" => $variants["data_variant"],
                    "regions" => $regions["data"],
                    "total_komoditas" => $total_komoditas,
                    "harga_rata_rata" => $harga_rata_rata
                ]);
            }

            throw new Exception("Terjadi kesalahan");
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }

    public function import(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $request->validate([
                "file" => "required|file|mimes:xls,xlsx|max:5000",
            ], [
                "file.required" => "File data komditas tidak boleh kosong",
                'file.file' => 'Data komditas harus berupa file',
                'file.mimes' => 'File data komditas harus berformat .xls atau .xlsx',
                'file.max' => 'File data komditas maksimal 5 Mb ',
                'year.required' => 'Tahun tidak boleh kosong'
            ]);

            $import = $this->apiClient->post("/disperindag/price/import", [], $request->files);


            if ($import["status"] === 400) {
                flash($import["message"], "error");
                return redirect()->back();
            }

            if ($import["status"] === 500) {
                throw new Exception($import["message"]);
            }

            flash("Data komoditas berhasil di import");
            return redirect()->back();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }
}
