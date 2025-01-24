<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\NewsModel;
use App\Models\NewsTagModel;
use App\Models\TagsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Ambil seluruh data di dalam model
        $data_news=NewsModel::with('user','tags')->get();

        // format data
        $formatData=$data_news->map(function ($data_news){
            return[
                'news_id'=>$data_news->news_id,
                'news_title'=>$data_news->news_title,
                'news_description'=>$data_news->news_description,
                'news_image'=>$data_news->news_image,
                'news_category'=>$data_news->news_category,
                'created_at'=>$data_news->created_at->format('Y-m-d'),
                'updated_at'=>$data_news->updated_at->format('Y-m-d'),
                'news_author'=>optional($data_news->user)->name,
                'tags' => $data_news->tags->pluck('tag_name'),
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
            'message' => 'Berhasil mengambil seluruh data berita',
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
            'user_id' => $request->user()->id,
        ]);

        // Ambil ID news
        $news_id = $news->news_id;

        // Simpan ke tabel pivot news_tag dengan looping
        if ($request->has('tags')) {
            // Mengambil array tag_id dari request
            $tagIds = $request->input('tags'); // Misalnya array tag_id

            // Looping dan menyimpan ke tabel pivot satu per satu
            foreach ($tagIds as $tagId) {
                // Insert ke tabel pivot news_tag
                $newstag=NewsTagModel::create([
                    'news_id' => $news_id,
                    'tag_id' => $tagId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        
        // ambil file yang dikirimkan dan ke public
        return response()->json([
            'status_code'=>201,
            'message' => 'Data berita berhasil dibuat.'
        ],201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $news_id)
    {
        //cari news dengan id tertentu
        $data_news=NewsModel::with('user','tags')->get()->find($news_id);

        // Jika kosong
        if(!$data_news)
        {
            return response()->json([
                'status_code'=>404,
                "message"=>"Data berita dengan id: {$news_id} tidak ditemukan",
            ],404);
        }

        // format data
        $formatData=
            [
                'news_id'=>$data_news->news_id,
                'news_title'=>$data_news->news_title,
                'news_description'=>$data_news->news_description,
                'news_image'=>$data_news->news_image,
                'news_category'=>$data_news->news_category,
                'created_at'=>$data_news->created_at->format('Y-m-d'),
                'updated_at'=>$data_news->updated_at->format('Y-m-d'),
                'news_author'=>optional($data_news->user)->name,
                'tags' => $data_news->tags->pluck('tag_name'),
            ];

        return response()->json([
            'status_code'=>200,
            'message' => 'Data berita dengan id {$news_id} berhasil ditemukan',
            'data_news' => $formatData
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, string $news_id)
    {
        // Validasi request
        $validated = $request->validated();
        
        // Temukan berita berdasarkan ID
        $data_news = NewsModel::find($news_id);
        
        // Jika kosong
        if(!$data_news)
        {
            return response()->json([
                'status_code'=>404,
                "message"=>"Data berita dengan id: {$news_id} tidak ditemukan",
            ],404);
        }

        // Proses upload gambar baru jika ada
        if ($request->hasFile('news_image')) 
        {
            // Hapus gambar lama jika ada
            if ($data_news->news_image && Storage::exists('public/' . $data_news->news_image)) {
                Storage::delete('public/' . $data_news->news_image);
            }
    
            // Simpan gambar baru
            $path = $request->file('news_image')->store('news_images', 'public');
        } 
        else 
        {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $path = $data_news->news_image;
        }
    
        // Update berita dengan data baru
        $data_news->update([
            'news_title' => $validated['news_title'],
            'news_image' => $path,
            'news_description' => $validated['news_description'],
            'news_category' => $validated['news_category'],
            'user_id' => $request->user()->id,
        ]);

        // Hapus semua tag yang terhubung dengan berita ini
        $newstag = NewsTagModel::find($news_id);
        $newstag->delete();

        // Tambahkan tag baru (jika ada)
        if ($request->has('tags')) {
            $tagIds = $request->input('tags'); // Array tag_id yang dikirim melalui request

            // Looping untuk menambahkan tag baru
            foreach ($tagIds as $tagId) {
                $newstag=NewsTagModel::create([
                    'news_id' => $news_id,
                    'tag_id' => $tagId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    
        // Kembalikan response JSON
        return response()->json([
            'status_code'=>200,
            'message' => "Data berita dengan id {$news_id} telah berhasil diperbarui"
        ],200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $news_id)
    {
        // Cari berita berdasarkan ID
        $news = NewsModel::find($news_id);
    
        // Jika berita tidak ditemukan, kembalikan respons 404
        if (!$news) {
            return response()->json([
                'status_code' => 404,
                'message' => "Data berita dengan id {$news_id} tersebut tidak ditemukan",
            ], 404);
        }
    
        // Hapus gambar jika ada
        if ($news->news_image && Storage::exists('public/' . $news->news_image)) {
            Storage::delete('public/' . $news->news_image);
        }
    
        // Hapus berita
        $news->delete();
    
        // Kembalikan respons sukses
        return response()->json([
            'status_code' => 200,
            'message' => "Data berita dengan id {$news_id} telah berhasil dihapus",
        ]);
    }    
}
