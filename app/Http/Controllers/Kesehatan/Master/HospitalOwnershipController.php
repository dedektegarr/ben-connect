<?php

namespace App\Http\Controllers\Kesehatan\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\OPDKesehatanRequest;
use App\Models\Kesehatan\DataRS\HospitalOwnershipModel;
use Illuminate\Http\Request;

class HospitalOwnershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = HospitalOwnershipModel::all();

        return response()->json([
            "status_code" => 200,
            "message" => "Data kepemilikan rumah sakit",
            "data" => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formRequest = new OPDKesehatanRequest("hospital_ownership_input");
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        $data = HospitalOwnershipModel::create($request->all());

        return response()->json([
            "status_code" => 201,
            "message" => "Data kepemilikan rumah sakit berhasil ditambahkan",
            "data" => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = HospitalOwnershipModel::find($id);

        if (empty($data)) {
            return response()->json([
                "status_code" => 404,
                "message" => "Data kepemilikan rumah sakit tidak ditemukan",
                "data" => null
            ], 404);
        }

        return response()->json([
            "status_code" => 200,
            "message" => "Data kepemilikan rumah sakit berhasil ditemukan",
            "data" => $data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = HospitalOwnershipModel::find($id);

        if (empty($data)) {
            return response()->json([
                "status_code" => 404,
                "message" => "Data kepemilikan rumah sakit tidak ditemukan",
                "data" => null
            ], 404);
        }

        $formRequest = new OPDKesehatanRequest("hospital_ownership_input");
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        $data->update($request->all());

        return response()->json([
            "status_code" => 201,
            "message" => "Data kepemilikan rumah sakit berhasil diubah",
            "data" => $data
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = HospitalOwnershipModel::find($id);

        if (empty($data)) {
            return response()->json([
                "status_code" => 404,
                "message" => "Data kepemilikan rumah sakit tidak ditemukan",
                "data" => null
            ], 404);
        }

        $data->delete();

        return response()->json([
            "status_code" => 200,
            "message" => "Data kepemilikan rumah sakit berhasil dihapus",
        ], 200);
    }
}
