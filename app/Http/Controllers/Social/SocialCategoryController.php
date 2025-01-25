<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use App\Models\SocialCategory;
use App\Http\Requests\SocialCategoryRequest;

class SocialCategoryController extends Controller
{
    public function index()
    {
        $data = SocialCategory::all();

        if ($data->isEmpty()) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data Ketagori Sosial tidak ditemukan!',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Data Ketagori Sosial berhasil ditemukan!',
            'data_sosial' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialCategoryRequest $request)
    {
        // Buat data baru di database
        $socialCategory = SocialCategory::create([
            'social_category_name' => $request->input('social_category_name'),
        ]);

        // Kembalikan respon sukses
        return response()->json([
            'status_code' => 201,
            'message' => 'Data Kategori sosial Berhasil ditambahkan.'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mengambil kategori berdasarkan ID
        $category = SocialCategory::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak Menemukan data Kategori sosial tersebut',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Data Kategori sosial Berhasil Ditemukan',
            'data' => $category,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SocialCategoryRequest $request, $id)
    {
        // Cari data kategori sosial berdasarkan ID
        $socialCategory = SocialCategory::find($id);

        // Jika data tidak ditemukan, kembalikan respon error
        if (!$socialCategory) {
            return response()->json([
                'success' => false,
                'message' => 'Data kategori sosial tidak ditemukan.',
            ], 404);
        }

        // Perbarui data di database
        $socialCategory->update([
            'social_category_name' => $request->input('social_category_name'),
        ]);

        // Kembalikan respon sukses
        return response()->json([
            'status_code' => 200,
            'message' => 'Data kategori sosial berhasil diperbarui.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mengambil kategori berdasarkan ID
        $category = SocialCategory::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Data kategori sosial tidak ditemukan',
            ], 404);
        }

        // Menghapus kategori
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data kategori sosial berhasil dihapus',
        ], 200);
    }

    public function index_filter()
{
    // Mengambil data kecuali yang memiliki social_category_name = "Akta"
    $data = SocialCategory::where('social_category_name', '!=', 'Akta')->get();

    if ($data->isEmpty()) {
        return response()->json([
            'status_code' => 404,
            'message' => 'Data Kategori Sosial tidak ditemukan!',
        ], 404);
    }

    return response()->json([
        'status_code' => 200,
        'message' => 'Data Kategori Sosial berhasil ditemukan!',
        'data_sosial' => $data,
    ], 200);
}
}
