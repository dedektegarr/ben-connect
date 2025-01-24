<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagsRequest;
use App\Models\TagsModel;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_tags=TagsModel::get();

        // Jika kosong
        if($data_tags->isEmpty())
        {
            return response()->json([
                'status_code'=>404,
                "message"=>"Data tag kosong",
            ],404);
        }
        

        // kembalikan nilai
        return response()->json([
            'status_code' => 200,
            'message' => "Data tag berhasil ditemukan",
            'data_tag' => $data_tags
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagsRequest $request)
    {
        //validasi data
        $validated=$request->validated();

        $news = TagsModel::create([
            'tag_name' => $validated['tag_name'],
        ]);

        // kembalikan response
        return response()->json([
            'status_code'=>201,
            'message' => 'Data tag berhasil dibuat.'
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $tag_id)
    {
        $data_tags = TagsModel::find($tag_id);

        // jika data tidak ditemukan
        if(!$data_tags)
        {
            return response()->json([
                'status_code'=>404,
                "message"=>"Data tag dengan id: {$tag_id} tidak ditemukan",
            ],404);
        }

        // kembalikan nilai
        return response()->json([
            'status_code' => 200,
            'message' => "Data tag dengan id: {$tag_id} berhasil ditemukan",
            'data_tag' => $data_tags
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagsRequest $request, string $tag_id)
    {
        // Validasi request
        $validated = $request->validated();
        
        // Temukan berita berdasarkan ID
        $data_tags = TagsModel::find($tag_id);

        // Jika tidak ditemukan
        if(!$data_tags)
        {
            return response()->json([
                'status_code'=>404,
                "message"=>"Data tag dengan id: {$tag_id} tidak ditemukan",
            ],404);
        }

         // Update tag
         $data_tags->update([
            'tag_name' => $validated['tag_name'],
        ]);

        // Kembalikan response JSON
        return response()->json([
            'status_code'=>200,
            'message' => "Data tag dengan id {$tag_id} telah berhasil diperbarui"
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $tag_id)
    {
        // Cari berita berdasarkan ID
        $data_tags = TagsModel::find($tag_id);

        // jika tidak ditemukan
        if(!$data_tags)
        {
            return response()->json([
                'status_code'=>404,
                "message"=>"Data tag dengan id: {$tag_id} tidak ditemukan",
            ],404);
        }

        $data_tags->delete();

        return response()->json([
            'status_code' => 200,
            'message' => "Data tag dengan id {$tag_id} telah berhasil dihapus",
        ]);
    }
}
