<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\NewsModel;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Ambil seluruh data di dalam model
        $data_news=NewsModel::with('user')->get();

        // format data
        $formatData=$data_news->map(function ($data_news){
            return[
                'news_id'=>$data_news->news_id,
                'news_title'=>$data_news->news_title,
                'news_description'=>$data_news->news_descrition,
                'news_image'=>$data_news->news_image,
                'news_category'=>$data_news->news_category,
                'news_tag'=>$data_news->news_tag,
                'news_author'=>optional($data_news->user)->name,
            ];
        });

        // Jika kosong
        if($data_news->isEmpty())
        {
            return response()->json([
                'status_code'=>404,
                "message"=>"Data berita kosong",
            ],404);
        }
        
        // kembalikan respon
        return response()->json([
            'status_code'=>200,
            'message' => 'Data berita berhasil ditemukan.',
            'data_berita' => $formatData
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {
        //validasi request
        $validated=$request->validated();

        // Proses upload file gambar jika ada
        if ($request->hasFile('news_image')) 
        {
            $path = $request->file('news_image')->store('news_images', 'public'); // Simpan di folder storage/app/public/news_images
        } 
        else 
        {
            $path = null; // Jika tidak ada gambar, biarkan null
        }

        // Simpan ke news
        $news = NewsModel::create([
            'news_title' => $validated['news_title'],
            'news_image' => $path,
            'news_description' => $validated['news_description'],
            'news_category' => $validated['news_category'],
            'news_tag'=>$validated['news_tag'],
            'user_id' => $request->user()->id,
        ]);

        
        // ambil file yang dikirimkan dan ke public
        return response()->json([
            'data_user'=> $request->user()->id
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $news_id)
    {
        //cari news dengan id tertentu
        $data_news=NewsModel::with('user')->get()->find($news_id);

        // Jika kosong
        if(!$data_news)
        {
            return response()->json([
                'status_code'=>404,
                "message"=>"Data berita kosong",
            ],404);
        }

        // format data
        $formatData=
            [
                'news_id'=>$data_news->news_id,
                'news_title'=>$data_news->news_title,
                'news_description'=>$data_news->news_descrition,
                'news_image'=>$data_news->news_image,
                'news_category'=>$data_news->news_category,
                'news_tag'=>$data_news->news_tag,
                'news_author'=>optional($data_news->user)->name,
            ];

        return response()->json([
            'status_code'=>200,
            'message' => 'Data news berhasil ditemukan.',
            'data_news' => $formatData
        ], 200);
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
