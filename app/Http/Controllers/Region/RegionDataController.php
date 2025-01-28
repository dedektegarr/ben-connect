<?php

namespace App\Http\Controllers\Region;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegionRequest;
use App\Models\Region;
use App\Models\RegionData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RegionDataController extends Controller
{
    public function index(Request $request)
    {
        $data = Region::with('regionData');
        
        //Filter sesuai ID (Kosongkan jika ingin menampilkan semua)
        if(isset($request->region_id)){
            $data->where('region_id', $request->region_id);
        }

        //Filter sesuai rentang tahun (Samakan year_start dan year_end jika ingin menampilkan 1 tahun)
        if(isset($request->year_start) && isset($request->year_end)){
            $year_start = $request->year_start;
            $year_end = $request->year_end;
            $data->with('regionData', function($query) use ($year_start, $year_end){
                $query->whereBetween('region_data_year', [$year_start, $year_end]);
            });
        }

        $data = $data->get()->map(function($data){
            return [
                'wilayah' => $data->region_name,
                'data_wilayah' => $data->regionData->map(function($regionData){
                    return [
                        'tahun' => $regionData->region_data_year,
                        'luas' => $regionData->region_data_area,
                        'polygon' => $regionData->region_data_polygon
                    ];
                })
            ];
        });
        return response()->json([
            'status_code' => 200,
            'message' => "Data wilayah",
            'data_wilayah' => $data
        ], 200);
    }
    
    //Menambahkan data wilayah
    public function store(Request $request)
    {
        //Validasi input
        $formRequest = new RegionRequest('region_data_input'); 
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        //Cek jika data tahun data wilayah sudah ada
        $checkDataYear = RegionData::where(['region_id' => $request->region_id, 'region_data_year' => $request->region_data_year]);
        if($checkDataYear->count() != 0){
            return response()->json([
                'status_code' => 400,
                'message' => 'Data wilayah tahun '.$request->region_data_year.' sudah ada'
            ], 400);
        }

        //Proses upload file dan rename file menjadi nama_wilayah-tahun
        $region = Region::find($request->region_id);
        $nameFile = Str::replaceMatches('/[^A-Za-z0-9]++/', '_', $region->region_name).'-'.$request->region_data_year;//U
        $nameFile = Str::lower($nameFile);
        $uploadFile = Storage::putFileAs('region_json', $request->file('region_data_polygon'), $nameFile);

        //Ubah field region_data_polygon menjadi path file
        $allRequest = $request->all();
        $allRequest['region_data_polygon'] = $uploadFile.'.json';

        //Store ke database
        RegionData::create($allRequest);
        return response()->json([
            'status_code' => 201,
            'message' => 'Data wilayah berhasil ditambahkan'
        ], 201);
    }

    //Mendapatkan data wilayah berdasarkan ID data wilayah
    public function show(string $id)
    {
        $data = RegionData::find($id);

        //Cek data sesuai ID
        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Data wilayah tidak ditemukan!'
            ], 404);  
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Data wilayah berhasil ditemukan',
            'data_wilayah' => $data
        ], 200);
    }

    //Mengubah data wilayah (Method POST)
    public function update(Request $request)
    {
        $data = RegionData::find($request->region_data_id);

        //Cek data sesuai ID
        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Data wilayah tidak ditemukan!'
            ], 404);  
        }

        //Validasi input
        $formRequest = new RegionRequest('region_data_update'); 
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        //Cek jika data tahun data wilayah sudah ada
        $region = Region::find($data->region_id);
        $checkDataYear = RegionData::where(['region_id' => $region->region_id, 'region_data_year' => $request->region_data_year]);
        if($checkDataYear->count() != 0 && $data->region_data_year != $request->region_data_year){
            return response()->json([
                'status_code' => 400,
                'message' => 'Data wilayah tahun '.$request->region_data_year.' sudah ada'
            ], 400);
        }

        //Proses upload file jika file diubah dan rename file menjadi nama_wilayah-tahun
        $allRequest = $request->all();
        if(!is_null($request->region_data_polygon)){
            $nameFile = Str::replaceMatches('/[^A-Za-z0-9]++/', '_', $region->region_name).'-'.$request->region_data_year;//U
            $nameFile = Str::lower($nameFile);
            $uploadFile = Storage::putFileAs('region_json', $request->file('region_data_polygon'), $nameFile);

            //Ubah field region_data_polygon menjadi path file
            $allRequest['region_data_polygon'] = $uploadFile.'.json';
        }

        //Update data di database
        $data->update($allRequest);
        return response()->json([
            'status_code' => 200,
            'message' => 'Data wilayah berhasil diubah'
        ], 200);    
    }

    //Menghapus data wilayah (Hard Delete)
    public function destroy(string $id)
    {
        $data = RegionData::find($id);

        //Cek data sesuai ID
        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Data wilayah tidak ditemukan!'
            ], 404);  
        }

        //Hapus data dari database (Hard Delete)
        $data->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Data wilayah berhasil dihapus'
        ], 200);
    }
}
