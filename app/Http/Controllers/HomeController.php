<?php

namespace App\Http\Controllers;

use App\Charts\PemakaianBulananChart;
use App\Charts\PemakaianHarianChart;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(PemakaianBulananChart $bulananChart, PemakaianHarianChart $harianChart)
    {
        $bulananChart = $bulananChart->build();
        $harianChart = $harianChart->build(); // Mengambil data dari chart harian
        $users = User::count();
        $bookings = Booking::where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->get();

        $widget = [
            'users' => $users,
            //...
        ];

        return view('home', compact('widget', 'bookings', 'bulananChart', 'harianChart'));
    }

    public function preview_pdf()
    {
        $bookings = Booking::where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->get();
        $pdf = Pdf::loadView('pdf.bookings', ['bookings' => $bookings]);

        return $pdf->stream('Data Booking.pdf');
    }

    public function download_pdf()
    {
        $bookings = Booking::where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->get();
        $pdf = Pdf::loadView('pdf.bookings', ['bookings' => $bookings]);

        return $pdf->download('Data Booking.pdf');
    }
}
