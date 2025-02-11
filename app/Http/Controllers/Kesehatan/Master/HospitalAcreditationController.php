<?php

namespace App\Http\Controllers\Kesehatan\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\OPDKesehatanRequest;
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
        $formRequest = new OPDKesehatanRequest("hospital_acreditation_input");
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        $data = HospitalAcreditationModel::create($request->all());

        return response()->json([
            "status_code" => 201,
            "message" => "Data akreditasi rumah sakit berhasil ditambahkan",
            "data" => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = HospitalAcreditationModel::find($id);

        if (empty($data)) {
            return response()->json([
                "status_code" => "404",
                "message" => "Data akreditasi rumah sakit tidak ditemukan",
                "data" => null
            ], 404);
        }

        return response()->json([
            "status_code" => 200,
            "message" => "Data akreditasi rumah sakit berhasil ditemukan",
            "data" => $data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = HospitalAcreditationModel::find($id);

        if (empty($data)) {
            return response()->json([
                "status_code" => "404",
                "message" => "Data akreditasi rumah sakit tidak ditemukan",
                "data" => null
            ], 404);
        }

        $formRequest = new OPDKesehatanRequest("hospital_acreditation_input");
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        $data->update($request->all());

        return response()->json([
            "status_code" => 201,
            "message" => "Data akreditasi rumah sakit berhasil diubah",
            "data" => $data
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = HospitalAcreditationModel::find($id);

        if (empty($data)) {
            return response()->json([
                "status_code" => "404",
                "message" => "Data akreditasi rumah sakit tidak ditemukan",
                "data" => null
            ], 404);
        }

        $data->delete();

        return response()->json([
            "status_code" => "200",
            "message" => "Data akreditasi rumah sakit berhasil dihapus",
        ], 200);
    }
}
