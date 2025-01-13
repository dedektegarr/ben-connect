<?php

namespace App\Http\Controllers;

use App\Services\PembangunanManusiaService;
use App\Models\PembangunanManusia;
use Illuminate\Http\Request;

class PembangunanManusiaController extends Controller
{
    protected $pembangunanmanusiaService;

    public function __construct(PembangunanManusiaService $pembangunanmanusiaService)
    {
        $this->pembangunanmanusiaService = $pembangunanmanusiaService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(PembangunanManusia::with('daerah')->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'daerah_id' => 'required|exists:daerah,id',
            'tanggal_terbit' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $data = PembangunanManusia::create($request->all());
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = PembangunanManusia::with('daerah')->findOrFail($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = PembangunanManusia::findOrFail($id);

        $request->validate([
            'daerah_id' => 'required|exists:daerah,id',
            'tanggal_terbit' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $data->update($request->all());
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = PembangunanManusia::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Data deleted successfully']);
    }
}
