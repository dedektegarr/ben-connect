<?php

namespace App\Http\Controllers\Web\Admin\Ketenagakerjaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisnakerController extends Controller
{
    public function wlkpIndex()
    {
        return view('admin.ketenagakerjaan.wlkp.index');
    }

    public function disnakerIndex()
    {
        return view('admin.ketenagakerjaan.disnaker.index');
    }
}
