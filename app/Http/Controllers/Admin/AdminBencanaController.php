<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Lokasi;
use App\Models\Bencana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminBencanaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $perPage = $request->input('length', 10);
            $search = $request->input('search', '');

            $query = Bencana::with('lokasi')->where('is_deleted', '1');
            $query->orderBy('id', 'desc');

            if ($search) {
                $query->where(function ($query) use ($search) {
                    $query->Where('nama_bencana', 'LIKE', "%{$search}%")
                    ->orWhere('tanggal', 'LIKE', "%{$search}%")
                    ->orWhere('penyabab', 'LIKE', "%{$search}%")
                    ->orWhere('keterangan', 'LIKE', "%{$search}%")
                    ->orWhere('latitude', 'LIKE', "%{$search}%")
                    ->orWhere('longitude', 'LIKE', "%{$search}%");
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

        return view('admin.bencana.index', [
            'aktif' => Bencana::where('is_deleted', '1')->count(),
            'nonaktif' => Bencana::where('is_deleted', '0')->count(),
        ]);
    }

    public function create()
    {
        $lokasis = Lokasi::where('is_deleted', '1')->orderBy('id', 'desc')->get();
        return view('admin.bencana.create', [
            'lokasis' => $lokasis,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lokasi_id' => 'required|max:255',
            'nama_bencana' => 'required|max:255',
            'tanggal' => 'required|date',
            'penyebab' => 'required|max:500',
            'keterangan' => 'required|max:500',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
        ], [
            'lokasi_id.required' => 'Lokasi wajib diisi.',
            'nama_bencana.required' => 'Nama bencana wajib diisi.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'penyebab.required' => 'Penyebab wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'latitude.required' => 'Latitude wajib diisi.',
            'longitude.required' => 'Longitude wajib diisi.',
        ]);

        $users = Auth::user();
        $validated['created_at'] = Carbon::now();
        $validated['created_by'] = $users->id;
        $validated['is_deleted'] = '1';

        Bencana::create($validated);

        return redirect()->route('data-bencana.index')->with('success', 'Selamat ! Anda berhasil menambahkan data !');
    }

    public function edit($id)
    {
        $lokasis = Lokasi::where('is_deleted', '1')->orderBy('id', 'desc')->get();
        $bencanas = Bencana::where('id', $id)->first();
        return view('admin.bencana.edit', [
            'bencanas' => $bencanas,
            'lokasis' => $lokasis,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'lokasi_id' => 'required|max:255',
            'nama_bencana' => 'required|max:255',
            'tanggal' => 'required|date',
            'penyebab' => 'required|max:500',
            'keterangan' => 'required|max:500',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
        ], [
            'lokasi_id.required' => 'Lokasi wajib diisi.',
            'nama_bencana.required' => 'Nama bencana wajib diisi.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'penyebab.required' => 'Penyebab wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'latitude.required' => 'Latitude wajib diisi.',
            'longitude.required' => 'Longitude wajib diisi.',
        ]);

        $users = Auth::user();
        $validated['updated_at'] = Carbon::now();
        $validated['updated_by'] = $users->id;
        $validated['is_deleted'] = '1';

        Bencana::where('id', $id)->update($validated);

        return redirect()->route('data-bencana.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data !');
    }

    public function destroy($id)
    {
        $users = Auth::user();
        $validated['deleted_at'] = Carbon::now();
        $validated['deleted_by'] = $users->id;
        $validated['is_deleted'] = '0';

        Bencana::where('id', $id)->update($validated);

        return redirect()->route('data-bencana.index')->with('success', 'Selamat ! Anda berhasil menghapus data !');
    }
}
