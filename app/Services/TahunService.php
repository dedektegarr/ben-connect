<?php

namespace App\Services;

use App\Models\Tahun;
use Illuminate\Http\Request;

class TahunService
{
    public function getAll()
    {
        return Tahun::all();
    }

    public function create(Request $request)
    {
        $this->validateTahun($request);
        return Tahun::create($request->all());
    }

    public function update(Tahun $tahun, Request $request)
    {
        $this->validateTahun($request);
        $tahun->update($request->all());
        return $tahun;
    }

    public function delete(Tahun $tahun)
    {
        return $tahun->delete();
    }

    private function validateTahun(Request $request)
    {
        return $request->validate([
            'tahun' => 'required|date_format:Y',
        ]);
    }
}
