<?php

namespace App\Http\Controllers;

use App\Services\PembangunanGenderService;
use App\Models\PembangunanGender;
use Illuminate\Http\Request;

class PembangunanGenderController extends Controller
{
    protected $pembangunanService;

    public function __construct(PembangunanGenderService $pembangunanService)
    {
        $this->pembangunanService = $pembangunanService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(PembangunanGender::with(['daerah', 'tahun'])->get());
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
            'jumlah' => 'required|numeric|min:0',
        ]);

        $data = PembangunanGender::create($request->all());
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = PembangunanGender::with(['daerah', 'tahun'])->findOrFail($id);
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
        $data = PembangunanGender::findOrFail($id);

        $request->validate([
            'daerah_id' => 'required|exists:daerah,id',
            'tahun_id' => 'required|exists:tahun,id',
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
        $data = PembangunanGender::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Data deleted successfully']);
    }
}
