<?php

namespace App\Http\Controllers\Disperindag;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DisperindagRequest;
use App\Models\Variant;

class VariantController extends Controller
{
    public function index()
    {
        $data = Variant::all();

        if ($data->isEmpty()) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data Variant Kosong!',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Data Variant berhasil ditemukan!',
            'data_variant' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        //Validasi input
        $formRequest = new DisperindagRequest('variant'); 
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        
        //store database
        Variant::create(
            $request->all()
            // 'variants_name' => $request->variants_name,
        );

        return response()->json([
            'status_code' => 201,
            'message' => 'Data Variant Berhasil Ditambahkan'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mengambil kategori berdasarkan ID
        $data = Variant::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak Menemukan data Variant tersebut',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Data Variant Berhasil Ditemukan',
            'data_variant' => $data,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Variant::find($id);

        //Cek data sesuai ID
        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Data Variant tidak ditemukan!'
            ], 404);  
        }

        //Validasi input
        $formRequest = new DisperindagRequest('variant'); 
        $this->validate($request, $formRequest->rules(), $formRequest->messages());
        
        //Update data Variant ke database
        $data->update($request->all());

        return response()->json([
            'status_code' => 200,
            'message' => 'Data Variant berhasil diubah'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = Variant::find($id);
            $data->delete();

            return response()->json([
                'status_code' => 204,
                'message' => 'Data Variant berhasil dihapus!',
            ], 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data Variant tidak ditemukan!',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Data Variant gagal dihapus!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
