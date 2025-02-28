<?php

namespace App\Http\Controllers\Web\Admin\Kesehatan;

use App\Http\Controllers\Controller;
use App\Http\Requests\OPDKesehatanRequest;
use App\Services\ApiClient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RumahSakitController extends Controller
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(config("app.url") . "/api");
    }

    public function index()
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $data = $this->apiClient->get("/kesehatan/rs");

            if ($data["status_code"] === 200) {
                return view("admin.kesehatan.rs.index", [
                    "rumah_sakit" => $data["data"]
                ]);
            }

            throw new Exception($data["message"]);
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }

    public function import(Request $request)
    {
        $this->apiClient->setToken(request()->session()->get("auth_token"));

        try {
            $formRequest = new OPDKesehatanRequest("hospital_import");
            $this->validate($request, $formRequest->rules(), $formRequest->messages());

            $import = $this->apiClient->post("/kesehatan/rs/import", [], $request->files);

            if ($import["status_code"] === 201) {
                flash("Data rumah sakit berhasil di import");
                return redirect()->back();
            }

            throw new Exception($import["message"]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (Exception $e) {
            flash($e->getMessage(), "error");
            return redirect()->back();
        }
    }
}
