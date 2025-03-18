<?php

namespace App\Http\Controllers\Ketenagakerjaan;

use App\Http\Controllers\Controller;
use App\Imports\UpahMinimumImport;
use App\Models\UpahMinimum;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UpahMinimumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $data = UpahMinimum::with(["region"])->oldest()->get()->groupBy("region.region_name");

        return response()->json([
            "status" => 200,
            "data" => [
                "years" => $data->flatMap(fn($arr) => $arr->map(fn($item) => $item->year))->unique(),
                "data" => $data
            ]

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
            'file.max' => 'File maksimal 5 MB',
        ]);

        try {
            Excel::import(new UpahMinimumImport, $request->file("file"));

            return response()->json([
                'status_code' => 201,
                'message' => 'Data upah minimum regional berhasil diimpor'
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
