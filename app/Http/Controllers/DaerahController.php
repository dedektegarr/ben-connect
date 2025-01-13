<?php

namespace App\Http\Controllers;

use App\Services\DaerahService;
use Illuminate\Http\Request;
use App\Models\Daerah;

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
        return response()->json($daerah);
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
            'nama_daerah' => 'required|string|max:100',
        ]);

        $daerah = Daerah::create($request->all());
        return response()->json($daerah, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $daerah = Daerah::findOrFail($id);
        return response()->json($daerah);
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
        $request->validate([
            'nama_daerah' => 'required|string|max:100',
        ]);

        $daerah = Daerah::findOrFail($id);
        $daerah->update($request->all());
        return response()->json($daerah);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $daerah = Daerah::findOrFail($id);
        $daerah->delete();
        return response()->noContent();
    }
}
