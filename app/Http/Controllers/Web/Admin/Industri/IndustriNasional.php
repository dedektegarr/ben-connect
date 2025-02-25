<?php

namespace App\Http\Controllers\Web\Admin\Industri;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class IndustriNasional extends Controller
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    public function index()
    {
        return view("admin.industri.industri-nasional.index");
    }

    public function import(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $request->validate([
                "file" => "required"
            ], [
                "file.required" => "File data SIINas tidak boleh kosong"
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }
        dd($request->all());
    }
}
