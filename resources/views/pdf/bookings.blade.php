<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        .kop-surat {
            text-align: center;
            font-weight: bold;
            line-height: 1.5;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop-surat .alamat {
            font-size: 0.9em;
            color: #555;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f6f7;
            color: #2c3e50;
        }
        .status-booked {
            color: green;
            font-weight: bold;
        }
        .status-pending {
            color: orange;
            font-weight: bold;
        }
        .status-canceled {
            color: red;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9em;
            color: #7f8c8d;
        }
    </style>
</head>
<body>

    <div class="kop-surat">
        LEMBAGA ADMINISTRASI NEGARA REPUBLIK INDONESIA<br>
        PUSAT PELATIHAN DAN PENGEMBANGAN DAN KAJIAN HUKUM ADMINISTRASI NEGARA<br>
        <div class="alamat">
            Jalan Dr. Mr. Teuku Muhammad Hasan, Kec. Darul Imarah, Kab. Aceh Besar 23352<br>
            Tlp. 0651-8010900; Fax. 0651-7552568; Website: aceh.lan.go.id; Email: puslatbang.khan@lan.go.id
        </div>
    </div>

    <h1>Invoice Booking Ruangan</h1>

    <table>
    @foreach ($bookings as $booking)
        <tr>
            <th>Tanggal</th>
            <td>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</td>
        </tr>
        <tr>
            <th>Nama Ruangan</th>
            <td>{{ $booking->ruangan ? $booking->ruangan->nama_ruangan : 'Tidak ada ruangan' }}</td>
        </tr>
        <tr>
            <th>Nama Pengunjung</th>
            <td>{{ $booking->nama_pengunjung }}</td>
        </tr>
        <tr>
            <th>Waktu Pemakaian</th>
            <td>{{ $booking->waktu_pemakaian_awal }} - {{ $booking->waktu_pemakaian_akhir }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td class="status-{{ strtolower($booking->status) }}">{{ ucfirst($booking->status) }}</td>
        </tr>
        @endforeach
    </table>

    <div class="footer">
        Dicetak pada: {{ date('d-m-Y') }}
    </div>

</body>
</html>
