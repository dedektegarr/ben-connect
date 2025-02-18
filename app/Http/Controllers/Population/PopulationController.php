<?php

namespace App\Http\Controllers\Population;

use App\Http\Controllers\Controller;
use App\Http\Requests\PopulationRequest;
use App\Imports\PopulationImport;
use App\Models\Population;
use App\Models\PopulationAgeGroup;
use App\Models\PopulationPeriod;
use App\Models\Region;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PopulationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // mengambil query parameter sebagai filter
        $filters = $request->only(["year", "semester", "age_range", "region"]);
        $populations = Population::with(['populationPeriod', 'populationAgeGroup', 'region'])->filter($filters)->get();

        return response()->json([
            "status_code" => 200,
            "message" => "Data populasi",
            "data" => $populations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function import(Request $request)
    {
        //Validasi input
        $formRequest = new PopulationRequest('population_input');
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        try {
            $period = PopulationPeriod::find($request->population_period_id);

            if (!$period) {
                return response()->json([
                    'status_code' => 404,
                    'message' => 'Data periode ini tidak ditemukan'
                ], 404);
            }

            if ($period->populations()->exists()) {
                throw new Exception("Data populasi untuk periode {$period->population_period_year} semester {$period->population_period_semester} sudah diimpor sebelumnya");
            }

            Excel::import(new PopulationImport($request->population_period_id), $request->file('population_file'));

            return response()->json([
                'status_code' => 201,
                'message' => 'OK',
                'data' => $period
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Error',
                'errors' => $e->getMessage()
            ], 400);
        }
    }

    public function store(Request $request)
    {
        $formRequest = new PopulationRequest("population_store");
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        // Validasi jika foreign key tidak ditemukan
        $missingFields = [];

        $regionExists = Region::whereKey($request->region_id)->exists();
        $populationAgeGroupExists = PopulationAgeGroup::whereKey($request->population_age_group_id)->exists();
        $populationPeriodExists = PopulationPeriod::whereKey($request->population_period_id)->exists();

        if (!$regionExists) {
            $missingFields[] = "region";
        }
        if (!$populationAgeGroupExists) {
            $missingFields[] = "rentang usia";
        }
        if (!$populationPeriodExists) {
            $missingFields[] = "periode";
        }
        if (!empty($missingFields)) {
            return response()->json([
                "status_code" => 404,
                "message" => "Data " . implode(", ", $missingFields) . " tidak ditemukan",
            ], 404);
        }

        $data = Population::create($request->all());

        return response()->json([
            "status_code" => 200,
            "message" => "Data populasi berhasil ditambahkan",
            "data" => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Population::with(['populationPeriod', 'populationAgeGroup', 'region'])->find($id);

        if (!$data->exists()) {
            return response()->json([
                "status_code" => 404,
                "message" => "Data tidak ditemukan"
            ], 404);
        }

        return response()->json([
            "status_code" => 200,
            "message" => "Data populasi ditemukan",
            "data" => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Population::find($id);

        if (empty($data)) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data kependudukan tidak ditemukan!'
            ], 404);
        }

        // Validasi jika foreign key tidak ditemukan
        $missingFields = [];

        $regionExists = Region::whereKey($request->region_id)->exists();
        $populationAgeGroupExists = PopulationAgeGroup::whereKey($request->population_age_group_id)->exists();
        $populationPeriodExists = PopulationPeriod::whereKey($request->population_period_id)->exists();

        if (!$regionExists) {
            $missingFields[] = "region";
        }
        if (!$populationAgeGroupExists) {
            $missingFields[] = "rentang usia";
        }
        if (!$populationPeriodExists) {
            $missingFields[] = "periode";
        }
        if (!empty($missingFields)) {
            return response()->json([
                "status_code" => 404,
                "message" => "Data " . implode(", ", $missingFields) . " tidak ditemukan",
            ], 404);
        }

        $data->update($request->all());
        return response()->json([
            'status_code' => 201,
            'message' => 'Data kependudukan berhasil diubah'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $data = Population::find($id);

        //Cek data sesuai ID
        if (empty($data)) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data kependudukan tidak ditemukan!'
            ], 404);
        }

        //Delete data di database
        $data->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Data kependudukan berhasil dihapus'
        ], 200);
    }
}
