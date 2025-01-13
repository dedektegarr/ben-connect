<?php 

namespace App\Services;

use App\Models\Akta;
use Illuminate\Http\Request;

class AktaService
{
    public function getAll()
    {
        return Akta::all();
    }

    public function create(Request $request)
    {
        $this->validateAkta($request);
        return Akta::create($request->all());
    }

    public function update(Akta $akta, Request $request)
    {
        $this->validateAkta($request);
        $akta->update($request->all());
        return $akta;
    }

    public function delete(Akta $akta)
    {
        return $akta->delete();
    }

    private function validateAkta(Request $request)
    {
        return $request->validate([
            'daerah_id' => 'required|exists:daerah,id',
            'jumlah_penduduk' => 'required|numeric',
            'tahun_id' => 'required|exists:tahun,id',
        ]);
    }
}
