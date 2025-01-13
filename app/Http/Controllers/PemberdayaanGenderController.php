<?php

namespace App\Http\Controllers;

use App\Services\PemberdayaanGenderService;
use App\Models\PemberdayaanGender;
use Illuminate\Http\Request;

class PemberdayaanGenderController extends Controller
{
    protected $pemberdayaangenderService;

    public function __construct(PemberdayaanGenderService $pemberdayaangenderService)
    {
        $this->pemberdayaangenderService = $pemberdayaangenderService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(PemberdayaanGender::with(['daerah', 'tahun'])->get());
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

        $data = PemberdayaanGender::create($request->all());
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = PemberdayaanGender::with(['daerah', 'tahun'])->findOrFail($id);
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
        $data = PemberdayaanGender::findOrFail($id);

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
        $data = PemberdayaanGender::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Data deleted successfully']);
    }
}
