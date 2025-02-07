<?php

namespace App\Http\Controllers\FrontOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class DashboardBerandaController extends Controller
{
    public function index() 
    {
        return view ('FrontOffice.beranda.beranda');  
    }
}
