<?php

namespace App\Http\Controllers\Infrastructure;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoadCategoryRequest;
use App\Models\RoadCategory;

class RoadCategoryController extends Controller
{

    public function index()
    {
        $data = RoadCategory::get();
        return response()->json([
            'status_code' => 200,
            'message' => "Data Kategori Jalan",
            'data_kategori_jalan' => $data
        ], 200);
    }

    public function store(RoadCategoryRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'massage' => 'Data tidak valid',
                'errors' => $request->validator->errors()
            ], 400);
        }

        RoadCategory::create($request->all());
        return response()->json([
            'status_code' => 201,
            'message' => 'Data kategori jalan berhasil ditambahkan'
        ], 201);
    }

    public function show(string $id)
    {
        $data = RoadCategory::find($id);

        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Data kategori jalan tidak ditemukan!'
            ], 404);  
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Data kategori jalan berhasil ditemukan',
            'data_kategori_jalan' => $data
        ], 200);
    }

    public function update(RoadCategoryRequest $request, string $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'massage' => 'Data tidak valid',
                'errors' => $request->validator->errors()
            ], 400);
        }

        $data = RoadCategory::find($id);

        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Data kategori jalan tidak ditemukan!'
            ], 404);  
        }

        $data->update($request->all());
        return response()->json([
            'status_code' => 200,
            'message' => 'Data kategori jalan berhasil diubah'
        ], 200);
    }


    public function destroy(string $id)
    {
        $data = RoadCategory::find($id);

        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Data kategori jalan tidak ditemukan!'
            ], 404);  
        }

        $data->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Data kategori jalan berhasil dihapus'
        ], 200); 
    }
}
