<?php

namespace App\Http\Controllers\Population;

use App\Http\Controllers\Controller;
use App\Http\Requests\PopulationRequest;
use App\Models\PopulationPeriod;
use Illuminate\Http\Request;

class PopulationPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PopulationPeriod::get();
        
        return response()->json([
            'status_code' => 200,
            'message' => "Periode data kependudukan",
            'data_periode_kependudukan' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formRequest = new PopulationRequest('population_age_group'); 
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        PopulationPeriod::create($request->all());
        return response()->json([
            'status_code' => 201,
            'message' => 'Periode data kependudukan berhasil ditambahkan'
        ], 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = PopulationPeriod::find($id);

        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Periode data kependudukan tidak ditemukan!'
            ], 404);  
        }
        
        return response()->json([
            'status_code' => 200,
            'message' => 'Periode data kependudukan berhasil ditemukan',
            'periode_kependudukan' => $data
        ], 200);  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $formRequest = new PopulationRequest('population_age_group'); 
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        $data = PopulationPeriod::find($id);
        $data->update($request->all());
        return response()->json([
            'status_code' => 201,
            'message' => 'Periode data kependudukan berhasil diubah'
        ], 201);
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = PopulationPeriod::find($id);

        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Periode data kependudukan tidak ditemukan!'
            ], 404);  
        }

        $data->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Periode data kependudukan berhasil dihapus'
        ], 200);  
    }
}
