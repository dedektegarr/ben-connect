<?php

namespace App\Http\Controllers\Web\Admin\Penduduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JumlahPendudukController extends Controller
{
    public function index()
    {
        return view("admin.penduduk.jumlah-penduduk.index");
    }
}
