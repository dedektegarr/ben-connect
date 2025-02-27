<?php

namespace App\Http\Controllers\Web\Admin\Industri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IKMController extends Controller
{
    public function index() {
        return view("admin.industri.ikm.index");
    }
}
