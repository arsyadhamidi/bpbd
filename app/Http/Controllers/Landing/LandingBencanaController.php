<?php

namespace App\Http\Controllers\Landing;

use App\Models\Lokasi;
use App\Models\Bencana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingBencanaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $perPage = $request->input('length', 10);
            $search = $request->input('search', '');

            $query = Bencana::with('lokasi')->where('is_deleted', '1');
            $query->orderBy('id', 'desc');

            if ($request->has('lokasi_id') && !empty($request->lokasi_id)) {
                $query->where('lokasi_id', $request->lokasi_id);
            }

            if ($request->has('start_date') && $request->has('end_date')) {
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                $query->whereBetween('tanggal', [$start_date, $end_date]);
            }

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

        $lokasis = Lokasi::where('is_deleted', '1')->get();

        return view('landing.bencana.index', [
            'lokasis' => $lokasis,
        ]);
    }
}
