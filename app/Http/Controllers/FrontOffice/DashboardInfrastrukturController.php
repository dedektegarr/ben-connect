<?php

namespace App\Http\Controllers\FrontOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class DashboardInfrastrukturController extends Controller
{
    public function __construct()
    {
        $this->jalan = File::json('assets/data_json/infrastruktur/data-jalan.json');
    }
    public function index_jalan(Request $request){
        $jalan = $this->jalan;
        $kab_kota = collect($this->jalan)->map(function($item) {
            return $item['nama_daerah']; 
        })->unique()->sort()->values();

        $jalan_chart_tahun = array_filter($this->jalan, function ($item) {
            return $item['tahun'] == "2023";
        });
        
        // Hitung total jumlah provinsi
        $totalJalanNasional = array_reduce($jalan_chart_tahun, function ($carry, $item) {
            return $carry + floatval($item['nasional']); // Mengkonversi ke floatval agar perhitungan bisa dilakukan
        }, 0);
        $totalJalanProvinsi = array_reduce($jalan_chart_tahun, function ($carry, $item) {
            return $carry + floatval($item['provinsi']); // Mengkonversi ke floatval agar perhitungan bisa dilakukan
        }, 0);
        $totalJalanKabupaten = array_reduce($jalan_chart_tahun, function ($carry, $item) {
            return $carry + floatval($item['kabupaten']); // Mengkonversi ke floatval agar perhitungan bisa dilakukan
        }, 0);

            $selectedKabupaten = $request->input('kab_kota', 'all');
            $selectedJenisData = $request->input('jenis_data', 'jalan');
            $selectedTahun = 2022;
            $filteredData = collect($this->jalan)->filter(function($item) use ($selectedKabupaten, $selectedTahun) {
                return ($selectedKabupaten == 'all' || $item['nama_daerah'] == $selectedKabupaten) &&
                substr($item['tahun'], 0, 4) == $selectedTahun;
            });
        return view('FrontOffice.infrastruktur.jalan', compact('kab_kota','selectedKabupaten','filteredData','jalan','totalJalanNasional','totalJalanProvinsi','totalJalanKabupaten'));
    }
}
