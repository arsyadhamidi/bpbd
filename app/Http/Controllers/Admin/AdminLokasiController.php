<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLokasiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $perPage = $request->input('length', 10);
            $search = $request->input('search', '');

            $query = Lokasi::where('is_deleted', '1');
            $query->orderBy('id', 'desc');

            if ($search) {
                $query->where(function ($query) use ($search) {
                    $query->Where('nama_lokasi', 'LIKE', "%{$search}%");
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

        return view('admin.lokasi.index', [
            'aktif' => Lokasi::where('is_deleted', '1')->count(),
            'nonaktif' => Lokasi::where('is_deleted', '0')->count(),
        ]);
    }

    public function create()
    {

        return view('admin.lokasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lokasi' => 'required|max:255',
        ], [
            'nama_lokasi.required' => 'Nama Lokasi wajib diisi.',
        ]);

        $users = Auth::user();
        $validated['created_at'] = Carbon::now();
        $validated['created_by'] = $users->id;
        $validated['is_deleted'] = '1';

        Lokasi::create($validated);

        return redirect()->route('data-lokasi.index')->with('success', 'Selamat ! Anda berhasil menambahkan data !');
    }

    public function edit($id)
    {
        $lokasis = Lokasi::where('id', $id)->first();
        return view('admin.lokasi.edit', [
            'lokasis' => $lokasis,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_lokasi' => 'required|max:255',
        ], [
            'nama_lokasi.required' => 'Nama Lokasi wajib diisi.',
        ]);

        $users = Auth::user();
        $validated['updated_at'] = Carbon::now();
        $validated['updated_by'] = $users->id;
        $validated['is_deleted'] = '1';

        Lokasi::where('id', $id)->update($validated);

        return redirect()->route('data-lokasi.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data !');
    }

    public function destroy($id)
    {
        $users = Auth::user();
        $validated['deleted_at'] = Carbon::now();
        $validated['deleted_by'] = $users->id;
        $validated['is_deleted'] = '0';

        Lokasi::where('id', $id)->update($validated);

        return redirect()->route('data-lokasi.index')->with('success', 'Selamat ! Anda berhasil menghapus data !');
    }
}
