<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\DatasetRequest;
use App\Models\Dataset;

class DatasetController extends Controller
{
    
    public function index()
    {
        $data = Dataset::get();
        
        return response()->json([
            'status_code' => 200,
            'message' => "Data Dataset",
            'data_tahun_data' => $data
        ], 200);
    }

    public function store(DatasetRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'massage' => 'Data tidak valid',
                'errors' => $request->validator->errors()
            ], 400);
        }

        Dataset::create($request->all());
        return response()->json([
            'status_code' => 201,
            'message' => 'Dataset berhasil ditambahkan'
        ], 201);
    }

    public function show(string $id)
    {
        $data = Dataset::find($id);

        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Dataset tidak ditemukan!'
            ], 404);  
        }
        
        return response()->json([
            'status_code' => 200,
            'message' => 'Dataset berhasil ditemukan',
            'data_tahun_data' => $data
        ], 200);   
    }

    public function update(DatasetRequest $request, string $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'massage' => 'Data tidak valid',
                'errors' => $request->validator->errors()
            ], 400);
        }

        $data = Dataset::find($id);

        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Dataset tidak ditemukan!'
            ], 404);  
        }

        $data->update($request->all());
        return response()->json([
            'status_code' => 200,
            'message' => 'Dataset berhasil diubah'
        ], 200);
    }

    public function destroy(string $id)
    {
        $data = Dataset::find($id);

        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Dataset tidak ditemukan!'
            ], 404);  
        }

        $data->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Dataset berhasil dihapus'
        ], 200);  
    }
}
