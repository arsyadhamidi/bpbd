<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request){
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // Lakukan validasi pada input
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required|min:8',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Selamat ! Anda berhasil login!');
        } else {
            return back()->with('error', 'Maaf | Username atau password anda salah !');
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
