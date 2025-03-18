<?php

namespace App\Http\Controllers\Study;

use App\Http\Controllers\Controller;
use App\Http\Requests\study\SchoolRequest;
use App\Imports\SchoolCountImport;
use App\Models\SchoolModel;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_school = SchoolModel::with('region', 'schoollevel')->get();

        // format data
        $formatData = $data_school->map(function ($data_school) {
            return [
                'school_id' => $data_school->school_id,
                'school_npsn' => $data_school->school_npsn,
                'school_name' => $data_school->school_name,
                'school_status' => $data_school->school_status,
                'school_level_name' => $data_school->schoollevel->school_level_name,
                'region_name' => $data_school->region->region_name,
                'negeri_count' => $data_school->negeri_count,
                'swasta_count' => $data_school->swasta_count,
                'school_adress' => $data_school->school_address,
                'latitude' => $data_school->latitude,
                'longitude' => $data_school->longitude,
                'created_at' => $data_school->created_at->format('Y-m-d'),
                'updated_at' => $data_school->updated_at->format('Y-m-d'),
            ];
        });

        // if ($data_school->isEmpty()) {
        // berikan respon ketika data kosong
        //     return response()->json([
        //         "status_code" => 404,
        //         "message" => "Data Sekolah kosong",
        //     ], 404);
        // }

        // berikan respon ketika berhasil ditemukan
        return response()->json([
            "status_code" => 200,
            "message" => "Data Sekolah berhasil diambil",
            "data" => $formatData
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SchoolRequest $request)
    {
        // tambahkan ke model
        $data_school = SchoolModel::create($request->all());

        // berikan respon ketika berhasil ditambah
        return response()->json([
            "status_code" => 201,
            "message" => "Data Sekolah berhasil ditambahkan",
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $school_id)
    {
        $data_school = SchoolModel::with('region', 'schoollevel')->find($school_id);

        // kembalikan response 404
        if (!$data_school) {
            return response()->json([
                "status_code" => 404,
                "message" => "Data Sekolah dengan id: {$school_id} tidak ditemukan!"
            ], 404);
        }

        // format data
        $formatData =
            [
                'school_id' => $data_school->school_id,
                'school_npsn' => $data_school->school_npsn,
                'school_name' => $data_school->school_name,
                'school_status' => $data_school->school_status,
                'school_level_name' => $data_school->schoollevel->school_level_name,
                'region_name' => $data_school->region->region_name,
                'school_adress' => $data_school->school_address,
                'latitude' => $data_school->latitude,
                'longitude' => $data_school->longitude,
                'created_at' => $data_school->created_at->format('Y-m-d'),
                'updated_at' => $data_school->updated_at->format('Y-m-d'),
            ];

        return response()->json([
            "status_code" => 200,
            "message" => "Data sekolah dengan id: {$school_id} berhasil ditemukan",
            "data_school" => $formatData
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $school_id)
    {
        $data_school = SchoolModel::with('region', 'schoollevel')->find($school_id);

        // kembalikan response 404
        if (!$data_school) {
            return response()->json([
                "status_code" => 404,
                "message" => "Data Sekolah dengan id: {$school_id} tidak ditemukan!"
            ], 404);
        }

        $data_school->update($request->all());

        // kembalikan jika berhasil

        return response()->json([
            "status_code" => 200,
            "mesaage" => "Data Sekolah dengan id: {$school_id} berhasil di update!"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $school_id)
    {
        $data_school = SchoolModel::find($school_id);

        // kembalikan response 404
        if (!$data_school) {
            return response()->json([
                "status_code" => 404,
                "message" => "Data Sekolah dengan id: {$school_id} tidak ditemukan!"
            ], 404);
        }

        $data_school->delete();

        // kembalikan respone ketika berhasil di delete
        return response()->json([
            "status_code" => 200,
            "mesaage" => "Data Sekolah dengan id: {$school_id} berhasil di hapus!"
        ], 200);
    }

    public function import(Request $request)
    {
        $formRequest = new SchoolRequest();
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        try {
            Excel::import(new SchoolCountImport($request->year), $request->file("school_file"));

            return response()->json([
                "status_code" => 201,
                "message" => "OK"
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status_code" => 400,
                "message" => $e->getMessage()
            ], 400);
        }
    }
}
