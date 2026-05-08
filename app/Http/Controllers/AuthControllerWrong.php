<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthControllerWrong extends Controller
{
    
    // KODE YOGA YANG SALAH (menggunakan email orang lain dengan password yang tidak sesuai tetap bisa login)
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first(); //validasi email user sebelum login

        Auth::login($user); //user langsung login tanpa ada validasi password 

        $token = $user->createToken('auth_token')->plainTextToken; //membuat token untuk user yang login

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token
        ]);
        // akibat tidak adanya validasi password, siapa saja bisa login menggunakan email yang valid meskipun password tidak sesuai.
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
            'password' => ($request->password), //password disimpan apa adanya tanpa hashing, ini sangat tidak aman karena password bisa dibaca langsung dari database
            'role' => 'user' //menambahkan role default 'user' saat membuat user baru
        ]);

        return response()->json([ 
            'message' => 'Registrasi berhasil',
            'user' => $user //mengembalikan data user yang baru dibuat
        ], 201);
    }

}