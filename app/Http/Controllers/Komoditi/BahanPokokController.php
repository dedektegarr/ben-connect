<?php

namespace App\Http\Controllers\Komoditi;

use App\Http\Controllers\Controller;
use App\Models\BahanPokok;
use App\Http\Requests\BahanPokokRequest;

class BahanPokokController extends Controller
{
    public function index()
    {
        $bahan_pokok = BahanPokok::with(['pasar','komoditi'])->get();

        // format data
        $formatData=$bahan_pokok->map(function ($bahan_pokok){
            return[
                'bahan_pokok_id'=>$bahan_pokok->bahan_pokok_id,
                'bahan_pokok_name'=>$bahan_pokok->bahan_pokok_name,
                'satuan'=>$bahan_pokok->satuan,
                'harga'=>$bahan_pokok->harga,
                'waktu'=>$bahan_pokok->waktu,
                'pasar_name'=>$bahan_pokok->pasar->pasar_name,
                'komoditi_name'=>$bahan_pokok->komoditi->komoditi_name
            ];
        });

        // Jika kosong
        if($bahan_pokok->isEmpty())
        {
            return response()->json([
                'status_code'=>404,
                'message'=>'Data Bahan Pokok kosong',
            ],404);
        }
        
        // kembalikan respon
        return response()->json([
            'status_code'=>200,
            'message' => 'Berhasil mengambil seluruh data Bahan Pokok',
            'data_bahan_pokok' => $formatData
        ], 200);
    }

    // CREATE
    public function store(BahanPokokRequest $request)
    {
        $bahan_pokok = BahanPokok::create($request->all());

        if (!$bahan_pokok) {
            return response()->json([
                'status_code' => 404,
                'message' => '"Data Bahan Pokok kosong"',
            ], 404);
        }

        return response()->json([
            'status_code' => 201,
            'message' => 'Data Bahan Pokok berhasil disimpan.'
        ], 201);
    }

    public function show($id)
    {
        $bahan_pokok = BahanPokok::find($id);

        if (!$bahan_pokok) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data Bahan Pokok tidak ditemukan!',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Data Bahan Pokok berhasil ditemukan.',
            'data' => $bahan_pokok,
        ], 200);
    }

    // UPDATE
    public function update(BahanPokokRequest $request, $id)
    {
        $bahan_pokok = BahanPokok::find($id);

        if (!$bahan_pokok) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data Bahan Pokok tidak ditemukan!',
            ], 404);
        }

        $bahan_pokok->update($request->all());

        return response()->json([
            'status_code' => 200,
            'message' => 'Data Bahan Pokok berhasil diperbarui.'
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $bahan_pokok = BahanPokok::findOrFail($id);
            $bahan_pokok->delete();

            return response()->json([
                'status_code' => 204,
                'message' => 'Data Bahan Pokok berhasil dihapus!',
            ], 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data Bahan Pokok tidak ditemukan!',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Data Bahan Pokok gagal dihapus!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
