<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::orderBy('lantai', 'asc')->get();

        return view('landingpage.landing', compact('ruangans'));
    }
}
