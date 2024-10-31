<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Models\GaleriBencana;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminGaleriBencanaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $perPage = $request->input('length', 10);
            $search = $request->input('search', '');

            $query = GaleriBencana::with('lokasi')->where('is_deleted', '1');
            $query->orderBy('id', 'desc');

            if ($search) {
                $query->where(function ($query) use ($search) {
                    $query->Where('nama_bencana', 'LIKE', "%{$search}%")
                        ->orWhere('keterangan', 'LIKE', "%{$search}%");
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

        return view('admin.galeri.index', [
            'aktif' => GaleriBencana::where('is_deleted', '1')->count(),
            'nonaktif' => GaleriBencana::where('is_deleted', '0')->count(),
        ]);
    }

    public function create()
    {
        $lokasis = Lokasi::where('is_deleted', '1')->orderBy('id', 'desc')->get();
        return view('admin.galeri.create', [
            'lokasis' => $lokasis,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lokasi_id' => 'required|max:255',
            'nama_bencana' => 'required|max:255',
            'keterangan' => 'required|max:500',
            'foto_bencana' => 'required|mimes:png,jpg,jpeg|max:10248',
        ], [
            'lokasi_id.required' => 'Lokasi wajib diisi.',
            'nama_bencana.required' => 'Nama bencana wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'foto_bencana.required' => 'Foto bencana wajib diunggah.',
            'foto_bencana.mimes' => 'Foto bencana harus berupa file bertipe: png, jpg, jpeg.',
            'foto_bencana.max' => 'Ukuran foto bencana tidak boleh lebih dari 10 MB.',
        ]);

        if ($request->file('foto_bencana')) {
            $validated['foto_bencana'] = $request->file('foto_bencana')->store('foto_bencana');
        } else {
            $validated['foto_bencana'] = null;
        }

        $users = Auth::user();
        $validated['created_at'] = Carbon::now();
        $validated['created_by'] = $users->id;
        $validated['is_deleted'] = '1';

        GaleriBencana::create($validated);

        return redirect()->route('data-galeri.index')->with('success', 'Selamat ! Anda berhasil menambahkan data !');
    }

    public function edit($id)
    {
        $lokasis = Lokasi::where('is_deleted', '1')->orderBy('id', 'desc')->get();
        $galeris = GaleriBencana::where('id', $id)->first();
        return view('admin.galeri.edit', [
            'lokasis' => $lokasis,
            'galeris' => $galeris,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'lokasi_id' => 'required|max:255',
            'nama_bencana' => 'required|max:255',
            'keterangan' => 'required|max:500',
            'foto_bencana' => 'nullable|mimes:png,jpg,jpeg|max:10248',
        ], [
            'lokasi_id.required' => 'Lokasi wajib diisi.',
            'nama_bencana.required' => 'Nama bencana wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'foto_bencana.mimes' => 'Foto bencana harus berupa file bertipe: png, jpg, jpeg.',
            'foto_bencana.max' => 'Ukuran foto bencana tidak boleh lebih dari 10 MB.',
        ]);

        $galeri = GaleriBencana::findOrFail($id);

        if ($request->file('foto_bencana')) {
            // Hapus foto lama jika ada
            if ($galeri->foto_bencana) {
                Storage::delete($galeri->foto_bencana);
            }
            // Simpan foto baru
            $validated['foto_bencana'] = $request->file('foto_bencana')->store('foto_bencana');
        }

        $users = Auth::user();
        $validated['updated_at'] = Carbon::now();
        $validated['updated_by'] = $users->id;

        $galeri->update($validated);

        return redirect()->route('data-galeri.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $users = Auth::user();
        $galeri = GaleriBencana::findOrFail($id);

        $galeri->update([
            'deleted_at' => Carbon::now(),
            'deleted_by' => $users->id,
            'is_deleted' => '0'
        ]);

        return redirect()->route('data-galeri.index')->with('success', 'Data berhasil dihapus!');
    }
}
