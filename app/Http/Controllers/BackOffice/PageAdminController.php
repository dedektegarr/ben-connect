<?php

namespace App\Http\Controllers\BackOffice;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class PageAdminController extends Controller
{
    public function dashboard()
    {
        return view('BackOffice.dashboard');
    }

    public function user()
    {
        return view('BackOffice.user.user');
    }

    public function user_role()
    {
        return view('BackOffice.user.user_role');
    }

    public function datarumahsakit()
    {
        return view('BackOffice.kesehatan.datarumahsakit');
    }

    public function rsud()
    {
        return view('BackOffice.kesehatan.rsud');
    }

    public function indexrumahsakit()
    {
        return view('BackOffice.kesehatan.indexrumahsakit');
    }

    public function pendidikan(Request $request)
    {
        $data_sd = File::json('assets/data_json/pendidikan/jumlah_sd.json');
        $data_smp = File::json('assets/data_json/pendidikan/jumlah_smp.json');
        $data_sma = File::json('assets/data_json/pendidikan/jumlah_sma.json');
        $data_smk = File::json('assets/data_json/pendidikan/jumlah_smk.json');
        $years = collect($data_sd)->map(function ($item) {
            return substr($item['created_at'], 0, 4);
        })->unique()->sort()->values();

        $selectedKabupaten = $request->input('kab_kota', 'all');

        return view('BackOffice.pendidikan', compact('data_sd', 'data_smp', 'data_sma', 'data_smk', 'years', 'selectedKabupaten'));
    }
    public function kesehatan_maps(Request $request)
    {
        $data_rs = File::json('assets/data_json/kesehatan/rumah_sakit.json');
        return view('BackOffice.kesehatan-maps', compact('data_rs'));
    }
    public function kesehatan(Request $request)
    {
        $token = 'eyJpdiI6IjdNbVZPU3VUM2w4aVFUU0RhS0xzeHc9PSIsInZhbHVlIjoiWElIUVk3bnZWS0xCQTB3Q2kxQVU0aUUxNk43QmZ4V2oyU09ZbE52cWl0TT0iLCJtYWMiOiIyMGQ4Y2ExMTFlNjViMmMxMDc0YjJlM2QxZWIxNzUxYmY4OGMyNTE5NWQwZTJmZjQyM2UyMjYxNGYyODRmZjk0In0=';
        $username = '46B0';
        $list = array(
            array("Data Rekap Pasien Harian di Provinsi Bengkulu", 'pasien_harian'),
            array("Data Rekap Pasien Bulanan di Provinsi Bengkulu", 'pasien_bulanan'),
            array("Data Rekap Kamar Rumah Sakit di Provinsi Bengkulu", 'kamar'),
            array("Data Rekap Ketersediaan Kamar di Provinsi Bengkulu", 'ketersedian_kamar'),
            array("Data Rekap Kunjungan Poli di Provinsi Bengkulu", 'kunjungan_poli'),
            array("Data Rekap Pasien Berdasarkan Umur Bengkulu", 'pasien_berdasarkan_umur'),
            array("Data Rekap Dokter Bengkulu", 'dokter'),
        );


        if ($request->input('data') == 'pasien_harian') {
            $data = Http::withHeaders([
                'x-token' => $token,
                'x-username' => $username
            ])->get('https://rsudbengkulu.com:8000/cc/getKunjunganHarian');
        } elseif ($request->input('data') == 'pasien_bulanan') {
            $data = Http::withHeaders([
                'x-token' => $token,
                'x-username' => $username
            ])->get('https://rsudbengkulu.com:8000/cc/getKunjunganBulanan');
        } elseif ($request->input('data') == 'kamar') {
            $data = Http::withHeaders([
                'x-token' => $token,
                'x-username' => $username
            ])->get('https://rsudbengkulu.com:8000/cc/getKetersediaanKamar');
        } elseif ($request->input('data') == 'ketersedian_kamar') {
            $data = Http::withHeaders([
                'x-token' => $token,
                'x-username' => $username
            ])->get('https://rsudbengkulu.com:8000/cc/getKetersediaanTT');
        } elseif ($request->input('data') == 'kunjungan_poli') {
            $data = Http::withHeaders([
                'x-token' => $token,
                'x-username' => $username
            ])->get('https://rsudbengkulu.com:8000/cc/getPelayananPoli');
        } elseif ($request->input('data') == 'pasien_berdasarkan_umur') {
            $data = Http::withHeaders([
                'x-token' => $token,
                'x-username' => $username
            ])->get('https://rsudbengkulu.com:8000/cc/getPasienUmur');
        } elseif ($request->input('data') == 'dokter') {
            $data = Http::withHeaders([
                'x-token' => $token,
                'x-username' => $username
            ])->get('https://rsudbengkulu.com:8000/cc/getPasienPerDokter');
        } else {
            $data = Http::withHeaders([
                'x-token' => $token,
                'x-username' => $username
            ])->get('https://rsudbengkulu.com:8000/cc/getKunjunganHarian');
        }
        $data = $data->json();
        return view('BackOffice.kesehatan', compact('data', 'list'));
    }
    public function kependudukan(Request $request)
    {
        // Load JSON files
        $indeks_angka_kemiskinan = File::json('assets/data_json/sosial/indeks_angka_kemiskinan.json');
        $indeks_pembangunan_gender = File::json('assets/data_json/sosial/indeks_pembangunan_gender.json');
        $indeks_pembangunan_manusia = File::json('assets/data_json/sosial/indeks_pembangunan_manusia.json');
        $indeks_pemberdayaan_gender = File::json('assets/data_json/sosial/indeks_pemberdayaan_gender.json');

        $kab_kota = collect($indeks_angka_kemiskinan)->map(function ($item) {
            return $item['nama_daerah'];
        })->unique()->sort()->values();

        if ($request->jenis_data == "indeks_angka_kemiskinan") {
            $selectedKabupaten = $request->input('kab_kota', 'all');
            $selectedJenisData = $request->input('jenis_data', 'indeks_angka_kemiskinan');
            $selectedTahun = $request->input('tahun');
            $filteredData = collect($indeks_angka_kemiskinan)->filter(function ($item) use ($selectedKabupaten, $selectedTahun) {
                return ($selectedKabupaten == 'all' || $item['nama_daerah'] == $selectedKabupaten) &&
                    substr($item['tanggal_terbit'], 0, 4) == $selectedTahun;
            });
        } elseif ($request->jenis_data == "indeks_pembangunan_gender") {
            $selectedKabupaten = $request->input('kab_kota', 'all');
            $selectedJenisData = $request->input('jenis_data', 'indeks_pembangunan_gender');
            $selectedTahun = $request->input('tahun');
            $filteredData = collect($indeks_pembangunan_gender)->filter(function ($item) use ($selectedKabupaten, $selectedTahun) {
                return ($selectedKabupaten == 'all' || $item['nama_daerah'] == $selectedKabupaten) &&
                    substr($item['tahun'], 0, 4) == $selectedTahun;
            });
        } elseif ($request->jenis_data == "indeks_pembangunan_manusia") {
            $selectedKabupaten = $request->input('kab_kota', 'all');
            $selectedJenisData = $request->input('jenis_data', 'indeks_pembangunan_manusia');
            $selectedTahun = $request->input('tahun');
            $filteredData = collect($indeks_pembangunan_manusia)->filter(function ($item) use ($selectedKabupaten, $selectedTahun) {
                return ($selectedKabupaten == 'all' || $item['nama_daerah'] == $selectedKabupaten) &&
                    substr($item['tanggal_terbit'], 0, 4) == $selectedTahun;
            });
        } elseif ($request->jenis_data == "indeks_pemberdayaan_gender") {
            $selectedKabupaten = $request->input('kab_kota', 'all');
            $selectedJenisData = $request->input('jenis_data', 'indeks_pemberdayaan_gender');
            $selectedTahun = $request->input('tahun');
            $filteredData = collect($indeks_pemberdayaan_gender)->filter(function ($item) use ($selectedKabupaten, $selectedTahun) {
                return ($selectedKabupaten == 'all' || $item['nama_daerah'] == $selectedKabupaten) &&
                    substr($item['tahun'], 0, 4) == $selectedTahun;
            });
        } else {
            $selectedKabupaten = $request->input('kab_kota', 'all');
            $selectedJenisData = $request->input('jenis_data', 'indeks_angka_kemiskinan');
            $selectedTahun = $request->input('tahun');
            $filteredData = collect($indeks_angka_kemiskinan)->filter(function ($item) use ($selectedKabupaten, $selectedTahun) {
                return ($selectedKabupaten == 'all' || $item['nama_daerah'] == $selectedKabupaten) &&
                    substr($item['tanggal_terbit'], 0, 4) == $selectedTahun;
            });
        }
        return view('BackOffice.kependudukan', compact(
            'indeks_angka_kemiskinan',
            'indeks_pembangunan_gender',
            'indeks_pembangunan_manusia',
            'indeks_pemberdayaan_gender',
            'selectedKabupaten',
            'kab_kota',
            'filteredData'
        ));
    }

