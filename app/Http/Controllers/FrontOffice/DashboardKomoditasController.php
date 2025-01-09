<?php

namespace App\Http\Controllers\FrontOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class DashboardKomoditasController extends Controller
{
    protected $bahanPokok, $komoditas;

    public function __construct()
    {
        $this->bahanPokok = json_decode(File::get('assets/data_json/komoditas/bahan_pokok.json'), true);
        $this->komoditas = json_decode(File::get('assets/data_json/komoditas/komoditi.json'), true);
    }

    public function index(Request $request)
    {
        $bahanPokokData = collect($this->bahanPokok);
        $komoditasData = collect($this->komoditas);

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
        $pasarData = collect($this->bahanPokok)->pluck('pasar')->unique()->take(2);
        $komoditasData = collect($this->komoditas)->pluck('komoditi')->unique();
        return view('FrontOffice.komoditas.komoditas', compact('bahanPokokWithKomoditas', 'pasarData', 'komoditasData', 'jumlahBahanPokokKomoditas'));
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
}
