<?php

namespace App\Charts;

use App\Models\Booking;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PemakaianHarianChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $tahun = date('Y');
        $bulan = date('m');
        $chartData = [];
        $tanggalMulai = now()->subDays(6)->format('d-M-Y'); // Tanggal mulai
        $tanggalAkhir = now()->format('d-M-Y'); // Tanggal akhir

        // Ambil daftar ruangan unik dari tabel booking
        $ruanganList = Booking::select('ruangan_id') // Ambil ruangan_id dari tabel booking
            ->distinct()
            ->with('ruangan')
            ->where('status', 'booked')
            ->whereYear('tanggal', $tahun) // Filter untuk tahun yang sesuai
            ->whereMonth('tanggal', $bulan) // Filter untuk bulan yang sesuai
            ->get();

        // Loop untuk setiap ruangan
        foreach ($ruanganList as $booking) {
            $ruanganNama = $booking->ruangan->nama_ruangan; // Ambil nama ruangan melalui relasi

            // Hitung total pemakaian untuk ruangan tertentu dalam 7 hari terakhir
            $totalPemakaian = Booking::where('ruangan_id', $booking->ruangan_id)
                ->where('status', 'booked')
                ->whereDate('tanggal', '>=', now()->subDays(6)) // Filter untuk 7 hari terakhir
                ->count();

            // Tambahkan data total pemakaian per ruangan ke dalam chart
            $chartData[] = [
                'name' => $ruanganNama, // Nama ruangan untuk label
                'total' => $totalPemakaian // Total pemakaian selama 7 hari terakhir
            ];
        }

        // Membuat diagram batang (BarChart)
        $chart = $this->chart->barChart()
            ->setTitle("Pemakaian Ruangan $tanggalMulai - $tanggalAkhir")
            ->setHeight(320)
            ->setXAxis(array_column($chartData, 'name')) // Mengambil nama ruangan untuk X-axis

            // Menambahkan data total pemakaian per ruangan ke chart
            ->addData('Total Pemakaian', array_column($chartData, 'total')); // Menambahkan total pemakaian untuk semua ruangan

        return $chart;
    }
}
