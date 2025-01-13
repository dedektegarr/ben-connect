<?php

namespace App\Services;

use App\Models\PembangunanGender;
use Illuminate\Http\Request;

class PembangunanGenderService
{
    public function getAll()
    {
        return PembangunanGender::all();
    }

    public function create(Request $request)
    {
        $this->validatePembangunanGender($request);
        return PembangunanGender::create($request->all());
    }

    public function update(PembangunanGender $pembangunanGender, Request $request)
    {
        $this->validatePembangunanGender($request);
        $pembangunanGender->update($request->all());
        return $pembangunanGender;
    }

    public function delete(PembangunanGender $pembangunanGender)
    {
        return $pembangunanGender->delete();
    }

    private function validatePembangunanGender(Request $request)
    {
        return $request->validate([
            'daerah_id' => 'required|exists:daerah,id',
            'tahun_id' => 'required|exists:tahun,id',
            'jumlah' => 'required|numeric',
        ]);
    }
}
