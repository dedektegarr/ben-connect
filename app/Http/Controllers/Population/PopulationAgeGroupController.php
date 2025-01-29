<?php

namespace App\Http\Controllers\Population;

use App\Http\Controllers\Controller;
use App\Http\Requests\PopulationRequest;
use App\Models\PopulationAgeGroup;
use Illuminate\Http\Request;

class PopulationAgeGroupController extends Controller
{
    ///Mendapatkan seluruh kelompok umur
    public function index()
    {
        $data = PopulationAgeGroup::get();
        
        return response()->json([
            'status_code' => 200,
            'message' => "Kelompok umur",
            'data_kelompok_umur' => $data
        ], 200);
    }

    //Menambahkan kelompok umur
    public function store(Request $request)
    {
        //Validasi input
        $formRequest = new PopulationRequest('population_age_group_input'); 
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        //Store data ke database
        $store = PopulationAgeGroup::create($request->all());
        return response()->json([
            'status_code' => 201,
            'message' => 'Kelompok umur berhasil ditambahkan'
        ], 201);
    }

    //Mendapatkan kelompok umur sesuai ID
    public function show(string $id)
    {
        $data = PopulationAgeGroup::find($id);

        //Cek data sesuai ID
        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Kelompok umur tidak ditemukan!'
            ], 404);  
        }
        
        return response()->json([
            'status_code' => 200,
            'message' => 'Kelompok umur berhasil ditemukan',
            'kelompok_umur' => $data
        ], 200);  
    }

    //Mengubah kelompok umur
    public function update(Request $request, string $id)
    {
        $data = PopulationAgeGroup::find($id);

        //Cek data sesuai ID
        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Kelompok umur tidak ditemukan!'
            ], 404);  
        }

        //Validasi input
        $formRequest = new PopulationRequest('population_age_group_input'); 
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        //Update data di database
        $data->update($request->all());
        return response()->json([
            'status_code' => 201,
            'message' => 'Kelompok umur berhasil diubah'
        ], 201);
    }

    //Menghapus kelompok umur (Soft Delete)
    public function destroy(string $id)
    {
        $data = PopulationAgeGroup::find($id);

        //Cek data sesuai ID
        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Kelompok umur tidak ditemukan!'
            ], 404);  
        }

        //Delete data di database
        $data->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Kelompok umur berhasil dihapus'
        ], 200); 
    }
}
