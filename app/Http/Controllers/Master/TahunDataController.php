<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\TahunData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TahunDataController extends Controller
{
    
    public function index()
    {
        $data = TahunData::get();
        
        return response()->json([
            'success' => true,
            'message' => "Tahun Data",
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required|digits:4'
        ]);      

        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Input data gagal!',
                'errors' => $validator->errors()
            ]);
        }

        TahunData::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Input data berasil'
        ]);
    }

    public function show(string $id)
    {
        $data = TahunData::find($id);

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
            'tahun' => 'required|digits:4'
        ]);      

        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Ubah data gagal!',
                'errors' => $validator->errors()
            ]);
        }

        $data = TahunData::find($id);

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
        $data = TahunData::find($id);

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
}
