<?php

namespace App\Services;

use App\Models\Daerah;
use Illuminate\Http\Request;

class DaerahService
{
    public function getAll()
    {
        return Daerah::all();
    }

    public function create(Request $request)
    {
        $this->validateDaerah($request);
        return Daerah::create($request->all());
    }

    public function update(Daerah $daerah, Request $request)
    {
        $this->validateDaerah($request);
        $daerah->update($request->all());
        return $daerah;
    }

    public function delete(Daerah $daerah)
    {
        return $daerah->delete();
    }

    private function validateDaerah(Request $request)
    {
        return $request->validate([
            'nama_daerah' => 'required|string|max:100',
        ]);
    }
}