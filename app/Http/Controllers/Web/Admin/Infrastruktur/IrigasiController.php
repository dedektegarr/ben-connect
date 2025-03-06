<?php

namespace App\Http\Controllers\Web\Admin\Infrastruktur;

use App\Http\Controllers\Controller;
use App\Services\ApiClient; // Pastikan ini di-import
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class IrigasiController extends Controller
{
    private $apiClient;

    public function __construct()
    {
        // Inisialisasi ApiClient dengan URL API
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    public function index(Request $request)
    {
        return view('admin.infrastruktur.irigasi.index');
    }
}