    public function infrastruktur(Request $request)
    {
        $jalan = File::json('assets/data_json/infrastruktur/data-jalan.json');
        $kab_kota = collect($jalan)->map(function ($item) {
            return $item['nama_daerah'];
        })->unique()->sort()->values();

        $jalan_chart_tahun = array_filter($jalan, function ($item) {
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
        $filteredData = collect($jalan)->filter(function ($item) use ($selectedKabupaten, $selectedTahun) {
            return ($selectedKabupaten == 'all' || $item['nama_daerah'] == $selectedKabupaten) &&
                substr($item['tahun'], 0, 4) == $selectedTahun;
        });
        return view('BackOffice.infrastruktur.infrastruktur', compact('kab_kota', 'selectedKabupaten', 'filteredData', 'jalan', 'totalJalanNasional', 'totalJalanProvinsi', 'totalJalanKabupaten'));
    }

    public function bencana(Request $request)
    {
        $bencana = File::json('assets/data_json/kebencanaan/data-bencana.json');
        $kab_kota = collect($bencana)->map(function ($item) {
            return $item['nama_daerah'];
        })->unique()->sort()->values();

        $selectedKabupaten = $request->input('kab_kota', 'all');
        $selectedTahun = 2023;
        $filteredData = collect($bencana)->filter(function ($item) use ($selectedKabupaten, $selectedTahun) {
            return ($selectedKabupaten == 'all' || $item['nama_daerah'] == $selectedKabupaten) &&
                substr($item['tahun'], 0, 4) == $selectedTahun;
        });
        return view('BackOffice.bencana', compact('kab_kota', 'selectedKabupaten', 'filteredData', 'bencana'));
    }

    public function komoditas(Request $request)
    {
        $bahanPokok = json_decode(File::get('assets/data_json/komoditas/bahan_pokok.json'), true);
        $komoditas = json_decode(File::get('assets/data_json/komoditas/komoditi.json'), true);
        $bahanPokokData = collect($bahanPokok);
        $komoditasData = collect($komoditas);

        $bahanPokokWithKomoditas = $bahanPokokData->map(function ($bahanPokok) use ($komoditasData) {
            $komoditas = $komoditasData->firstWhere('id_komoditi', $bahanPokok['id_komoditi']);
            $bahanPokok['komoditi'] = $komoditas['komoditi'] ?? 'Tidak diketahui';
            $bahanPokok['color'] = $komoditas['color'];
            return $bahanPokok;
        });

        if ($request->pasar != '' && $request->komoditas != '') {
            $bahanPokokWithKomoditas = $bahanPokokWithKomoditas->filter(function ($item) use ($request) {
                return $item['komoditi'] == $request->komoditas && $item['pasar'] == $request->pasar;
            });
        } elseif ($request->komoditas != '') {
            $bahanPokokWithKomoditas = $bahanPokokWithKomoditas->filter(function ($item) use ($request) {
                return $item['komoditi'] == $request->komoditas;
            });
        } else if ($request->pasar != '') {
            $bahanPokokWithKomoditas = $bahanPokokWithKomoditas->filter(function ($item) use ($request) {
                return $item['pasar'] == $request->pasar;
            });
        }
        $bahanPokokWithKomoditas = $bahanPokokWithKomoditas->values();
        $jumlahBahanPokokKomoditas = $this->countBahanPokokPerKomoditas($bahanPokokWithKomoditas, $komoditasData);
        $pasarData = collect($bahanPokok)->pluck('pasar')->unique()->take(2);
        $komoditasData = collect($komoditas)->pluck('komoditi')->unique();
        return view('BackOffice.komoditas', compact('bahanPokokWithKomoditas', 'pasarData', 'komoditasData', 'jumlahBahanPokokKomoditas'));
    }
    private function countBahanPokokPerKomoditas($bahanPokokWithKomoditas, $komoditasData)
    {
        $jumlahKomoditas = $komoditasData->pluck('komoditi')->unique()->values()->toArray();
        $jumlahBahanPokokKomoditas = [];
        foreach ($jumlahKomoditas as $komoditi) {
            $jumlahBahanPokokKomoditas[$komoditi] = $bahanPokokWithKomoditas->filter(function ($item) use ($komoditi) {
                return $item['komoditi'] === $komoditi;
            })->count();
        }
        return $jumlahBahanPokokKomoditas;
    }


    public function mode_dark_light()
    {
        if (session()->get('mode') == 'dark') {
            session()->put('mode', "light");
        } else {
            session()->put('mode', "dark");
        }
        return redirect()->back();
    }
}
