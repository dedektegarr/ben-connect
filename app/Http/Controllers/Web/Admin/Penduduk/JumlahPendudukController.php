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
        $token = request()->session()->get("auth_token");
        $url = config("app.url") . "/api/kependudukan/data";

        try {
            $response = Http::withToken($token)->get($url);
            $data = $response->json();

            $penduduk = [];

            if (isset($data["data"]) && is_array($data["data"])) {
                $penduduk = $data["data"];
            }

            return view("admin.penduduk.jumlah-penduduk.index", [
                "penduduk" => $penduduk
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
