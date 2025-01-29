<?php

namespace App\Http\Controllers\Population;

use App\Http\Controllers\Controller;
use App\Http\Requests\PopulationRequest;
use App\Models\PopulationPeriod;
use Illuminate\Http\Request;

class PopulationPeriodController extends Controller
{
    //Mendapatkan seluruh periode data kependudukan
    public function index()
    {
        $data = PopulationPeriod::get();
        
        return response()->json([
            'status_code' => 200,
            'message' => "Periode data kependudukan",
            'data_periode_kependudukan' => $data
        ], 200);
    }

    //Menambahkan periode data kependudukan
    public function store(Request $request)
    {
        //Validasi input
        $formRequest = new PopulationRequest('population_period_input'); 
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        $semester = $request->population_period_semester;
        $year = $request->population_period_year;

        //Cek jika periode data kependudukan sudah ada
        $checkPeriodIfExists = PopulationPeriod::where([
            'population_period_semester' => $semester,
            'population_period_year' => $year
        ])->count();

        if($checkPeriodIfExists != 0){
            return response()->json([
                'status_code' => 400,
                'message' => 'Periode data kependudukan semester '.$semester.' Tahun '.$year.' sudah ada',
            ], 400);
        }

        //Store data ke database
        $store = PopulationPeriod::create($request->all());
        return response()->json([
            'status_code' => 201,
            'message' => 'Periode data kependudukan berhasil ditambahkan'
        ], 201);
    }

    //Mendapatkan periode data kependudukan sesuai ID
    public function show(string $id)
    {
        $data = PopulationPeriod::find($id);

        //Cek data sesuai ID
        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Periode data kependudukan tidak ditemukan!'
            ], 404);  
        }
        
        return response()->json([
            'status_code' => 200,
            'message' => 'Periode data kependudukan berhasil ditemukan',
            'periode_kependudukan' => $data
        ], 200);  
    }

    //Mengubah periode data kependudukan
    public function update(Request $request, string $id)
    {
        $data = PopulationPeriod::find($id);

        //Cek data sesuai ID
        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Periode data kependudukan tidak ditemukan!'
            ], 404);  
        }

        //Validasi input
        $formRequest = new PopulationRequest('population_period_input'); 
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        $semester = $request->population_period_semester;
        $year = $request->population_period_year;

        //Cek jika periode data kependudukan sudah ada
        $checkPeriodIfExists = PopulationPeriod::where([
            'population_period_semester' => $semester,
            'population_period_year' => $year
        ])->count();


        if($checkPeriodIfExists != 0){
            return response()->json([
                'status_code' => 400,
                'message' => 'Periode data kependudukan semester '.$semester.' Tahun '.$year.' sudah ada',
            ], 400);
        }

        //Update data di database
        $data->update($request->all());
        return response()->json([
            'status_code' => 201,
            'message' => 'Periode data kependudukan berhasil diubah'
        ], 201);
    }

    //Menghapus periode data kependudukan (Soft Delete)
    public function destroy(string $id)
    {
        $data = PopulationPeriod::find($id);

        //Cek data sesuai ID
        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Periode data kependudukan tidak ditemukan!'
            ], 404);  
        }

        //Delete data di database
        $data->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Periode data kependudukan berhasil dihapus'
        ], 200);  
    }
}
