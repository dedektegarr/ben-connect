<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            "data_category"=>CategoryModel::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $daerah = CategoryModel::create([
            'category_nama' => $request->category_nama,
        ]);

        return response()->json([
            'message' => 'Data daerah berhasil disimpan.',
            'data_category' => $daerah,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $daerah_id)
    {
        // Mencari data daerah berdasarkan daerah_id
        $daerah = CategoryModel::find($daerah_id);

        // Jika data tidak ditemukan, kembalikan error 404
        if (!$daerah) {
            return response()->json([
                'message' => 'Data daerah tidak ditemukan.',
            ], 404);
        }

        // Mengembalikan data daerah dalam bentuk JSON
        return response()->json([
            'data_category' => $daerah,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $daerah_id)
    {
        $daerah = CategoryModel::findOrFail($daerah_id);

        $daerah->update([
            'category_nama' => $request->category_nama,
        ]);

        return response()->json([
            'message' => 'Data daerah berhasil diupdate.',
            'data_category' => $daerah,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $daerah_id)
    {
        $daerah = CategoryModel::findOrFail($daerah_id);
        $daerah->delete();

        return response()->json([
            'message' => 'Data daerah berhasil dihapus.',
        ]);
    }
}
