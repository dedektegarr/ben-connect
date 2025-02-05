<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\PricesImport;
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
}

