<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\IkmImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class IkmController extends Controller
{
    public function importExcel(Request $request)
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
    
}    