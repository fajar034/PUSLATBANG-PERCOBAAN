<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
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
        $bookings = Booking::orderBy('tanggal', 'asc')->get();
        $ruangans = Ruangan::all();

        return view('booking.booking', compact('bookings', 'ruangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ruangans = Ruangan::all();
        // Anda bisa menginisialisasi $bookings di sini jika perlu
        return view('booking.booking-add', compact('ruangans'));
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

        return redirect()->route('booking.index')->with('success', 'Reservasi berhasil ditambahkan');
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
        $booking = Booking::findOrFail($id);
        $ruangans = Ruangan::all();
        return view('booking.booking-edit', compact('booking', 'ruangans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'ruangan_id' => 'required|exists:ruangan,id',
            'waktu_pemakaian' => 'required',
            'nama_pengunjung' => 'required|string|max:255',
            'kontak_pengunjung' => 'required|string|max:255',
            'status' => 'required'
        ]);

        // Pisahkan waktu awal dan akhir
        $waktuPemakaian = explode('-', $request->input('waktu_pemakaian'));
        $waktuPemakaianAwal = $waktuPemakaian[0];
        $waktuPemakaianAkhir = $waktuPemakaian[1];

        // Simpan data ke dalam database
        $booking = Booking::findOrFail($id);
        $booking->ruangan_id = $request->input('ruangan_id');
        $booking->nama_pengunjung = $request->input('nama_pengunjung');
        $booking->kontak_pengunjung = $request->input('kontak_pengunjung');
        // Simpan waktu pemakaian
        $booking->waktu_pemakaian_awal = $waktuPemakaianAwal;
        $booking->waktu_pemakaian_akhir = $waktuPemakaianAkhir;
        $booking->status = $request->input('status');
        $booking->tanggal = $request->input('tanggal');
        // Simpan ke database
        $booking->save();

        return redirect()->route('booking.index')->with('success', 'Reservasi berhasil diedit');
    }


    public function checkBooking(Request $request)
    {
        $ruanganId = $request->input('ruangan_id');
        $tanggal = $request->input('tanggal');

        $existingBookings = Booking::where('ruangan_id', $ruanganId)
            ->where('tanggal', $tanggal)
            ->get();

        $usedTimes = [];
        foreach ($existingBookings as $booking) {
            $usedTimes[] = $booking->waktu_pemakaian_awal . '-' . $booking->waktu_pemakaian_akhir;
        }

        return response()->json(['usedTimes' => $usedTimes]);
    }

    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Data Booking berhasil dihapus!');
    }
}
