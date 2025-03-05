<?php

namespace App\Http\Controllers\Infrastructure;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoadRequest;
use App\Imports\JalanImport;
use App\Models\Dataset;
use App\Models\Road;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class RoadController extends Controller
{

    public function index()
    {
        $data = Road::get();
        return response()->json([
            'status_code' => 200,
            'message' => 'Data Jalan',
            'data' => $data
        ], 200);
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
            Excel::import(new JalanImport, $request->file("file"));

            return response()->json([
                'status_code' => 201,
                'message' => 'Data jalan berhasil diimpor'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(RoadRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'massage' => 'Data tidak valid',
                'errors' => $request->validator->errors()
            ], 400);
        }

        Road::create($request->all());
        return response()->json([
            'status_code' => 201,
            'message' => 'Data jalan berhasil ditambahkan'
        ], 201);
    }

    public function show(string $id)
    {
        $data = Road::find($id);

        if (empty($data)) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data jalan tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Data kategori jalan berhasil ditemukan',
            'data_kategori_road' => $data
        ], 200);
    }

    public function update(RoadRequest $request, string $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'massage' => 'Data tidak valid',
                'errors' => $request->validator->errors()
            ], 400);
        }

        $data = Road::find($id);

        if (empty($data)) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data jalan tidak ditemukan!'
            ], 404);
        }

        $data->update($request->all());
        return response()->json([
            'status_code' => 200,
            'message' => 'Data jalan berhasil diubah'
        ], 200);
    }

    public function destroy(string $id)
    {
        $data = Road::find($id);

        if (empty($data)) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data jalan tidak ditemukan!'
            ], 404);
        }

        $data->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Data jalan berhasil dihapus'
        ], 200);
    }


    public function filterRoad(Request $request)
    {
        $data = Road::with(['dataset', 'area', 'roadCategory']);

        $validator = validator::make($request->all(), [
            'dataset_id' => 'nullable',
            'area_id' => 'nullable',
            'road_category_id' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => '400',
                'message' => 'Data tidak valid',
                'errors' => $validator->errors()
            ], 400);
        }

        $dataset = $request->dataset_id;
        $area = $request->area_id;
        $roadCategory = $request->road_category_id;

        if (!is_null($dataset)) {
            $data = $data->where('dataset_id', $dataset);
        }

        if (!is_null($area)) {
            $data = $data->where('area_id', $area);
        }

        if (!is_null($roadCategory)) {
            $data = $data->where('road_category_id', $roadCategory);
        }

        $data = $data->orderBy('area_id')->get();

        $result = [];
        foreach ($data->groupBy('dataset') as $dataset) {
            foreach ($dataset->groupBy('area') as $area) {
                $areas = $area->first()->area->area_name;
                $datasets = $area->first()->dataset->dataset_year;
                $roads = [];
                foreach ($area as $road) {
                    $roads[] = [
                        'kategori_jalan' => $road->roadCategory->road_category_name,
                        'panjang' => $road->road_long,
                    ];
                }

                $result[] = [
                    'daerah' => $areas,
                    'tahun' => $datasets,
                    'jalan' => $roads,
                    'total_panjang' => $area->sum('road_long'),
                ];
            }
        }

        return response()->json([
            'status_code' => 200,
            'message' => "Data road ditemukan",
            'data_jalan' => $result
        ], 200);
    }
}
