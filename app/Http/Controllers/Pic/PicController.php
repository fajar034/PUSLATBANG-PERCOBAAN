<?php

namespace App\Http\Controllers\Pic;

use App\Http\Controllers\Controller;
use App\Models\Pic;
use Illuminate\Http\Request;

class PicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pics = Pic::all();
        return view('pic.pic', compact('pics'));
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
        $request->validate([
            'nama_pic' => 'required|string|max:255', 
            'no_telepon' => 'required|digits_between:10,15'
        ],[
            'nama_pic.required' => 'Nama wajib diisi',
            'nama_pic.string' => 'Nama harus berupa teks',
            'nama_pic.max' => 'Nama tidak boleh lebih dari 255 karakter',

            'no_telepon.required' => 'Nomor telepon wajib diisi',
            'no_telepon.digits_between' => 'Nomor telepon harus terdiri dari 10 hingga 15 digit angka'
        ]);

         // Simpan data ke database
        $pic = new Pic();
        $pic->nama_pic = $request->nama_pic;
        $pic->no_telepon = $request->no_telepon;

        $pic->save(); 


        return redirect()->route('pic.index')->with('success', 'data berhasil disimpan!');
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
        $pic = Pic::findOrFail($id); // Mengambil data PIC berdasarkan id
        return view('pic.pic-edit', compact('pic')); // Mengirim data PIC ke view 'pic.edit'
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_pic' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
        ]);
    
        $pic = Pic::findOrFail($id);
        $pic->nama_pic = $request->nama_pic;
        $pic->no_telepon = $request->no_telepon;
        $pic->save();
    
        return redirect()->route('pic.index')->with('success', 'Data PIC berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pic = Pic::findOrFail($id);
        $pic->delete();

        return redirect()->route('pic.index')->with('success', 'Data PIC berhasil dihapus!');
    }
}
