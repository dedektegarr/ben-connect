<?php

namespace App\Http\Controllers\FrontOffice;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    public function index()
    {
        // KESEHATAN
//        $data = $this->getKunjunganBulananRS();
        $currentYear = 2023;
//        if ($data->successful()) {
//            $data = $data->json();
//            $bulan = $this->convertBulansToNames($data);
//            $pasienBaru = collect($data)->pluck('pasien_baru'); 
//            $pasienLama = collect($data)->pluck('pasien_lama'); 
//        } else {
//            return abort(500, 'Error fetching data');
//        }
        //PENDIDIKAN
        $totalSekolahSD = $this->getTotalSekolah('jumlah_sd.json', 'sekolah', $currentYear);
        $totalSekolahSMP = $this->getTotalSekolah('jumlah_smp.json', 'sekolah', $currentYear);
        $totalSekolahSMA = $this->getTotalSekolah('jumlah_sma.json', 'sekolah', $currentYear);
        $totalSekolahSMK = $this->getTotalSekolah('jumlah_smk.json', 'sekolah', $currentYear);
        
        //SOSIAL
        $json = File::get(public_path('assets/data_json/sosial/indeks_angka_kemiskinan.json'));
        $data = json_decode($json, true);
        $latestYear = collect($data)->pluck('tanggal_terbit')->map(function($date) {
            return \Carbon\Carbon::parse($date)->year;
        })->max();

        $filteredData = collect($data)->filter(function($item) use ($latestYear) {
            return \Carbon\Carbon::parse($item['tanggal_terbit'])->year == $latestYear;
        });
        $labels = collect($data)->pluck('nama_daerah');
        $jumlah = collect($data)->pluck('jumlah');

        //return view('FrontOffice.index', compact('labels', 'jumlah','bulan','pasienBaru','pasienLama','totalSekolahSD', 'totalSekolahSMP', 'totalSekolahSMA', 'totalSekolahSMK'));
	return view('FrontOffice.index', compact('labels', 'jumlah','totalSekolahSD', 'totalSekolahSMP', 'totalSekolahSMA', 'totalSekolahSMK')); 
   }

    public function syarat_ketentuan(){
        return view('FrontOffice.syarat-ketentuan');
    }
    public function tentang(){
        return view('FrontOffice.tentang-kami');
    }
    public function feedback(){
        return view('FrontOffice.feedback');
    }
    public function opd(){
        return view('FrontOffice.list-opd');
    }

    private function getKunjunganBulananRS()
    {
        return Http::withHeaders([
            'x-token' => 'eyJpdiI6IjdNbVZPU3VUM2w4aVFUU0RhS0xzeHc9PSIsInZhbHVlIjoiWElIUVk3bnZWS0xCQTB3Q2kxQVU0aUUxNk43QmZ4V2oyU09ZbE52cWl0TT0iLCJtYWMiOiIyMGQ4Y2ExMTFlNjViMmMxMDc0YjJlM2QxZWIxNzUxYmY4OGMyNTE5NWQwZTJmZjQyM2UyMjYxNGYyODRmZjk0In0=',
            'x-username' => '46B0'
        ])->get('https://rsudbengkulu.com:8000/cc/getKunjunganBulanan');
    }

    private function convertBulansToNames($data)
    {
        $bulanNames = [
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];
        return collect($data)->pluck('bulan')->map(function ($item) use ($bulanNames) {
            return $bulanNames[$item];
        });
    }
    
   
    private function getTotalSekolah($fileName, $kategori, $year)
    {
        $data = $this->readJsonFile($fileName);

        return collect($data)
            ->where('kategori', $kategori)
            ->where(function($item) use ($year) {
                return $this->isSameYear($item['created_at'], $year);
            })
            ->sum('jumlah');
    }

    private function readJsonFile($fileName)
    {
        $filePath = public_path('assets/data_json/pendidikan/' . $fileName);
        $jsonContent = File::get($filePath);
        return json_decode($jsonContent, true);
    }

    private function isSameYear($dateString, $year)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $dateString)->year == $year;
    }
    
}
