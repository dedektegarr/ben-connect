<?php

namespace App\Http\Controllers\FrontOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class DashboardPendidikanController extends Controller
{
    public function index(Request $request){
        $data_sd = File::json('assets/data_json/pendidikan/jumlah_sd.json');
        $data_smp = File::json('assets/data_json/pendidikan/jumlah_smp.json');
        $data_sma = File::json('assets/data_json/pendidikan/jumlah_sma.json');
        $data_smk = File::json('assets/data_json/pendidikan/jumlah_smk.json');

        // Gabungkan dan totalkan jumlah sekolah per kabupaten
    $dataSekolahPerKabupaten = [];
    $dataGuruPerKabupaten = [];
    $dataSiswaPerKabupaten = [];
    $totalSeluruhSekolah = 0;

    foreach ([$data_sd, $data_smp, $data_sma, $data_smk] as $data) {
        foreach ($data as $item) {
            if ($item['kategori'] === 'sekolah') {
                $namaDaerah = $item['nama_daerah'];
                $jumlah = $item['jumlah'];

                // Total per kabupaten
                if (!isset($dataSekolahPerKabupaten[$namaDaerah])) {
                    $dataSekolahPerKabupaten[$namaDaerah] = 0;
                }
                $dataSekolahPerKabupaten[$namaDaerah] += $jumlah;

                // Hitung total seluruh sekolah
                $totalSeluruhSekolah += $jumlah;
            }
        }
    }
        // Pisahkan data menjadi labels dan jumlah total sekolah per daerah
        $labels = array_keys($dataSekolahPerKabupaten);
        $jumlah_total = array_values($dataSekolahPerKabupaten);
        $years = collect($data_sd)->map(function($item) {
            return substr($item['created_at'], 0, 4); 
        })->unique()->sort()->values();

        $selectedKabupaten = $request->input('kab_kota', 'all');
        
        return view('FrontOffice.pendidikan.pendidikan',compact('labels','totalSeluruhSekolah','jumlah_total','data_sd','data_smp','data_sma','data_smk','years','selectedKabupaten'));
    }
    static function getPercentSekolahSD($jumlah_sd,$jumlah_smp,$jumlah_sma,$jumlah_smk){
        $total_sekolah = $jumlah_sd + $jumlah_smp + $jumlah_sma + $jumlah_smk;
        $jumlah_sd_persen = number_format(($jumlah_sd / $total_sekolah) * 100, 2);
        return $data = array($jumlah_sd_persen,$total_sekolah);
    }
    static function getPercentSekolahSMP($jumlah_sd,$jumlah_smp,$jumlah_sma,$jumlah_smk){
        $total_sekolah = $jumlah_sd + $jumlah_smp + $jumlah_sma + $jumlah_smk;
        $jumlah_smp_persen = number_format(($jumlah_smp / $total_sekolah) * 100, 2);
        return $data = array($jumlah_smp_persen,$total_sekolah);
    }
    static function getPercentSekolahSMA($jumlah_sd,$jumlah_smp,$jumlah_sma,$jumlah_smk){
        $total_sekolah = $jumlah_sd + $jumlah_smp + $jumlah_sma + $jumlah_smk;
        $jumlah_sma_persen = number_format(($jumlah_sma / $total_sekolah) * 100, 2);
        return $data = array($jumlah_sma_persen,$total_sekolah);
    }
    static function getPercentSekolahSMK($jumlah_sd,$jumlah_smp,$jumlah_sma,$jumlah_smk){
        $total_sekolah = $jumlah_sd + $jumlah_smp + $jumlah_sma + $jumlah_smk;
        $jumlah_smk_persen = number_format(($jumlah_smk / $total_sekolah) * 100, 2);
        return $data = array($jumlah_smk_persen,$total_sekolah);
    }
    static function getJumlah($jenis){
        $data_sd = File::json('assets/data_json/pendidikan/jumlah_sd.json');
        $data_smp = File::json('assets/data_json/pendidikan/jumlah_smp.json');
        $data_sma = File::json('assets/data_json/pendidikan/jumlah_sma.json');
        $data_smk = File::json('assets/data_json/pendidikan/jumlah_smk.json');
        $dataPerKabupaten = [];
        foreach ([$data_sd, $data_smp, $data_sma, $data_smk] as $kategori => $data) {
            foreach ($data as $item) {
                if ($item['kategori'] === $jenis) {
                    $namaDaerah = $item['nama_daerah'];
                    $jumlah = $item['jumlah'];
        
                    // Buat array untuk menyimpan data per kategori
                    if (!isset($dataPerKabupaten[$namaDaerah])) {
                        $dataPerKabupaten[$namaDaerah] = [
                            'SD' => 0,
                            'SMP' => 0,
                            'SMA' => 0,
                            'SMK' => 0,
                        ];
                    }
        
                    // Tentukan kategori dan tambahkan jumlah
                    switch ($kategori) {
                        case 0:
                            $dataPerKabupaten[$namaDaerah]['SD'] += $jumlah;
                            break;
                        case 1:
                            $dataPerKabupaten[$namaDaerah]['SMP'] += $jumlah;
                            break;
                        case 2:
                            $dataPerKabupaten[$namaDaerah]['SMA'] += $jumlah;
                            break;
                        case 3:
                            $dataPerKabupaten[$namaDaerah]['SMK'] += $jumlah;
                            break;
                    }
                }
            }
        }
        return $dataPerKabupaten;
    }
}
