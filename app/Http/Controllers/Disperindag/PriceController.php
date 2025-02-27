<?php

namespace App\Http\Controllers\Disperindag;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DisperindagRequest;
use App\Models\Price;

class PriceController extends Controller
{
    public function index()
    {
        $data = Price::with(['region', 'variant'])->get();

        // Mapping data ke format yang diinginkan
        $formattedData = $data->map(function ($item) {
            return [
                'prices_id' => $item->prices_id,
                'prices_value' => $item->prices_value,
                'date' => $item->date,
                'region_name' => $item->region ? $item->region->region_name : null,
                'variant_name' => $item->variant ? $item->variant->variants_name : null,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return response()->json([
            'status_code' => 200,
            'message' => 'Data komoditas',
            'data_price' => $formattedData,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validasi input
        $formRequest = new DisperindagRequest('price');
        $this->validate($request, $formRequest->rules(), $formRequest->messages());


        //store database
        Price::create($request->all());

        return response()->json([
            'status_code' => 201,

            'message' => 'Data price Berhasil Ditambahkan'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mengambil kategori berdasarkan ID
        $data = Price::with(['region', 'variant'])->find($id);

        // Mapping data ke format yang diinginkan
        $formattedData = [
            'prices_id' => $data->prices_id,
            'prices_value' => $data->prices_value,
            'date' => $data->date,
            'region_name' => $data->region->region_name,
            'variant_name' => $data->variant->variants_name,
            'created_at' => $data->created_at,
            'updated_at' => $data->updated_at,
        ];

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak Menemukan data Price tersebut',
            ], 404);
        }


        return response()->json([
            'status_code' => 200,
            'message' => 'Data Price Berhasil Ditemukan',
            'data_price' => $formattedData,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Price::find($id);

        //Cek data sesuai ID
        if (empty($data)) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data price tidak ditemukan!'
            ], 404);
        }

        //Validasi input
        $formRequest = new DisperindagRequest('price');
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        //Update data price ke database
        $data->update($request->all());

        return response()->json([
            'status_code' => 200,
            'message' => 'Data price berhasil diubah'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = Price::find($id);
            $data->delete();

            return response()->json([
                'status_code' => 204,
                'message' => 'Data price berhasil dihapus!',
            ], 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data price tidak ditemukan!',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Data price gagal dihapus!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
