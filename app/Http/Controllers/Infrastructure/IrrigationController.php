<?php

namespace App\Http\Controllers\Infrastructure;

use App\Http\Controllers\Controller;
use App\Imports\IrrigationImport;
use App\Models\Irrigation;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class IrrigationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(["region"]);

        $data = Irrigation::with(["region"])->filter($filters)->get();

        return response()->json([
            'status' => 200,
            "data" => $data
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx|max:5000',
        ], [
            'file.required' => 'File tidak boleh kosong',
            'file.file' => 'File harus berupa file',
            'file.mimes' => 'File harus berupa file excel',
            'file.max' => 'File maksimal 5 MB'
        ]);

        try {
            Excel::import(new IrrigationImport, $request->file("file"));

            return response()->json([
                'status_code' => 201,
                'message' => 'Data irigasi berhasil diimpor'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
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
