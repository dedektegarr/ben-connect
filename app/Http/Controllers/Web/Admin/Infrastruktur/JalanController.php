<?php

namespace App\Http\Controllers\Web\Admin\Infrastruktur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JalanController extends Controller
{
    public function index()
    {
        return view('admin.infrastruktur.jalan.index');
    }
}
