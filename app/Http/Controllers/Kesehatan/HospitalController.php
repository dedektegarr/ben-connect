<?php

namespace App\Http\Controllers\Kesehatan;

use App\Http\Controllers\Controller;
use App\Http\Requests\OPDKesehatanRequest;
use App\Imports\HospitalImport;
use App\Models\Kesehatan\DataRS\HospitalDataModel;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(["region", "category", "ownership", "acreditation"]);
        $data = HospitalDataModel::with(["region", "category_hospital", "hospital_acreditation", "hospital_ownership"])->filter($filters)->get();

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
        $data = HospitalDataModel::find($id);

        if (empty($data)) {
            return response()->json([
                'status_code' => 404,
                'message' => "Rumah Sakit dengan id {$id} tidak ditemukan!"
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => "Rumah Sakit dengan id {$id} berhasil ditemukan",
            'data_kategori_rs' => $data
        ], 200);
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

    public function import(Request $request)
    {
        $formRequest = new OPDKesehatanRequest("hospital_import");
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        try {
            Excel::import(new HospitalImport, $request->file("hospital_file"));

            return response()->json([
                'status_code' => 201,
                'message' => 'File berhasil di import'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status_code" => 400,
                "message" => $e->getMessage()
            ], 400);
        }
    }
}
