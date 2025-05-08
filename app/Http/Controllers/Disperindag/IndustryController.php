<?php

namespace App\Http\Controllers\Disperindag;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(["region", "skala", "year"]);

        $industries = Industry::with("region")->filter($filters)->latest()->get();

        return response()->json([
            "status" => 200,
            "message" => "Data berhasil di ambil",
            "data" => $industries
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
