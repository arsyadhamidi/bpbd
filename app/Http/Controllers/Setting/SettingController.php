<?php

namespace App\Http\Controllers\Setting;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('setting.index');
    }

    public function updateprofile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama Lengkap wajib diisi',
        ]);

        $users = Auth()->user();
        $validated['updated_at'] = Carbon::now();
        $validated['updated_by'] = $users->id;

        User::where('id', $users->id)->update($validated);

        return redirect('setting')->with('success', 'Anda berhasil memperbaharui Nama Lengkap');
    }

    public function updateusername(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|min:3|max:20|unique:users',
        ], [
            'username.required' => 'Username wajib diisi',
            'username.min' => 'Username minimal 4 karakter',
            'username.max' => 'Username maximal 20 karakter',
            'username.unique' => 'Username sudah tersedia',
        ]);

        $users = Auth()->user();
        $validated['updated_at'] = Carbon::now();
        $validated['updated_by'] = $users->id;

        User::where('id', $users->id)->update($validated);

        return redirect('setting')->with('success', 'Anda berhasil memperbaharui username');
    }

    public function updatepassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'konfirmasipassword' => 'required|min:8|same:password'
        ], [
            'password.required' => 'Password wajib diisi',
            'konfirmasipassword.required' => 'Konfimasi Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'konfirmasipassword.min' => 'Konfirmasi Password minimal 8 karakter',
            'konfirmasipassword.same' => 'Konfirmasi Password tidak sesuai dengan password'
        ]);

        $users = Auth()->user();
        User::where('id', $users->id)->update([
            'password' => bcrypt($request->password),
            'updated_at' => Carbon::now(),
            'updated_by' => $users->id,
        ]);

        return redirect('setting')->with('success', 'Anda berhasil memperbaharui password');
    }

    public function updategambar(Request $request)
    {
        $validated = $request->validate([
            'foto_profile' => 'required|mimes:png,jpg,jpeg|max:10240',
        ], [
            'foto_profile.required' => 'Foto Profile wajib diisi',
            'foto_profile.mimes' => 'Foto Profile wajib memiliki format PNG, JPG, atau JPEG',
            'foto_profile.max' => 'Foto Profile maximal 10 MB',
        ]);

        $users = User::where('id', Auth()->user()->id)->first();
        $validated['updated_at'] = Carbon::now();
        $validated['updated_by'] = $users->id;
        if ($request->file('foto_profile')) {
            if ($users->foto_profile) {
                Storage::delete($users->foto_profile);
            }
            $validated['foto_profile'] = $request->file('foto_profile')->store('foto_profile');
        } else {
            $validated['foto_profile'] = $users->foto_profile;
        }

        $users->update($validated);

        return redirect('setting')->with('success', 'Anda berhasil memperbaharui foto profile');
    }

    public function deletegambar()
    {
        $users = User::where('id', Auth()->user()->id)->first();
        $validated['updated_at'] = Carbon::now();
        $validated['updated_by'] = $users->id;
        if ($users->foto_profile) {
            Storage::delete($users->foto_profile);
        }
        $validated['foto_profile'] = null;

        $users->update($validated);

        return redirect('setting')->with('success', 'Anda berhasil menghapus foto profile');
    }
}
