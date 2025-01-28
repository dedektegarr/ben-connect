<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //Medapatkan seluruh user
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

    //Menambahkan user baru (Register)
    public function store(Request $request)
    {   
        //Validasi input
        $formRequest = new UserRequest('user_input'); 
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        $role = $request->role;
        $password = bcrypt($request->password);
        $request['password'] = $password;
        unset($request['role']);
        
        //Mendaftarkan user ke database dan memberikan role
        User::create($request->all())->assignRole($role);
        return response()->json([
            'status_code' => 201,
            'message' => 'User berhasil didaftarkan'
        ], 201);
    }

   //Mendapatkan user sesuai ID
    public function show(string $id)
    {
        $data = User::find($id);

        //Cek data sesuai ID
        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Data user tidak ditemukan!'
            ], 404);  
        }

        $data = $data->where('id', $id)->get();
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
            'message' => 'Data user berhasil ditemukan',
            'data_user' => $data
        ], 200);
    }

    //Mengubah user
    public function update(Request $request, string $id)
    {
        $data = User::find($id);

        //Cek data sesuai ID
        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Data user tidak ditemukan!'
            ], 404);  
        }

        //Validasi input
        $formRequest = new UserRequest('user_update'); 
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        $role = $request->role;
        unset($request['role']);
        
        //Update data user dan memberikan role
        $data->update($request->all());
        $data->syncRoles($role);
        return response()->json([
            'status_code' => 200,
            'message' => 'Data user berhasil diubah'
        ], 200);
    }

    //Menghapus user
    public function destroy(string $id)
    {
        $data = User::find($id);

        //Cek data sesuai ID
        if(empty($data)){
            return response()->json([
                'status_code' => 404,
                'message' => 'Data user tidak ditemukan!'
            ], 404);  
        }

        //Hapus user (Soft Delete)
        $data->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Data user berhasil dihapus'
        ], 200); 
    }

    //Login user
    public function login(Request $request)
    {
        //Validasi input
        $formRequest = new UserRequest('user_login'); 
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        $user = [
            'email' => $request->email,
            'password' => $request->password
        ];

        //Otentikasi user
        if (Auth::attempt($user)){
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('ben-token', ['*'], now()->addDay())->plainTextToken; //Set token (durasi token 1 hari)
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

    //Logout user dan menghapus token
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        
        return response()->json([
            'status_code' => 200,
            'massage' => 'Logout berhasil',
        ], 200);
    }

    //Ubah password user
    public function updatePassword(Request $request)
    {
        //Validasi input
        $formRequest = new UserRequest('user_update_password'); 
        $this->validate($request, $formRequest->rules(), $formRequest->messages());
        
        //Cek password saat ini
        $checkPassword = Hash::check($request->current_password, $request->user()->password);
        if(!$checkPassword){
            return response()->json([
                'status_code' => 400,
                'message' => 'Password saat ini salah'
            ], 400);
        }

        //Update password baru
        User::find($request->user()->id)->update(['password' => $request->new_password]);
        return response()->json([
            'status_code' => 200,
            'message' => 'Password berhasil diubah'
        ], 200);
    }
}
