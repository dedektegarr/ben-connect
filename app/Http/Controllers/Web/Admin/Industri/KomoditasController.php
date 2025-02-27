<?php

namespace App\Http\Controllers\Web\Admin\Industri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KomoditasController extends Controller
{
    public function index() {
        return view("admin.industri.komoditas.index"); // Update the path here
    }

}
