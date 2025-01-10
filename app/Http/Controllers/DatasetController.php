<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DatasetRequest;
use App\Models\DatasetModel;
use Illuminate\Http\Request;

class DatasetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            "data_dataset"=>DatasetModel::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DatasetRequest $request)
    {
        $dataset = DatasetModel::create([
            'dataset_tahun' => $request->dataset_tahun,
        ]);

        return response()->json([
            'message' => 'Data dataset berhasil disimpan.',
            'data_dataset' => $dataset,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $dataset_id)
    {
        $dataset = DatasetModel::find($dataset_id);

        // Jika data tidak ditemukan, kembalikan error 404
        if (!$dataset) {
            return response()->json([
                'message' => 'Data dataset tidak ditemukan.',
            ], 404);
        }

        // Mengembalikan data dataset dalam bentuk JSON
        return response()->json([
            'data_dataset' => $dataset,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DatasetRequest $request, string $dataset_id)
    {
        $dataset = DatasetModel::findOrFail($dataset_id);

        $dataset->update([
            'dataset_tahun' => $request->dataset_tahun,
        ]);

        return response()->json([
            'message' => 'Data dataset berhasil diupdate.',
            'data_dataset' => $dataset,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $dataset_id)
    {
        $dataset = DatasetModel::findOrFail($dataset_id);
        $dataset->delete();

        return response()->json([
            'message' => 'Data dataset berhasil dihapus.',
        ]);
    }
}
