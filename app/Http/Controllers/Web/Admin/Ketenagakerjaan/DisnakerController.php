<?php

namespace App\Http\Controllers\Web\Admin\Ketenagakerjaan;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DisnakerController extends Controller
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

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

    public function import(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $request->validate([
                "file" => "required|file|mimes:xls,xlsx|max:5000",
                "year" => "required|numeric"
            ], [
                "file.required" => "File tidak boleh kosong",
                'file.file' => 'Data komditas harus berupa file',
                'file.mimes' => 'File harus berformat .xls atau .xlsx',
                'file.max' => 'File maksimal 5 Mb ',
                'year.required' => 'Tahun tidak boleh kosong'
            ]);

            $import = $this->apiClient->post("/ketenagakerjaan/pencari-kerja-terdaftar/import", ["year" => $request->year], $request->files);

            if (is_array($import) && isset($import["status_code"])) {
                if ($import["status_code"] === 400) {
                    flash($import["message"], "error");
                    return redirect()->back();
                }

                if ($import["status_code"] === 500) {
                    throw new Exception($import["message"]);
                }

                flash("Data naker berhasil diimpor", "success");
                return redirect()->back();
            }
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
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
