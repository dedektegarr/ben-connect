<?php

namespace App\Http\Controllers\Study;

use App\Http\Controllers\Controller;
use App\Http\Requests\study\SchoolFilter;
use App\Models\SchoolFilterModel;
use Illuminate\Http\Request;

class SchoolFilterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_school_filter=SchoolFilterModel::with('school','dataset')->get();

        $format_data=$data_school_filter->map(function($data_school_filter){
            return[
                "school_filter_id"=>$data_school_filter->school_filter_id,
                "school_npsn"=>$data_school_filter->school->school_npsn,
                "school_name"=>$data_school_filter->school->school_name,
                "year"=>$data_school_filter->dataset->dataset_year,
                "total_teacher"=>$data_school_filter->school_filter_total_teacher,
                "total_student"=>$data_school_filter->school_filter_total_student,
            ];
        });

        if($data_school_filter->isEmpty())
        {
            return response()->json([
                "status_code"=>404,
                "message"=>"Rekap Data sekolah tidak ditemukan"
            ],404);
        }

        // jika berhasil ditemukan
        return response()->json([
            "status_code"=>200,
            "message"=>"Rekap Data sekolah berhasil ditemukan",
            "data_school_filter"=>$format_data
        ],200);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(SchoolFilter $request)
    {
        $data_school_filter=SchoolFilterModel::create($request->all());
        
        return response()->json([
            "status_code"=>201,
            "message"=>"Rekap Data sekolah berhasil ditambahkan!"
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $school_filter_id)
    {
        $data_school_filter=SchoolFilterModel::with('school','dataset')->find($school_filter_id);

        if(!$data_school_filter)
        {
            return response()->json([
                "status_code"=>404,
                "message"=>"Rekap Data sekolah dengan id: {$school_filter_id} tidak ditemukan"
            ],404);
        }

        // jika berhasil ditemukan
        return response()->json([
            "status_code"=>200,
            "message"=>"Rekap Data sekolah dengan id: {$school_filter_id} berhasil ditemukan",
            "data_school_filter"=>$data_school_filter
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SchoolFilter $request, string $school_filter_id)
    {
        $data_school_filter=SchoolFilterModel::find($school_filter_id);

        if(!$data_school_filter){
            return response()->json([
                "status_code"=>404,
                "message"=>"Rekap data sekolah dengan id {$school_filter_id} tidak ditemukan"
            ],404);
        }

        $data_school_filter->update($request->all());

        return response()->json([
            "status_code"=>404,
            "message"=>"Rekap data sekolah dengan id {$school_filter_id} berhasil diperbarui"
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $school_filter_id)
    {
        $data_school_filter=SchoolFilterModel::find($school_filter_id);

        if(!$data_school_filter){
            return response()->json([
                "status_code"=>404,
                "message"=>"Rekap data sekolah dengan id {$school_filter_id} tidak ditemukan"
            ],404);
        }

        $data_school_filter->delete();

        return response()->json([
            "status_code"=>200,
            "message"=>"Rekap data sekolah dengan id {$school_filter_id} berhasil dihapus"
        ],200);
    }

    public function filter()
    {
        $statistics = (new SchoolFilterModel())->getLatestYearStatistics();
        return response()->json($statistics);
    }
}
