<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('auth.registrasi');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username',
            'password' => 'required|min:8|max:16',
        ], [
            'name.required' => 'Nama Lengkap wajib diisi',
            'name.max' => 'Nama Lengkap maksimal 255 karakter',
            'username.required' => 'Username wajib diisi',
            'username.max' => 'Username maksimal 255 karakter',
            'username.unique' => 'Username sudah tersedia',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 16 karakter',
        ]);

        $validated['password'] = bcrypt($request->password);
        $validated['level'] = 'Admin';
        $validated['created_at'] = Carbon::now();
        $validated['created_by'] = 'Admin';
        $validated['is_deleted'] = '1';

        User::create($validated);

        return redirect()->route('login')->with('success', 'Yeay, pendaftaran sukses! Anda kini resmi menjadi bagian dari sistem kami.');
    }
}
