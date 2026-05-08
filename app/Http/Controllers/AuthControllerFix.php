<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; //untuk hashing password       

class AuthControllerFix extends Controller
{
    public function login(Request $request)
     {
         $credentials = $request -> validate([ //mengambil email dan password dari request
             'email' => 'required|email',
             'password' => 'required'
         ]);

         if (Auth::attempt($credentials)) { //validasi email dan password

             $user = Auth::user(); //mengambil data user yang berhasil login

             $token = $user->createToken('auth_token')->plainTextToken; //membuat token untuk user yang login
             return response()->json([
                 'message' => 'Login berhasil',
                 'token' => $token
             ]);
         } else {
             return response()->json([
                 'message' => 'Login gagal, pastikan email dan password benar'
             ], 401);
         }  
      }      

    public function register(Request $request)
     {
         $request->validate([
             'name' => 'required', //validasi nama user
             'email' => 'required|email|unique:users,email', //validasi email user, harus berupa email dan unik di tabel users
             'password' => 'required|min:6' //validasi password user, harus minimal 6 karakter
         ]);  
         $user = User::create([ //membuat user baru dengan data yang sudah divalidasi
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password), //password dihash menggunakan bcrypt, agar password yang disimpan di database tidak bisa dibaca langsung.
             'role' => 'user' //menambahkan role default 'user' saat membuat user baru
         ], 201);

         return response()->json([
             'message' => 'Registrasi berhasil',
             'user' => $user //mengembalikan data user yang baru dibuat
         ]);  
     }  
}
