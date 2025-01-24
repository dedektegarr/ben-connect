<?php

namespace App\Http\Controllers\Komoditi;

use App\Http\Controllers\Controller;
use App\Models\Komoditi;
use App\Http\Requests\KomoditiRequest;

class KomoditiController extends Controller
{
    public function index()
    {
        $komoditi = Komoditi::with(['pasar'])->get();

        // format data
        $formatData=$komoditi->map(function ($komoditi){
            return[
                'komoditi_id'=>$komoditi->komoditi_id,
                'komoditi_name'=>$komoditi->komoditi_name,
                'color'=>$komoditi->color,
                'pasar_name'=>$komoditi->pasar->pasar_name,
            ];
        });

        // Jika kosong
        if($komoditi->isEmpty())
        {
            return response()->json([
                'status_code'=>404,
                'message'=>'Data Komoditas kosong',
            ],404);
        }
        
        // kembalikan respon
        return response()->json([
            'status_code'=>200,
            'message' => 'Berhasil mengambil seluruh data Komoditas',
            'data_komoditi' => $formatData
        ], 200);
    }

    // CREATE
    public function store(KomoditiRequest $request)
    {
        $komoditi = Komoditi::create($request->all());

        if (!$komoditi) {
            return response()->json([
                'status_code' => 404,
                'message' => '"Data Komoditas kosong"',
            ], 404);
        }

        return response()->json([
            'status_code' => 201,
            'message' => 'Data Komoditas berhasil disimpan.'
        ], 201);
    }

    public function show($id)
    {
        $komoditi = Komoditi::find($id);

        if (!$komoditi) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data Komoditas tidak ditemukan!',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Data Komoditas berhasil ditemukan.',
            'data' => $komoditi,
        ], 200);
    }

    // UPDATE
    public function update(KomoditiRequest $request, $id)
    {
        $komoditi = Komoditi::find($id);

        if (!$komoditi) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data Komoditas tidak ditemukan!',
            ], 404);
        }

        $komoditi->update($request->all());

        return response()->json([
            'status_code' => 200,
            'message' => 'Data Komoditas berhasil diperbarui.'
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $komoditi = Komoditi::findOrFail($id);
            $komoditi->delete();

            return response()->json([
                'status_code' => 204,
                'message' => 'Data Komoditas berhasil dihapus!',
            ], 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data Komoditas tidak ditemukan!',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Data Komoditas gagal dihapus!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
