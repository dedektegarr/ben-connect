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

    public function pktIndex()
    {
        return view('admin.ketenagakerjaan.pkt.index');
    }

    public function lktIndex()
    {
        return view('admin.ketenagakerjaan.lkt.index');
    }

    public function ptkIndex()
    {
        return view('admin.ketenagakerjaan.ptk.index');
    }
}
