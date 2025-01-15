<?php

namespace App\Http\Controllers\RuanganUser;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil parameter 'order' dari query string atau default 'asc'
        $order = $request->query('order', 'asc');

        // Ambil data ruangan berdasarkan harga dan lantai
        $ruangans = Ruangan::orderBy('harga', $order)
            ->orderBy('lantai', 'asc')
            ->get();

        // Ambil harga unik (contoh 3 harga yang berbeda)
        $hargaUnik = Ruangan::select('harga')->distinct()->take(3)->pluck('harga');

        // Kirim data ke view
        return view('ruangan-user.ruangan-user', compact('ruangans', 'hargaUnik', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
