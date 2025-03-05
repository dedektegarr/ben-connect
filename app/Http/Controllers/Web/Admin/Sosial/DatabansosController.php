<?php

namespace App\Http\Controllers\Web\Admin\Sosial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DatabansosController extends Controller
{
    public function index()
    {
        return view('admin.sosial.index');
    }
}
