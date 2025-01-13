<?php

namespace App\Http\Controllers;

use App\Services\TahunService;
use App\Models\Tahun;
use Illuminate\Http\Request;

class TahunController extends Controller
{
    protected $tahunService;

    public function __construct(TahunService $tahunService)
    {
        $this->tahunService = $tahunService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Tahun::all());
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
            'tahun' => 'required|integer|min:1900|max:2100',
        ]);

        $data = Tahun::create($request->all());
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Tahun::findOrFail($id);
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
        $data = Tahun::findOrFail($id);

        $request->validate([
            'tahun' => 'required|integer|min:1900|max:2100',
        ]);

        $data->update($request->all());
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Tahun::findOrFail($id);
        $data->delete();
        return response()->json(['message' => 'Data deleted successfully']);
    }
}
