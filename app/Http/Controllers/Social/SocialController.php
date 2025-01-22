<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialRequest;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function index()
    {
        $social = Social::with(['dataset','area','socialcategory'])->get();

        // format data
        $formatData=$social->map(function ($social){
            return[
                'social_id' => $social->social_id,
                'created_at' => $social->created_at,
                'updated_at' => $social->updated_at,
                'area_name' => $social->area->area_name ?? null,
                'dataset_year' => $social->dataset->dataset_year ?? null,
                'social_category' => $social->socialcategory->social_category_name ?? null,
                'date_notice' => $social->date_notice,
                'nothing' => $social->nothing,
                'have' => $social->have,
                'count' => $social->count,
            ];
        });

        if ($formatData->isEmpty()) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data Sosial tidak ditemukan!',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Data Sosial berhasil ditemukan!',
            'data_sosial' => $formatData,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialRequest  $request)
    {

        $social = Social::create($request->all());

        return response()->json([
            'status_code' => 201,
            'message' => 'Data sosial berhasil disimpan!',
            'data_sosial' => $social,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $social = Social::find($id);

        if (!$social) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data sosial tidak ditemukan!',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Data sosial berhasil ditemukan!',
            'data_sosial' => $social,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SocialRequest  $request, $id)
    {
        $social = Social::findOrFail($id);
        $social->update($request->all());

        return response()->json([
            'status_code' => 200,
            'message' => 'Data sosial berhasil diubah!',
            'data_sosial' => $social,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $social = Social::findOrFail($id);
            $social->delete();

            return response()->json([
                'status_code' => 204,
                'message' => 'Data sosial berhasil dihapus!',
            ], 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data sosial tidak ditemukan!',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Data sosial gagal dihapus!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function filter(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_dataset' => 'required|exists:dataset,dataset_id',
            'id_area' => 'required|exists:area,area_id',
            'id_social_category' => 'required|exists:social_category,social_category_id',
        ]);

        // Query data sesuai filter
        $socials = Social::with(['dataset', 'area', 'socialcategory'])
            ->where('dataset_id', $validated['id_dataset'])
            ->where('area_id', $validated['id_area'])
            ->where('social_category_id', $validated['id_social_category'])
            ->orderBy('date_notice', 'desc')
            ->get();

        if ($socials->isEmpty()) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data Sosial tidak ditemukan untuk filter yang diberikan!',
            ], 404);
        }

        // Format data sesuai output
        $formattedData = [];
        foreach ($socials as $social) {
            $formattedData[] = [
                'social_id' => $social->social_id,
                'created_at' => $social->created_at,
                'updated_at' => $social->updated_at,
                'area_name' => $social->area->area_name ?? null,
                'dataset_year' => $social->dataset->dataset_year ?? null,
                'social_category' => $social->socialcategory->social_category_name ?? null,
                'date_notice' => $social->date_notice,
                'nothing' => $social->nothing,
                'have' => $social->have,
                'count' => $social->count,
            ];
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Data Sosial berhasil ditemukan!',
            'data_sosial' => $formattedData,
        ], 200);
    }

    public function index_sosial()
    {
        $socials = Social::with(['dataset', 'area', 'socialcategory'])
            ->orderBy('date_notice', 'desc')
            ->get()
            ->groupBy('socialcategory.social_category_name');

        if ($socials->isEmpty()) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data Sosial tidak ditemukan!',
            ], 404);
        }

        // Membentuk struktur JSON yang diinginkan
        $formattedData = [];
        foreach ($socials as $categoryName => $socialItems) {
            foreach ($socialItems as $social) {
                $formattedData[$categoryName][] = [
                    'created_at' => $social->created_at,
                    'updated_at' => $social->updated_at,
                    'area_name' => $social->area->area_name ?? null,
                    'dataset_year' => $social->dataset->dataset_year ?? null,
                    'date_notice' => $social->date_notice,
                    'nothing' => $social->nothing,
                    'have' => $social->have,
                    'count' => $social->count,
                ];
            }
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Data Sosial berhasil ditemukan!',
            'data_sosial' => $formattedData,
        ], 200);
    }

    public function index_akta()
    {
        // Query data sesuai filter
        $socials = Social::with(['dataset', 'area', 'socialcategory'])
        ->whereHas('socialcategory', function ($query) {
            $query->where('social_category_name', 'Akta');
        })
        ->orderBy('date_notice', 'desc')
        ->get();

        // format data
        $formatData=$socials->map(function ($social){
            return[
                'social_id' => $social->social_id,
                'created_at' => $social->created_at,
                'updated_at' => $social->updated_at,
                'area_name' => $social->area->area_name ?? null,
                'dataset_year' => $social->dataset->dataset_year ?? null,
                'social_category' => $social->socialcategory->social_category_name ?? null,
                'date_notice' => $social->date_notice,
                'nothing' => $social->nothing,
                'have' => $social->have,
                'count' => $social->count,
            ];
        });

        if ($formatData->isEmpty()) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data Sosial tidak ditemukan!',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Data Sosial berhasil ditemukan!',
            'data_sosial' => $formatData,
        ], 200);
    }

    public function index_akta_filter(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_dataset' => 'required|exists:dataset,dataset_id',
            'id_area' => 'required|exists:area,area_id',
        ]);

        // Query data sesuai filter
        $socials = Social::with(['dataset', 'area', 'socialcategory'])
            ->whereHas('socialcategory', function ($query) {
                $query->where('social_category_name', 'Akta'); // Filter hanya "Akta"
            })
            ->where('dataset_id', $validated['id_dataset'])
            ->where('area_id', $validated['id_area'])
            ->orderBy('date_notice', 'desc')
            ->get();

        // Jika data kosong
        if ($socials->isEmpty()) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data Sosial dengan kategori "Akta" tidak ditemukan untuk filter yang diberikan!',
            ], 404);
        }

        // Format data sesuai output
        $formattedData = [];
        foreach ($socials as $social) {
            $formattedData[] = [
                'social_id' => $social->social_id,
                'created_at' => $social->created_at,
                'updated_at' => $social->updated_at,
                'area_name' => $social->area->area_name ?? null,
                'dataset_year' => $social->dataset->dataset_year ?? null,
                'social_category' => $social->socialcategory->social_category_name ?? null,
                'date_notice' => $social->date_notice,
                'nothing' => $social->nothing,
                'have' => $social->have,
                'count' => $social->count,
            ];
        }

        // Return hasil
        return response()->json([
            'status_code' => 200,
            'message' => 'Data Sosial berhasil ditemukan!',
            'data_sosial' => $formattedData,
        ], 200);
    }
}
