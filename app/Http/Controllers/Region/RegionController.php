<?php

namespace App\Http\Controllers\Region;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegionRequest;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    //Mendapatkan seluruh wilayah
    public function index()
    {
        $data = Region::get();

        return response()->json([
            'status_code' => 200,
            'message' => "Data wilayah",
            'data' => $data
        ], 200);
    }

    //Menambahkan wilayah
    public function store(Request $request)
    {
        //Validasi input
        $formRequest = new RegionRequest('region_input');
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        //Store data ke database
        Region::create($request->all());
        return response()->json([
            'status_code' => 201,
            'message' => 'Wilayah berhasil ditambahkan'
        ], 201);
    }

    //Mendapatkan wilayah sesuai ID
    public function show(string $id)
    {
        $data = Region::find($id);

        //Cek data sesuai ID
        if (empty($data)) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Wilayah tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Wilayah berhasil ditemukan',
            'data_wilayah' => $data
        ], 200);
    }

    //Mengubah wilayah
    public function update(Request $request, string $id)
    {
        $data = Region::find($id);

        //Cek data sesuai ID
        if (empty($data)) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data wilayah tidak ditemukan!'
            ], 404);
        }

        //Validasi input
        $formRequest = new RegionRequest('region_input');
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        //Update data di database
        $data->update($request->all());
        return response()->json([
            'status_code' => 200,
            'message' => 'Wilayah berhasil diubah'
        ], 200);
    }

    //Menghapus wilayah (Soft Delete)
    public function destroy(string $id)
    {
        $data = Region::find($id);

        //Cek data sesuai ID
        if (empty($data)) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Wilayah tidak ditemukan!'
            ], 404);
        }

        //Hapus data dari database (Hard Delete)
        $data->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Wilayah berhasil dihapus'
        ], 200);
    }
}
