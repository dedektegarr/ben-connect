<?php

namespace App\Http\Controllers;

use App\Models\Akta;
use App\Services\AktaService;
use Illuminate\Http\Request;

class AktaController extends Controller
{
    protected $aktaService;

    public function __construct(AktaService $aktaService)
    {
        $this->aktaService = $aktaService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Akta::with(['daerah', 'tahun'])->get());
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
            'tahun_id' => 'required|exists:tahun,id',
            'jumlah_penduduk' => 'required|numeric|min:0',
            'ada' => 'required|numeric|min:0',
            'tidak_ada' => 'required|numeric|min:0',
        ]);

        $data = Akta::create($request->all());
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Akta::with(['daerah', 'tahun'])->findOrFail($id);
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
        $data = Akta::findOrFail($id);

        $request->validate([
            'daerah_id' => 'required|exists:daerah,id',
            'tahun_id' => 'required|exists:tahun,id',
            'jumlah_penduduk' => 'required|numeric|min:0',
            'ada' => 'required|numeric|min:0',
            'tidak_ada' => 'required|numeric|min:0',
        ]);

        $data->update($request->all());
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Akta::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Data deleted successfully']);
    }
}
