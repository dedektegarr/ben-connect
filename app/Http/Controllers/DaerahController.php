<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DaerahModel;
use App\Http\Requests\DaerahRequest;
use Illuminate\Http\Request;

class DaerahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            "data_daerah"=>DaerahModel::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DaerahRequest $request)
    {
        $daerah = DaerahModel::create([
            'daerah_nama' => $request->daerah_nama,
        ]);

        return response()->json([
            'message' => 'Data daerah berhasil disimpan.',
            'data_daerah' => $daerah,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $daerah_id)
    {
        // Mencari data daerah berdasarkan daerah_id
        $daerah = DaerahModel::find($daerah_id);

        // Jika data tidak ditemukan, kembalikan error 404
        if (!$daerah) {
            return response()->json([
                'message' => 'Data daerah tidak ditemukan.',
            ], 404);
        }

        // Mengembalikan data daerah dalam bentuk JSON
        return response()->json([
            'data_daerah' => $daerah,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DaerahRequest $request, string $daerah_id)
    {
        $daerah = DaerahModel::findOrFail($daerah_id);

        $daerah->update([
            'daerah_nama' => $request->daerah_nama,
        ]);

        return response()->json([
            'message' => 'Data daerah berhasil diupdate.',
            'data_daerah' => $daerah,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $daerah_id)
    {
        $daerah = DaerahModel::findOrFail($daerah_id);
        $daerah->delete();

        return response()->json([
            'message' => 'Data daerah berhasil dihapus.',
        ]);
    }
}
