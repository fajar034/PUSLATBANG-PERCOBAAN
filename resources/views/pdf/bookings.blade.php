<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
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

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f6f7;
            color: #2c3e50;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .table-title {
            background-color: #3498db;
            color: white;
            padding: 10px;
            font-size: 1.2em;
            text-align: center;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9em;
            color: #7f8c8d;
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
    </style>
</head>

<body>

    <h1>Data Booking Ruangan</h1>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Ruangan</th>
                <th>Nama Pengunjung</th>
                <th>Waktu Pemakaian</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->tanggal }}</td>
                    <td>{{ $booking->ruangan ? $booking->ruangan->nama_ruangan : 'Tidak ada ruangan' }}</td>
                    <td>{{ $booking->nama_pengunjung }}</td>
                    <td>{{ $booking->waktu_pemakaian_awal }} - {{ $booking->waktu_pemakaian_akhir }}</td>
                    <td class="status-{{ strtolower($booking->status) }}">{{ ucfirst($booking->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ date('d-m-Y') }}
    </div>

</body>

</html>
