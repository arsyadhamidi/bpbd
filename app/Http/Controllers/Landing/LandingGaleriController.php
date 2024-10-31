<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\GaleriBencana;
use Illuminate\Http\Request;

class LandingGaleriController extends Controller
{
    public function index()
    {
        $galeris = GaleriBencana::where('is_deleted', '1')->get();
        return view("landing.galeri.index", [
            'galeris' => $galeris,
        ]);
    }

    public function show($id)
    {
        $galeris = GaleriBencana::where('id', $id)->first();
        return view('landing.galeri.show', [
            'galeris' => $galeris,
        ]);
    }
}
