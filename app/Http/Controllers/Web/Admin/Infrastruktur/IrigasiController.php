<?php

namespace App\Http\Controllers\Web\Admin\Infrastruktur;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Validation\ValidationException;

class IrigasiController extends Controller
{

    private $apiClient;
    public function index(Request $request)
{
    return view('admin.infrastruktur.irigasi.index');
}


    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    public function import(Request $request)
    {
        $this->apiClient->setToken($request->session()->get("auth_token"));

        try {
            $request->validate([
                "file" => "required|file|mimes:xls,xlsx|max:5000",
            ], [
                "file.required" => "File data irigasi tidak boleh kosong",
                'file.file' => 'Data irigasi harus berupa file',
                'file.mimes' => 'File data irigasi harus berformat .xls atau .xlsx',
                'file.max' => 'File data irigasi maksimal 5 Mb',
            ]);

            $import = $this->apiClient->post("/infrastruktur/irigasi/import", [], $request->files);

            if (isset($import["status_code"]) && $import["status_code"] === 400) {
                flash($import["message"], "error");
                return redirect()->back();
            }

            if (isset($import["status_code"]) && $import["status_code"] === 500) {
                throw new Exception($import["message"]);
            }

            flash("Data irigasi berhasil diimport", "success");
            return redirect()->back();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }
}
