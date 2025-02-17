<?php

namespace App\Http\Controllers\Web\Admin\Penduduk;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class JumlahPendudukController extends Controller
{
    public function index()
    {
        $token = Auth::user()->tokens->first()->token;
        $url = config("app.url") . "/api/kependudukan/data";

        try {
            $response = Http::withToken("10|1HadFfkQecLjCAKoi6iSGKTr0pB1AEmjUZNJSG3m1b4ebe29")->get($url);
            dd($response->json());
        } catch (Exception $e) {
            dd($e->getMessage());
        }

        return view("admin.penduduk.jumlah-penduduk.index");
    }
}
