<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsModel;

class SearchController extends Controller
{
    /**
     * Mencari berdasarkan Keyword di berbagai model.
     */
    public function searchByKeyword(Request $request)
    {
        // Ambil Keyword dari query string
        $keyword = $request->keyword;

        // Jika Keyword tidak ada di request
        if (!$keyword) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Keyword harus diberikan dalam pencarian',
            ], 400);
        }

        // Cari data berdasarkan Keyword untuk beberapa model
        $news = NewsModel::where('news_tag', 'LIKE', "%{$keyword}%")->get();

        // Gabungkan hasil pencarian dari berbagai model
        $results = [
            'news' => $news,
        ];

        // Cek apakah ada hasil
        if ($news->isEmpty()) {
            return response()->json([
                'status_code' => 404,
                'message' => "Tidak ada hasil ditemukan untuk keyword: '{$keyword}'",
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'results' => $results,
        ]);
    }
}
