<?php

namespace App\Services;

use App\Models\AngkaKemiskinan;
use Illuminate\Http\Request;

class AngkaKemiskinanService
{
    public function getAll()
    {
        return AngkaKemiskinan::all();
    }

    public function create(Request $request)
    {
        $this->validateAngkaKemiskinan($request);
        return AngkaKemiskinan::create($request->all());
    }

    public function update(AngkaKemiskinan $angkaKemiskinan, Request $request)
    {
        $this->validateAngkaKemiskinan($request);
        $angkaKemiskinan->update($request->all());
        return $angkaKemiskinan;
    }

    public function delete(AngkaKemiskinan $angkaKemiskinan)
    {
        return $angkaKemiskinan->delete();
    }

    private function validateAngkaKemiskinan(Request $request)
    {
        return $request->validate([
            'daerah_id' => 'required|exists:daerah,id',
            'tanggal_terbit' => 'required|date',
            'jumlah' => 'required|numeric',
        ]);
    }
}