<?php

namespace App\Http\Controllers\Kesehatan\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\OPDKesehatanRequest;
use App\Models\Kesehatan\DataRS\CategoryHospitalModel;
use Illuminate\Http\Request;

class CategoryHospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_category_hospital=CategoryHospitalModel::get();

        if($data_category_hospital->isEmpty())
        {
            return response()->json([
                "status_code"=>404,
                "message"=>"Data Kategori Rumah Sakit kosong",
            ],404);
        }

        // jika data tidak kosong
        return response()->json([
            "status_code"=>200,
            "message"=>"Data Kategori Rumah Sakit berhasil diambil",
            "data_kategori_rs"=>$data_category_hospital
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validasi input
        $formRequest = new OPDKesehatanRequest('category_hospital_input');
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        //Store data ke database
        CategoryHospitalModel::create($request->all());
        return response()->json([
            'status_code' => 201,
            'message' => 'Kategori Rumah Sakit berhasil ditambahkan'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data_category_hospital = CategoryHospitalModel::find($id);

        //Cek data sesuai ID
        if(empty($data_category_hospital)){
            return response()->json([
                'status_code' => 404,
                'message' => "Kategori Rumah Sakit dengan id {$id} tidak ditemukan!"
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => "Kategori Rumah Sakit dengan id {$id} berhasil ditemukan",
            'data_kategori_rs' => $data_category_hospital
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data_category_hospital = CategoryHospitalModel::find($id);

        //Cek data sesuai ID
        if(empty($data_category_hospital)){
            return response()->json([
                'status_code' => 404,
                'message' => "Kategori Rumah Sakit dengan id: {$id} tidak ditemukan!"
            ], 404);
        }

        //Validasi input
        $formRequest = new OPDKesehatanRequest('category_hospital_input');
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        //Update data di database
        $data_category_hospital->update($request->all());
        return response()->json([
            'status_code' => 200,
            'message' => "Kategori Rumah Sakit dengan id: {$id} berhasil diperbarui!"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_category_hospital = CategoryHospitalModel::find($id);

        //Cek data sesuai ID
        if(empty($data_category_hospital)){
            return response()->json([
                'status_code' => 404,
                'message' => "Kategori Rumah Sakit dengan id: {$id} tidak ditemukan!"
            ], 404);
        }

        // delete data
        $data_category_hospital->delete();
        return response()->json([
            'status_code' => 200,
            'message' => "Kategori Rumah Sakit dengan id: {$id} berhasil diperbarui!"
        ], 200);
    }
}
