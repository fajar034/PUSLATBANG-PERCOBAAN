<?php

namespace App\Charts;

use App\Models\Booking;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PemakaianBulananChart
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
        $namaBulan = date('F', mktime(0, 0, 0, $bulan, 10)); // Mengambil nama bulan

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

            // Hitung total pemakaian untuk ruangan tertentu dalam bulan ini
            $totalPemakaian = Booking::where('ruangan_id', $booking->ruangan_id)
                ->where('status', 'booked')
                ->whereYear('tanggal', $tahun) // Filter untuk tahun yang sesuai
                ->whereMonth('tanggal', $bulan) // Filter untuk bulan yang sesuai
                ->count();

            // Tambahkan data total pemakaian per ruangan ke dalam chart
            $chartData[] = [
                'name' => $ruanganNama, // Nama ruangan untuk label
                'total' => $totalPemakaian // Total pemakaian selama sebulan
            ];
        }

        // Membuat diagram batang (BarChart)
        $chart = $this->chart->barChart()
        ->setTitle("Pemakaian Ruangan $namaBulan")
        ->setHeight(320)
        ->setXAxis(array_column($chartData, 'name')) // Mengambil nama ruangan untuk X-axis

        // Menambahkan data total pemakaian per ruangan ke chart
        ->addData('Total Pemakaian', array_column($chartData, 'total'));

        return $chart;
    }
}
