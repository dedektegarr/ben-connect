<?php

namespace App\Http\Controllers\Ketenagakerjaan;

use App\Http\Controllers\Controller;
use App\Imports\KetenagakerjaanImport;
use App\Models\PencariKerjaTerdaftar;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PencariKerjaTerdaftarController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx|max:5000',
            'year' => 'required|integer'
        ], [
            'file.required' => 'File tidak boleh kosong',
            'file.file' => 'File harus berupa file',
            'file.mimes' => 'File harus berupa file excel',
            'file.max' => 'File maksimal 5 MB',
            'year.required' => 'Tahun tidak boleh kosong',
            'year.integer' => 'Tahun harus berupa angka'
        ]);

        try {
            Excel::import(new KetenagakerjaanImport($request->year), $request->file("file"));

            return response()->json([
                'status_code' => 201,
                'message' => 'Data ketenagakerjaan berhasil diimpor'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index(Request $request)
    {
        $filters = $request->only(["year"]);

        $data = PencariKerjaTerdaftar::with(["region"])->filter($filters)->latest()->get();

        return response()->json([
            "status" => 200,
            "data" => $data
        ]);
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
