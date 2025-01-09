<?php

namespace App\Http\Controllers\FrontOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DashboardKesehatanController extends Controller
{
    protected $token;
    protected $username;

    public function __construct()
    {
        $this->token = 'eyJpdiI6IjdNbVZPU3VUM2w4aVFUU0RhS0xzeHc9PSIsInZhbHVlIjoiWElIUVk3bnZWS0xCQTB3Q2kxQVU0aUUxNk43QmZ4V2oyU09ZbE52cWl0TT0iLCJtYWMiOiIyMGQ4Y2ExMTFlNjViMmMxMDc0YjJlM2QxZWIxNzUxYmY4OGMyNTE5NWQwZTJmZjQyM2UyMjYxNGYyODRmZjk0In0=';
        $this->username = '46B0';
    }
    public function index(Request $request){
        $kamar_tidur = $this->getKamarTidur();
        $dokter = $this->getDokter();
        $pasien = $this->getPasienBerdasarkanUmur();
        $data = $this->getKunjunganBulananRS();
        if($request->has('tahun')){
            $currentYear = $request->tahun;
        }else{
            $currentYear = 2023;
        }
        if ($data->successful()) {
            $data = $data->json();
            $bulan = $this->convertBulansToNames($data);
            $pasienBaru = collect($data)->pluck('pasien_baru'); 
            $pasienLama = collect($data)->pluck('pasien_lama'); 
        } else {
            return abort(500, 'Error fetching data');
        }
        return view('FrontOffice.kesehatan.rumah-sakit',compact('kamar_tidur','dokter','bulan','pasien','pasienBaru','pasienLama'));
    }
    private function getPasienBerdasarkanUmur(){
        $data = Http::withHeaders([
           'x-token' => $this->token,
            'x-username' => $this->username
        ])->get('https://rsudbengkulu.com:8000/cc/getPasienUmur');
        $data = $data->json();
        return $data;
    }
    private function getDokter(){
        $data = Http::withHeaders([
            'x-token' => $this->token,
            'x-username' => $this->username
        ])->get('https://rsudbengkulu.com:8000/cc/getPasienPerDokter');
        $data = $data->json();
        return $data;
    }
    private function getKamarTidur(){
        $kamar_tidur = Http::withHeaders([
            'x-token' => $this->token,
            'x-username' => $this->username
            ])->get('https://rsudbengkulu.com:8000/cc/getKetersediaanTT');
        $kamar_tidur = $kamar_tidur->json();
        return $kamar_tidur;
    }
    private function getKunjunganBulananRS()
    {
        return Http::withHeaders([
           'x-token' => $this->token,
            'x-username' => $this->username
        ])->get('https://rsudbengkulu.com:8000/cc/getKunjunganBulanan');
        $data = $data->json();
        return $data;
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
}
