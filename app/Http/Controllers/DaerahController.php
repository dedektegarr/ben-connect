<?php

namespace App\Http\Controllers;

use App\Services\DaerahService;
use App\Models\Daerah;
use Illuminate\Http\Request;

class DaerahController extends Controller
{
    protected $daerahService;

    public function __construct(DaerahService $daerahService)
    {
        $this->daerahService = $daerahService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daerah = Daerah::all();
        return response()->json([
            'data_daerah' => $daerah,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_daerah' => 'required|string|max:100',
        ]);

        $daerah = Daerah::create([
            'nama_daerah' => $request->nama_daerah,
        ]);

        return response()->json([
            'message' => 'Data daerah berhasil disimpan.',
            'data_daerah' => $daerah,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $daerah = Daerah::find($id);

        if (!$daerah) {
            return response()->json([
                'message' => 'Data daerah tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'data_daerah' => $daerah,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_daerah' => 'required|string|max:100',
        ]);

        $daerah = Daerah::findOrFail($id);

        $daerah->update([
            'nama_daerah' => $request->nama_daerah,
        ]);

        return response()->json([
            'message' => 'Data daerah berhasil diupdate.',
            'data_daerah' => $daerah,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $daerah = Daerah::findOrFail($id);
        $daerah->delete();

        return response()->json([
            'message' => 'Data daerah berhasil dihapus.',
        ]);
    }
}
