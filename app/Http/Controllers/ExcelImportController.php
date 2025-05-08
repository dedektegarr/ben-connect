<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\IkmImport;
use App\Imports\IndustryImport;
use App\Imports\PricesImport;
use App\Models\Industry;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class ExcelImportController extends Controller
{
    /**
     * Endpoint for uploading and processing the Excel file
     */
    public function import(Request $request)
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'File harus berformat xlsx atau xls.',
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            $import = new PricesImport();
            // Process the Excel file with PricesImport
            $data = Excel::import($import, $request->file('file'));

            // Cek apakah ada error dari proses import
            if (!empty($import->getErrors())) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Terdapat kesalahan dalam import data.',
                    'errors' => $import->getErrors(),
                ], 400);
            }

            // Flatten the collection and return the result
            return response()->json([
                'status' => 200,
                'message' => 'File berhasil di-import.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat memproses file.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function importexcel_ikm(Request $request)
    {
        // Validasi file dan tahun
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls',
            'year' => 'required|integer|min:1990|max:2100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'File harus berformat xlsx atau xls dan tahun harus diisi.',
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            $import = new IkmImport($request->year);
            Excel::import($import, $request->file('file'));

            if (!empty($import->getErrors())) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Beberapa baris mengalami error',
                    'errors' => $import->getErrors()
                ], 422);
            }

            // Jika berhasil
            return response()->json([
                'status' => 200,
                'message' => 'File berhasil di-import.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat memproses file.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function importexcel_industry(Request $request)
    {
        // Validasi file dan tahun
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls',
            'year' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'File harus berformat xlsx atau xls dan tahun harus diisi.',
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            $import = new IndustryImport($request->year);
            Excel::import($import, $request->file('file'));

            if (!empty($import->getErrors())) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Beberapa baris mengalami error',
                    'errors' => $import->getErrors()
                ], 422);
            }

            // Jika berhasil
            return response()->json([
                'status' => 200,
                'message' => 'File berhasil di-import.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat memproses file.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
