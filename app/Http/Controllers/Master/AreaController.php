<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Models\Area;

class AreaController extends Controller
{

    public function index()
    {
        $data = Area::get();
        return response()->json([
            'status_code' => 200,
            'message' => "Data Daerah",
            'data_daerah' => $data
        ], 200);
    }

    public function store(AreaRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'massage' => 'Data tidak valid',
                'errors' => $request->validator->errors()
            ], 400);
        }
        
        Area::create($request->all());
        return response()->json([
            'status_code' => 201,
            'message' => 'Data daerah berhasil ditambahkan'
        ], 201);
    }

    public function show(string $id)
    {
        $data = Area::find($id);

        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Data daerah tidak ditemukan!'
            ], 404);  
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Data daerah berhasil ditemukan',
            'data_daerah' => $data
        ], 200);    
    }

    public function update(AreaRequest $request, string $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'massage' => 'Data tidak valid',
                'errors' => $request->validator->errors()
            ], 400);
        }

        $data = Area::find($id);

        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Data daerah tidak ditemukan!'
            ], 404);  
        }

        $data->update($request->all());
        return response()->json([
            'status_code' => 200,
            'message' => 'Data daerah berhasil diubah'
        ], 200);    
    }

    public function destroy(string $id)
    {
        $data = Area::find($id);

        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Data daerah tidak ditemukan!'
            ], 404);  
        }

        $data->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Data daerah berhasil dihapus'
        ], 200);  
    }
}
