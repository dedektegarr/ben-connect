<?php

namespace App\Services;

use App\Models\PemberdayaanGender;
use Illuminate\Http\Request;

class PemberdayaanGenderService
{
    public function getAll()
    {
        return PemberdayaanGender::all();
    }

    public function create(Request $request)
    {
        $this->validatePemberdayaanGender($request);
        return PemberdayaanGender::create($request->all());
    }

    public function update(PemberdayaanGender $pemberdayaanGender, Request $request)
    {
        $this->validatePemberdayaanGender($request);
        $pemberdayaanGender->update($request->all());
        return $pemberdayaanGender;
    }

    public function delete(PemberdayaanGender $pemberdayaanGender)
    {
        return $pemberdayaanGender->delete();
    }

    private function validatePemberdayaanGender(Request $request)
    {
        return $request->validate([
            'daerah_id' => 'required|exists:daerah,id',
            'tahun_id' => 'required|exists:tahun,id',
            'jumlah' => 'required|numeric',
        ]);
    }
}
