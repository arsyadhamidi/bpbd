<?php

namespace App\Http\Controllers\Landing;

use App\Models\Bencana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function index()
    {
        $bencanas = Bencana::where('is_deleted', '1')->get();
        return view("landing.main.index", [
            'bencanas' => $bencanas,
        ]);
    }
}
