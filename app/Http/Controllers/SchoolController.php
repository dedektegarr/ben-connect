<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolRequest;
use App\Models\SchoolModel;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = SchoolModel::with(['daerah', 'category', 'dataset'])->get();

        return response()->json([
            'message' => 'Data sekolah berhasil ditemukan.',
            'data' => $schools
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SchoolRequest $request)
    {
        // Validasi sudah dilakukan otomatis oleh form request
        $validated = $request->validated();

        // Membuat data sekolah baru
        $school = SchoolModel::create([
            'level' => $validated['level'],
            'daerah_id' => $validated['daerah_id'],
            'category_id' => $validated['category_id'],
            'quantity' => $validated['quantity'],
            'year_id' => $validated['year_id'],
        ]);

        return response()->json([
            'message' => 'Sekolah berhasil disimpan.',
            'data' => $school
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $school_id)
    {
        $school = SchoolModel::with(['daerah', 'category', 'dataset'])->findOrFail($school_id);

        return response()->json([
            'message' => 'Data sekolah berhasil ditemukan.',
            'data' => $school
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SchoolRequest $request, string $school_id)
    {
        // Validasi sudah dilakukan otomatis oleh form request
        $validated = $request->validated();

        // Cari data sekolah berdasarkan ID, jika tidak ditemukan akan melempar 404
        $school = SchoolModel::findOrFail($school_id);

        // Update data sekolah dengan data yang sudah divalidasi
        $school->update([
            'level' => $validated['level'],
            'daerah_id' => $validated['daerah_id'],
            'category_id' => $validated['category_id'],
            'quantity' => $validated['quantity'],
            'year_id' => $validated['year_id'],
        ]);

        // Return response JSON setelah berhasil update
        return response()->json([
            'message' => 'Sekolah berhasil diperbarui.',
            'data' => $school
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $school_id)
    {
        // Cari data sekolah berdasarkan ID, jika tidak ditemukan akan melempar 404
        $school = SchoolModel::findOrFail($school_id);
    
        // Menghapus data sekolah
        $school->delete();
    
        // Return response JSON setelah berhasil menghapus
        return response()->json([
            'message' => 'Sekolah berhasil dihapus.'
        ], 200);
    }

    public function filter(Request $request)
    {
        // Validasi input JSON
        $validated = $request->validate([
            'dataset_tahun' => 'nullable|integer',
            'category_nama' => 'nullable|string',
            'daerah_nama' => 'nullable|string',
        ]);

        // Ambil parameter dari JSON
        $dataset_tahun = $validated['dataset_tahun'] ?? null;
        $category_nama = $validated['category_nama'] ?? null;
        $daerah_nama = $validated['daerah_nama'] ?? null;

        // Mulai query ke model School
        $query = SchoolModel::with(['daerah', 'category', 'dataset']);

        // Filter berdasarkan dataset_tahun
        if ($dataset_tahun) {
            $query->whereHas('dataset', function ($q) use ($dataset_tahun) {
                $q->whereYear('dataset_tahun', $dataset_tahun);
            });
        }

        // Filter berdasarkan category_nama
        if ($category_nama) {
            $query->whereHas('category', function ($q) use ($category_nama) {
                $q->where('category_nama', 'like', "%$category_nama%");
            });
        }

        // Filter berdasarkan daerah_nama
        if ($daerah_nama) {
            $query->whereHas('daerah', function ($q) use ($daerah_nama) {
                $q->where('daerah_nama', 'like', "%$daerah_nama%");
            });
        }

        // Ambil hasil query
        $schools = $query->get();

        // Format respons agar sesuai kebutuhan
        $formattedSchools = $schools->map(function ($school) {
            return [
                'id' => $school->school_id,
                'level' => $school->level,
                'quantity' => $school->quantity,
                'dataset_tahun' => optional($school->dataset)->dataset_tahun,
                'category_nama' => optional($school->category)->category_nama,
                'daerah_nama' => optional($school->daerah)->daerah_nama,
            ];
        });

        return response()->json([
            'message' => 'Data sekolah berhasil difilter.',
            'data' => $formattedSchools
        ], 200);
    }  
}
