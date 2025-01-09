<?php

namespace App\Http\Controllers\FrontOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class DashboardBencanaController extends Controller
{
    public function __construct()
    {
        $this->bencana = File::json('assets/data_json/kebencanaan/data-bencana.json');
    }
    public function index(Request $request){
        $bencana = $this->bencana;
        $kab_kota = collect($this->bencana)->map(function($item) {
            return $item['nama_daerah']; 
        })->unique()->sort()->values();

            $selectedKabupaten = $request->input('kab_kota', 'all');
            $selectedTahun = 2023;
            $filteredData = collect($this->bencana)->filter(function($item) use ($selectedKabupaten, $selectedTahun) {
                return ($selectedKabupaten == 'all' || $item['nama_daerah'] == $selectedKabupaten) &&
                substr($item['tahun'], 0, 4) == $selectedTahun;
            });
        return view('FrontOffice.kebencanaan.kebencanaan', compact('kab_kota','selectedKabupaten','filteredData','bencana'));
    }
}
