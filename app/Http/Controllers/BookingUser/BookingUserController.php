<?php

namespace App\Http\Controllers\BookingUser;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Pic;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class BookingUserController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id = null)
    {   
        // Jika ada ID yang diberikan, ambil data ruangan untuk ditampilkan di form
        $ruanganDipilih = null;

        if ($id) {
            $ruanganDipilih = Ruangan::findOrFail($id);
        }

        $ruangans = Ruangan::all();
        return view("booking-user", compact('ruangans', 'ruanganDipilih'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'ruangan_id' => 'required|exists:ruangan,id',
            'waktu_pemakaian' => 'required',
            'nama_pengunjung' => 'required|string|max:255',
            'kontak_pengunjung' => 'required|string|max:255',
        ]);

        // Pisahkan waktu awal dan akhir
        $waktuPemakaian = explode('-', $request->input('waktu_pemakaian'));
        $waktuPemakaianAwal = $waktuPemakaian[0];
        $waktuPemakaianAkhir = $waktuPemakaian[1];
        
        // Simpan data ke dalam database
        $booking = new Booking();
        $booking->ruangan_id = $request->input('ruangan_id');
        $booking->nama_pengunjung = $request->input('nama_pengunjung');
        $booking->kontak_pengunjung = $request->input('kontak_pengunjung');
        // Simpan waktu pemakaian
        $booking->waktu_pemakaian_awal = $waktuPemakaianAwal;
        $booking->waktu_pemakaian_akhir = $waktuPemakaianAkhir;
        $booking->tanggal = $request->input('tanggal');
        // Simpan ke database
        $booking->save();

        $pic = $booking->ruangan->pic;
        $picName = $pic->nama_pic; // Ambil nama PIC
        $picContact = $pic->no_telepon;

        return view('booking-user-kuitansi', [
            'booking' => $booking,
            'picName' => $picName,
            'picContact' => $picContact,
        ]);
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

    public function checkBooking(Request $request)
    {
        $ruanganId = $request->input('ruangan_id');
        $tanggal = $request->input('tanggal');

        // Hitung berapa kali ruangan tersebut telah dibooking pada hari itu
        $jumlahBookingHariIni = Booking::where('ruangan_id', $ruanganId)
            ->where('tanggal', $tanggal)
            ->whereIn('status', ['booked', 'pending'])
            ->count();

        $jumlahTersedia = Ruangan::where('id', $ruanganId)->value('jumlah');


        return response()->json([
            'jumlahBookingHariIni' => $jumlahBookingHariIni,
            'jumlahTersedia' => $jumlahTersedia
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
