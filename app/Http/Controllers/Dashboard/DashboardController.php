<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Bencana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $bencanas = Bencana::where('is_deleted', '1')->get(); // Ambil semua data bencana
        return view('dashboard.main.index', [
            'bencanas' => $bencanas,
        ]);
    }
}
