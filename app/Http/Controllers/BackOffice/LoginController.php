<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            return redirect()->back();
        }
        return view('BackOffice.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        try {
            $response = Http::post(url("/api/login"), $credentials);
            $data = $response->json();

            // Not Authenticated
            if ($response->status() === 401) {
                return back()->withErrors(['email' => $data["message"]])->onlyInput('email');
            }

            // Validation Errors
            if ($response->status() === 400) {
                return back()->withErrors($data["errors"]);
            }

            // Authenticated, set token session and login using id
            Session::put("auth_token", $data["token"]);
            Auth::loginUsingId($data["id"]);

            return redirect()->route('dashboard')->with('success', $data["massage"]);
        } catch (Exception $e) {
            return back()->withErrors(["Terjadi kesalahan", $e->getMessage()]);
        }
    }


    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Berhasil Logout !');;
    }
}
