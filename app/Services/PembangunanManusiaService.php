<?php

namespace App\Services;

use App\Models\PembangunanManusia;
use Illuminate\Http\Request;

class PembangunanManusiaService
{
    public function getAll()
    {
        return PembangunanManusia::all();
    }

    public function create(Request $request)
    {
        $this->validatePembangunanManusia($request);
        return PembangunanManusia::create($request->all());
    }

    public function update(PembangunanManusia $pembangunanManusia, Request $request)
    {
        $this->validatePembangunanManusia($request);
        $pembangunanManusia->update($request->all());
        return $pembangunanManusia;
    }

    public function delete(PembangunanManusia $pembangunanManusia)
    {
        return $pembangunanManusia->delete();
    }

    private function validatePembangunanManusia(Request $request)
    {
        return $request->validate([
            'daerah_id' => 'required|exists:daerah,id',
            'tanggal_terbit' => 'required|date',
            'jumlah' => 'required|numeric',
        ]);
    }
}
