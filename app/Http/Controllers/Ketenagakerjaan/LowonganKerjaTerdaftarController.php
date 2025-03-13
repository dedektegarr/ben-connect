<?php

namespace App\Http\Controllers\Ketenagakerjaan;

use App\Http\Controllers\Controller;
use App\Models\LowonganKerjaTerdaftar;
use Illuminate\Http\Request;

class LowonganKerjaTerdaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = LowonganKerjaTerdaftar::with(["region"])->latest()->get();

        return response()->json([
            "status" => 200,
            "data" => $data
        ]);
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
