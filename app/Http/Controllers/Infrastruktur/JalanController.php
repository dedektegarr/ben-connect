<?php

namespace App\Http\Controllers\Infrastruktur;

use App\Http\Controllers\Controller;
use App\Http\Resources\JalanResource;
use App\Models\Jalan;
use App\Models\TahunData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JalanController extends Controller
{

    public function index()
    {
        $data = Jalan::with(['tahunData', 'daerah', 'kategoriJalan'])->get();
        return response()->json([
            'success' => true,
            'message' => "Jalan",
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun_data_id' => 'required',
            'daerah_id' => 'required',
            'kategori_jalan_id' => 'required',
            'panjang' => 'required|numeric'
        ]);      

        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Input data gagal!',
                'errors' => $validator->errors()
            ]);
        }

        Jalan::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Input data berhasil'
        ]);
    }

    public function show(string $id)
    {
        $data = Jalan::find($id);

        if(empty($data)){
            return response()->json([
                'success' => true,
                'message' => 'Data tidak ditemukan!'
            ]);  
        }

        return response()->json([
            'success' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ]); 
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun_data_id' => 'required',
            'daerah_id' => 'required',
            'kategori_jalan_id' => 'required',
            'panjang' => 'required|numeric'
        ]);      

        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Ubah data gagal!',
                'errors' => $validator->errors()
            ]);
        }

        $data = Jalan::find($id);

        if(empty($data)){
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan!'
            ]);
        }

        $data->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Ubah data berhasil'
        ]);
    }

    public function destroy(string $id)
    {
        $data = Jalan::find($id);

        if(empty($data)){
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan!'
            ]);
        }

        $data->delete();
        return response()->json([
            'success' => true,
            'message' => 'Hapus data berhasil'
        ]);
    }
    
    public function filterJalan($tahun_data, $daerah = false)
    {
        $tahun = TahunData::find($tahun_data);
        if(!$tahun){
            return response()->json([
                'success' => false,
                'message' => "Data tidak ditemukan",
                'data' => []
            ]);
        }

        $tahun = $tahun->first();
        $data = Jalan::where('tahun_data_id', $tahun_data);

        if($daerah){
            $data->where('daerah_id', $daerah);
        }

        $jalan = $data->with(['daerah', 'kategoriJalan', 'tahunData'])->get();

        //Remap data jalan
        $jalan_remap = $jalan->groupBy(function($group){
            //Group by nama_daerah
            return $group->daerah->nama_daerah;
        })->map(function($attribute){
            return [
                'data_jalan '=> $attribute->map(function($value){
                        return [
                            'kategori_jalan' => $value->kategoriJalan->kategori,
                            'panjang' => $value->panjang
                        ];
                    }),
                //Hitung total panjang jalan
                'total_panjang_jalan' => $attribute->sum('panjang'),
            ];
        });

        return response()->json([
            'success' => true,
            'message' => "Data Jalan Tahun ".$tahun['tahun'],
            'data' => $jalan_remap
        ]);
        
    }
}
