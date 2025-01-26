<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::with('roles')->get();
        $data = $data->map(function($user){
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->roles->first()->name
            ];
        });

        return response()->json([
            'status_code' => 200,
            'message' => "Data user",
            'data_user' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'massage' => 'Data tidak valid',
                'errors' => $request->validator->errors()
            ], 400);
        }

        $role = $request->role;
        $password = bcrypt($request->password);
        $request['password'] = $password;
        unset($request['role']);
        
        User::create($request->all())->assignRole($role);
        return response()->json([
            'status_code' => 201,
            'message' => 'User berhasil didaftarkan'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::where('id', $id);

        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Data user tidak ditemukan!'
            ], 404);  
        }

        $data = $data->get()->map(function($user){
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->roles->first()->name
            ];
        });

        return response()->json([
            'status_code' => 200,
            'message' => 'Data user berhasil ditemukan',
            'data_user' => $data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'massage' => 'Data tidak valid',
                'errors' => $request->validator->errors()
            ], 400);
        }

        $data = User::find($id);
        
        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Data user tidak ditemukan!'
            ], 404);  
        }

        $role = $request->role;
        unset($request['role']);
        
        
        $data->update($request->all());
        $data->syncRoles($role);
        return response()->json([
            'status_code' => 200,
            'message' => 'Data user berhasil diubah'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $data = User::find($id);

        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Data user tidak ditemukan!'
            ], 404);  
        }

        $data->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Data user berhasil dihapus'
        ], 200); 
    }

    public function login(LoginRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'massage' => 'Login gagal',
                'errors' => $request->validator->errors()
            ], 401);
        }

        $user = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($user)){
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('ben-token', ['*'], now()->addDay())->plainTextToken;
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

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        
        return response()->json([
            'status_code' => 200,
            'massage' => 'Logout berhasil',
        ], 200);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'massage' => 'Data tidak valid',
                'errors' => $request->validator->errors()
            ], 400);
        }

        $checkPassword = Hash::check($request->current_password, $request->user()->password);
        if(!$checkPassword){
            return response()->json([
                'status_code' => 400,
                'message' => 'Password saat ini salah'
            ], 400);
        }

        User::find($request->user()->id)->update(['password' => $request->new_password]);
        return response()->json([
            'status_code' => 200,
            'message' => 'Password berhasil diubah'
        ], 200);
    }
}
