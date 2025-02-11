<?php

namespace App\Http\Controllers\Population;

use App\Http\Controllers\Controller;
use App\Http\Requests\PopulationRequest;
use App\Imports\PopulationImport;
use App\Models\Population;
use App\Models\PopulationPeriod;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PopulationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

            if ($period->populations()->exists()) {
                throw new Exception("Data populasi untuk periode {$period->population_period_year} semester {$period->population_period_semester} sudah diimpor sebelumnya");
            }

            Excel::import(new PopulationImport($request->population_period_id), $request->file('population_file'));

            return response()->json([
                'status_code' => 200,
                'message' => 'OK'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Error',
                'errors' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
