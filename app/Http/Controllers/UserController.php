<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request){
       $user = [
            'email' => $request->email,
            'password' => $request->password
       ];

       if (Auth::attempt($user)){
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('ben-token')->plainTextToken;
            return response()->json([
                'status_code' => 200,
                'massage' => 'Login berhasil',
                'token' => $token
            ], 200);
        }else{
            return response()->json([
                'status_code' => 401,
                'message' => 'Login gagal. Username dan Password tidak terdaftar'
            ], 401);
        }
    }

    public function logout(Request $request){
        $user = $request->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        
        return response()->json([
            'status_code' => 200,
            'massage' => 'Logout berhasil',
        ], 200);
    }

}
