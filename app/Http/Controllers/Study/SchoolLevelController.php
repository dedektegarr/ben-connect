<?php

namespace App\Http\Controllers\Study;

use App\Http\Controllers\Controller;
use App\Http\Requests\study\SchoolLevelRequest;
use App\Models\SchoolLevelModel;
use Illuminate\Http\Request;

class SchoolLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_school_level=SchoolLevelModel::get();

        // check apakah data kosong
        if($data_school_level->isEmpty())
        {
            return response()->json([
                "status_code"=>404,
                "message"=>"Data Level Sekolah kosong",
            ],404);
        }

        // jika data tidak kosong
        return response()->json([
            "status_code"=>200,
            "message"=>"Data Level Sekolah berhasil diambil",
            "data_level_sekolah"=>$data_school_level
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SchoolLevelRequest $request)
    {
        $data_school_level=SchoolLevelModel::create($request->all());

        // berikan respon ketika berhasil ditambah
        return response()->json([
            "status_code"=>201,
            "message"=>"Data Level Sekolah berhasil ditambahkan",
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $school_level_id)
    {
        // cari data berdasarkan id
        $data_school_level=SchoolLevelModel::find($school_level_id);

        // berikan respon 404 ketika data tidak ditemukan
        if(!$data_school_level)
        {
            return response()->json([
                "status_code"=>404,
                "message"=>"Data Level Sekolah dengan id :{$school_level_id} tidak ditemukan",
            ],404);
        }

        // berikan response ketika ditemukan
        return response()->json([
            "status_code"=>200,
            "message"=>"Data Level Sekolah dengan id :{$school_level_id} berhasil ditemukan",
            "data_level_sekolah"=>$data_school_level
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SchoolLevelRequest $request, string $school_level_id)
    {
        // cari data berdasarkan id
        $data_school_level=SchoolLevelModel::find($school_level_id);

        // berikan respon 404 ketika data tidak ditemukan
        if(!$data_school_level)
        {
            return response()->json([
                "status_code"=>404,
                "message"=>"Data Level Sekolah dengan id :{$school_level_id} tidak ditemukan",
            ],404);
        }

        // update ke database
        $data_school_level->update($request->all());

        // berikan respon ketika berhasil diperbarui
        return response()->json([
            "status_code"=>201,
            "message"=>"Data Level Sekolah berhasil diperbarui",
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $school_level_id)
    {
        // cari data berdasarkan id
        $data_school_level=SchoolLevelModel::find($school_level_id);

        // berikan respon 404 ketika data tidak ditemukan
        if(!$data_school_level)
        {
            return response()->json([
                "status_code"=>404,
                "message"=>"Data Level Sekolah dengan id :{$school_level_id} tidak ditemukan",
            ],404);
        }

        // hapus ke database
        $data_school_level->delete();

        // berikan respon ketika berhasil dihapus
        return response()->json([
            "status_code"=>201,
            "message"=>"Data Level Sekolah dengan id :{$school_level_id} berhasil di hapus",
        ],201);
    }
}
