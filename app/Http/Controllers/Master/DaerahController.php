<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Daerah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DaerahController extends Controller
{

    public function index()
    {
        $data = Daerah::get();
        return response()->json([
            'success' => true,
            'message' => "Daerah",
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_daerah' => 'required|max:100'
        ]);      

        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Input data gagal!',
                'errors' => $validator->errors()
            ]);
        }

        Daerah::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Input data berhasil'
        ]);
    }

    public function show(string $id)
    {
        $data = Daerah::find($id);

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
            'nama_daerah' => 'required|max:100'
        ]);      

        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Ubah data gagal!',
                'errors' => $validator->errors()
            ]);
        }

        $data = Daerah::find($id);

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
        $data = Daerah::find($id);

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
