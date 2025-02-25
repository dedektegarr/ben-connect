<?php

namespace App\Http\Controllers\Web\Admin\Industri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndustriNasional extends Controller
{
    public function index()
    {
        return view("admin.industri.industri-nasional.index");
    }
}
