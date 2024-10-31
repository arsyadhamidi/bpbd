<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminUsersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $perPage = $request->input('length', 10);
            $search = $request->input('search', '');

            $query = User::where('is_deleted', '1');
            $query->orderBy('id', 'desc');

            if ($search) {
                $query->where(function ($query) use ($search) {
                    $query->Where('nama_lokasi', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('username', 'LIKE', "%{$search}%")
                    ->orWhere('level', 'LIKE', "%{$search}%");
                });
            }

            $totalRecords = $query->count(); // Hitung total data

            $data = $query->paginate($perPage); // Gunakan paginate() untuk membagi data sesuai dengan halaman dan jumlah per halaman

            return response()->json([
                'draw' => $request->input('draw'), // Ambil nomor draw dari permintaan
                'recordsTotal' => $totalRecords, // Kirim jumlah total data
                'recordsFiltered' => $totalRecords, // Jumlah data yang difilter sama dengan jumlah total
                'data' => $data->items(), // Kirim data yang sesuai dengan halaman dan jumlah per halaman
            ]);
        }

        return view('admin.users.index', [
            'aktif' => User::where('is_deleted', '1')->count(),
            'nonaktif' => User::where('is_deleted', '0')->count(),
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username',
            'level' => 'required|max:255',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah terdaftar, silakan gunakan username lain.',
            'level.required' => 'Status Pengguna wajib diisi.',
        ]);

        $users = Auth::user();
        $validated['password'] = '12345678';
        $validated['created_at'] = Carbon::now();
        $validated['created_by'] = $users->id;
        $validated['is_deleted'] = '1';

        User::create($validated);

        return redirect()->route('data-user.index')->with('success', 'Selamat ! Anda berhasil menambahkan data !');
    }

    public function edit($id)
    {
        $users = User::where('id', $id)->first();
        return view('admin.users.edit', [
            'users' => $users,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username',
            'level' => 'required|max:255',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah terdaftar, silakan gunakan username lain.',
            'level.required' => 'Status Pengguna wajib diisi.',
        ]);

        $users = Auth::user();
        $validated['password'] = '12345678';
        $validated['updated_at'] = Carbon::now();
        $validated['updated_by'] = $users->id;
        $validated['is_deleted'] = '1';

        User::where('id', $id)->update($validated);

        return redirect()->route('data-user.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data !');
    }

    public function destroy($id)
    {
        $users = Auth::user();
        $validated['deleted_at'] = Carbon::now();
        $validated['deleted_by'] = $users->id;
        $validated['is_deleted'] = '0';

        User::where('id', $id)->update($validated);

        return redirect()->route('data-user.index')->with('success', 'Selamat ! Anda berhasil menghapus data !');
    }
}
