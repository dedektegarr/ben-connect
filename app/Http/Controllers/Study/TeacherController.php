<?php

namespace App\Http\Controllers\Study;

use App\Http\Controllers\Controller;
use App\Http\Requests\study\TeacherRequest;
use App\Imports\TeacherCountImport;
use App\Models\Teacher;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(["year"]);
        $filters["year"] = $filters["year"] ?? Carbon::now()->year;

        $teachers = Teacher::with(["region", "schoollevel"])->filter($filters)->get();

        return response()->json([
            "status_code" => 200,
            "data" => $teachers
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

    public function import(Request $request)
    {
        $formRequest = new TeacherRequest();
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        try {
            Excel::import(new TeacherCountImport($request->year), $request->file("teacher_file"));

            return response()->json([
                "status_code" => 201,
                "message" => "OK"
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status_code" => 400,
                "message" => $e->getMessage()
            ], 400);
        }

        dd($request->file("teacher_file"));
    }
}
