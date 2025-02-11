<?php

namespace App\Http\Controllers\Kesehatan;

use App\Http\Controllers\Controller;
use App\Models\Kesehatan\DataRS\HospitalDataModel;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = HospitalDataModel::with(["region", "category_hospital", "hospital_acreditation", "hospital_ownership"])->get();

        if ($data->isEmpty()) {
            return response()->json([
                "status_code" => 404,
                "message" => "Data Rumah Sakit kosong",
            ], 404);
        }

        return response()->json([
            "status_code" => 200,
            "message" => "Data Rumah Sakit berhasil diambil",
            "data" => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
