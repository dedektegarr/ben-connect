<?php

namespace App\Http\Controllers\Komoditi;

use App\Http\Controllers\Controller;
use App\Models\Pasar;
use App\Http\Requests\PasarRequest;

class PasarController extends Controller
{
    public function index()
    {
        $pasar = Pasar::with(['area'])->get();

        // format data
        $formatData=$pasar->map(function ($pasar){
            return[
                'pasar_id'=>$pasar->pasar_id,
                'pasar_name'=>$pasar->pasar_name,
                'latitude'=>$pasar->latitude,
                'longitude'=>$pasar->longitude,
                'area'=>$pasar->area->area_name,
            ];
        });

        // Jika kosong
        if($pasar->isEmpty())
        {
            return response()->json([
                'status_code'=>404,
                'message'=>'Data Pasar kosong',
            ],404);
        }
        
        // kembalikan respon
        return response()->json([
            'status_code'=>200,
            'message' => 'Berhasil mengambil seluruh data pasar',
            'data_pasar' => $formatData
        ], 200);
    }

    // CREATE
    public function store(PasarRequest $request)
    {
        $pasar = Pasar::create($request->all());

        if (!$pasar) {
            return response()->json([
                'status_code' => 404,
                'message' => '"Data Pasar kosong"',
            ], 404);
        }

        return response()->json([
            'status_code' => 201,
            'message' => 'Data pasar berhasil disimpan.'
        ], 201);
    }

    public function show($id)
    {
        $pasar = Pasar::find($id);

        if (!$pasar) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data pasar tidak ditemukan!',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Data pasar berhasil ditemukan.',
            'data' => $pasar,
        ], 200);
    }

    // UPDATE
    public function update(PasarRequest $request, $id)
    {
        $pasar = Pasar::find($id);

        if (!$pasar) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data pasar tidak ditemukan!',
            ], 404);
        }

        $pasar->update($request->all());

        return response()->json([
            'status_code' => 200,
            'message' => 'Data pasar berhasil diperbarui.'
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $pasar = Pasar::findOrFail($id);
            $pasar->delete();

            return response()->json([
                'status_code' => 204,
                'message' => 'Data Pasar berhasil dihapus!',
            ], 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data Pasar tidak ditemukan!',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Data Pasar gagal dihapus!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
