<?php

namespace App\Http\Controllers\Kesehatan\Master;

use App\Http\Controllers\Controller;
use App\Models\Kesehatan\DataRS\HospitalAcreditationModel;
use Illuminate\Http\Request;

class HospitalAcreditationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_acreditations_hospital = HospitalAcreditationModel::get();

        if ($data_acreditations_hospital->isEmpty()) {
            return response()->json([
                "status_code" => 404,
                "message" => "Data akreditasi Rumah Sakit kosong",
            ], 404);
        }

        // jika data tidak kosong
        return response()->json([
            "status_code" => 200,
            "message" => "Data akreditasi Rumah Sakit berhasil diambil",
            "data_akreditasi_rs" => $data_acreditations_hospital
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
