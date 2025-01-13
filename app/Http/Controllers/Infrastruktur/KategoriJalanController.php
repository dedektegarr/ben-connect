<?php

namespace App\Http\Controllers\Infrastruktur;

use App\Http\Controllers\Controller;
use App\Models\KategoriJalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriJalanController extends Controller
{

    public function index()
    {
        $data = KategoriJalan::get();
        
        return response()->json([
            'success' => true,
            'message' => "Kategori Jalan",
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required|max:100'
        ]);      

        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Input data gagal!',
                'errors' => $validator->errors()
            ]);
        }

        KategoriJalan::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Input data berasil'
        ]);
    }

    public function show(string $id)
    {
        $data = KategoriJalan::find($id);

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
            'kategori_jalan' => 'required|max:100'
        ]);      

        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Ubah data gagal!',
                'errors' => $validator->errors()
            ]);
        }

        $data = KategoriJalan::find($id);

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
        $data = KategoriJalan::find($id);

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
