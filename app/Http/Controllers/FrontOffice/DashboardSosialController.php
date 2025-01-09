<?php

namespace App\Http\Controllers\FrontOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class DashboardSosialController extends Controller
{
    protected $indeks_angka_kemiskinan;
    protected $indeks_pembangunan_gender;
    protected $indeks_pembangunan_manusia;
    protected $indeks_pemberdayaan_gender;

    public function __construct()
    {
        $this->akta = File::json('assets/data_json/sosial/akta_0_18_tahun.json');
        $this->indeks_angka_kemiskinan = File::json('assets/data_json/sosial/indeks_angka_kemiskinan.json');
        $this->indeks_pembangunan_gender = File::json('assets/data_json/sosial/indeks_pembangunan_gender.json');
        $this->indeks_pembangunan_manusia = File::json('assets/data_json/sosial/indeks_pembangunan_manusia.json');
        $this->indeks_pemberdayaan_gender = File::json('assets/data_json/sosial/indeks_pemberdayaan_gender.json');
    }
    public function index(Request $request){
        $kab_kota = collect($this->indeks_angka_kemiskinan)->map(function($item) {
            return $item['nama_daerah']; 
        })->unique()->sort()->values();

        if ($request->tahun != null) {
            $tahun = $request->tahun;
        }else{
            $tahun = 2022;
        }

        $chart_indeks_angka_kemiskinan = $this->getIndeksAngkaKemiskinan($tahun);
        $chart_indeks_pembangunan_gender = $this->getIndeksPembangunanGender($tahun);
        $chart_indeks_pembangunan_manusia = $this->getIndeksPembangunanManusia($tahun);
        $chart_indeks_pemerdayaan_gender = $this->getIndeksPemberdayaanGender($tahun);
        if ($request->jenis_data == "indeks_angka_kemiskinan"){
            $selectedKabupaten = $request->input('kab_kota', 'all');
            $selectedJenisData = $request->input('jenis_data', 'indeks_angka_kemiskinan');
            $selectedTahun = $tahun;
            $filteredData = collect($this->indeks_angka_kemiskinan)->filter(function($item) use ($selectedKabupaten, $selectedTahun) {
                return ($selectedKabupaten == 'all' || $item['nama_daerah'] == $selectedKabupaten) &&
                substr($item['tanggal_terbit'], 0, 4) == $selectedTahun;
            });
        }
        elseif($request->jenis_data == "indeks_pembangunan_gender"){
            $selectedKabupaten = $request->input('kab_kota', 'all');
            $selectedJenisData = $request->input('jenis_data', 'indeks_pembangunan_gender');
            $selectedTahun = $tahun;
            $filteredData = collect($this->indeks_pembangunan_gender)->filter(function($item) use ($selectedKabupaten, $selectedTahun) {
                return ($selectedKabupaten == 'all' || $item['nama_daerah'] == $selectedKabupaten) &&
                substr($item['tahun'], 0, 4) == $selectedTahun;
            });
        }elseif($request->jenis_data == "indeks_pembangunan_manusia"){
            $selectedKabupaten = $request->input('kab_kota', 'all');
            $selectedJenisData = $request->input('jenis_data', 'indeks_pembangunan_manusia');
            $selectedTahun = $tahun;
            $filteredData = collect($this->indeks_pembangunan_manusia)->filter(function($item) use ($selectedKabupaten, $selectedTahun) {
                return ($selectedKabupaten == 'all' || $item['nama_daerah'] == $selectedKabupaten) &&
                substr($item['tanggal_terbit'], 0, 4) == $selectedTahun;
            });
        }elseif($request->jenis_data == "indeks_pemberdayaan_gender"){
            $selectedKabupaten = $request->input('kab_kota', 'all');
            $selectedJenisData = $request->input('jenis_data', 'indeks_pemberdayaan_gender');
            $selectedTahun = $tahun;
            $filteredData = collect($this->indeks_pemberdayaan_gender)->filter(function($item) use ($selectedKabupaten, $selectedTahun) {
                return ($selectedKabupaten == 'all' || $item['nama_daerah'] == $selectedKabupaten) &&
                substr($item['tahun'], 0, 4) == $selectedTahun;
            });
        }
        else {
            $selectedKabupaten = $request->input('kab_kota', 'all');
            $selectedJenisData = $request->input('jenis_data', 'indeks_angka_kemiskinan');
            $selectedTahun = $request->input('tahun');
            $filteredData = collect($this->indeks_angka_kemiskinan)->filter(function($item) use ($selectedKabupaten, $selectedTahun) {
                return ($selectedKabupaten == 'all' || $item['nama_daerah'] == $selectedKabupaten) &&
                substr($item['tanggal_terbit'], 0, 4) == $selectedTahun;
            });
        }
        return view('FrontOffice.sosial.sosial',compact('chart_indeks_angka_kemiskinan','chart_indeks_pembangunan_gender','chart_indeks_pembangunan_manusia','chart_indeks_pemerdayaan_gender'), [ 'akta'=>$this->akta,
            'indeks_angka_kemiskinan' => $this->indeks_angka_kemiskinan,'indeks_pembangunan_gender'=>$this->indeks_pembangunan_gender,'indeks_pembangunan_manusia'=>$this->indeks_pembangunan_manusia,'indeks_pemberdayaan_gender'=>$this->indeks_pemberdayaan_gender, 'selectedKabupaten'=>$selectedKabupaten, 'kab_kota'=>$kab_kota, 'filteredData'=>$filteredData]
        );
    }
    private function getIndeksAngkaKemiskinan($tahun_data) {
        // Initialize arrays for nama daerah and jumlah
        $namaDaerahArray = [];
        $jumlahArray = [];
    
        // Filter the data based on the selected year
        $filteredData = collect($this->indeks_angka_kemiskinan)
            ->filter(function($item) use ($tahun_data) {
                return strpos($item['tanggal_terbit'], $tahun_data) === 0; 
            });
    
        // Populate the nama daerah and jumlah arrays
        foreach ($filteredData as $item) {
            $namaDaerahArray[] = $item['nama_daerah']; // Store nama daerah
            $jumlahArray[] = $item['jumlah'];           // Store jumlah
        }
    
        // Return the two arrays
        return [
            'nama_daerah' => $namaDaerahArray,
            'jumlah' => $jumlahArray,
        ];
    }
    private function getIndeksPembangunanGender($tahun_data){
        // Initialize arrays for nama daerah and jumlah
        $namaDaerahArray = [];
        $jumlahArray = [];
    
        // Filter the data based on the selected year
        $filteredData = collect($this->indeks_pembangunan_gender)
            ->filter(function($item) use ($tahun_data) {
                return strpos($item['tahun'], $tahun_data) === 0; 
            });
    
        // Populate the nama daerah and jumlah arrays
        foreach ($filteredData as $item) {
            $namaDaerahArray[] = $item['nama_daerah']; // Store nama daerah
            $jumlahArray[] = $item['jumlah'];           // Store jumlah
        }
    
        // Return the two arrays
        return [
            'nama_daerah' => $namaDaerahArray,
            'jumlah' => $jumlahArray,
        ];
    }
    private function getIndeksPembangunanManusia($tahun_data){
        // Initialize arrays for nama daerah and jumlah
        $namaDaerahArray = [];
        $jumlahArray = [];
    
        // Filter the data based on the selected year
        $filteredData = collect($this->indeks_pembangunan_manusia)
            ->filter(function($item) use ($tahun_data) {
                return strpos($item['tanggal_terbit'], $tahun_data) === 0; 
            });
    
        // Populate the nama daerah and jumlah arrays
        foreach ($filteredData as $item) {
            $namaDaerahArray[] = $item['nama_daerah']; // Store nama daerah
            $jumlahArray[] = $item['jumlah'];           // Store jumlah
        }
    
        // Return the two arrays
        return [
            'nama_daerah' => $namaDaerahArray,
            'jumlah' => $jumlahArray,
        ];
    }
    private function getIndeksPemberdayaanGender($tahun_data){
         // Initialize arrays for nama daerah and jumlah
         $namaDaerahArray = [];
         $jumlahArray = [];
     
         // Filter the data based on the selected year
         $filteredData = collect($this->indeks_pemberdayaan_gender)
             ->filter(function($item) use ($tahun_data) {
                 return strpos($item['tahun'], $tahun_data) === 0; 
             });
     
         // Populate the nama daerah and jumlah arrays
         foreach ($filteredData as $item) {
             $namaDaerahArray[] = $item['nama_daerah']; // Store nama daerah
             $jumlahArray[] = $item['jumlah'];           // Store jumlah
         }
     
         // Return the two arrays
         return [
             'nama_daerah' => $namaDaerahArray,
             'jumlah' => $jumlahArray,
         ];
    }

    public function kependudukan(Request $request){
        $akta = $this->akta;
        $kab_kota = collect($this->akta)->map(function($item) {
            return $item['nama_daerah']; 
        })->unique()->sort()->values();
        if ($request->tahun != null) {
            $tahun = $request->tahun;
        }else{
            $tahun = 2023;
        }
        $selectedKabupaten = $request->input('kab_kota', 'all');
        $selectedJenisData = $request->input('jenis_data', 'akta');
        $selectedTahun = $tahun;
        $filteredData = collect($this->akta)->filter(function($item) use ($selectedKabupaten, $selectedTahun) {
            return ($selectedKabupaten == 'all' || $item['nama_daerah'] == $selectedKabupaten) &&
            substr($item['tahun'], 0, 4) == $selectedTahun;
        });
        return view('FrontOffice.sosial.kependudukan',compact('akta'), [
            'selectedKabupaten'=>$selectedKabupaten, 'kab_kota'=>$kab_kota, 'filteredData'=>$filteredData]
        );
    }
}
