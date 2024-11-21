<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
    <style>
        body {
            background-image: url('/img/assets/lan2.jpg'); /* Ganti dengan path gambar latar belakang Anda */
            background-size: cover;
            background-position: center;
            font-family: 'Nunito', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Menggunakan seluruh tinggi viewport */
            margin: 0;
        }
        .container {
            max-width: 600px;
            width: 100%; /* Memastikan lebar penuh pada ukuran kecil */
        }
        .kuitansi {
            background: rgba(255, 255, 255, 0.9); /* Menambahkan transparansi untuk lebih elegan */
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: left; /* Mengubah teks menjadi rata kiri */
        }
        .header {
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 20px;
            text-align: center; /* Mengubah teks menjadi rata tengah */
        }
        .details {
            margin-bottom: 20px;
            font-size: 16px;
        }
        .details strong {
            color: #007bff;
        }
        .contact-info {
            margin-bottom: 20px; /* Mengurangi jarak antara nama PIC dan kontak PIC */
        }
        .contact-info p {
            margin: 5px 0; /* Mengatur jarak vertikal antara nama PIC dan kontak PIC */
        }
        .btn-container {
            text-align: center; /* Mengatur tombol kembali agar berada di tengah */
            margin-top: 20px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .screenshot-info {
            margin-top: 20px;
            font-size: 14px;
            color: red; /* Mengubah warna teks menjadi merah */
            font-style: italic; /* Membuat teks menjadi miring */
            text-align: center; /* Memusatkan teks */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="kuitansi">
            <h1 class="header">Kuitansi Reservasi</h1>

            <div class="details">
                <p>Booking atas nama: <strong>{{ $booking->nama_pengunjung }}</strong></p>
                <p>Ruangan: <strong>{{ $booking->ruangan->nama_ruangan }}</strong></p>
                <p>Lantai: <strong>{{ $booking->ruangan->lantai }}</strong></p>
                <p>Waktu Penggunaan: <strong>{{ $booking->waktu_pemakaian_awal }} - {{ $booking->waktu_pemakaian_akhir }}</strong></p>
            </div>

            <h5>Untuk mengonfirmasi pesanan Anda, dapat menghubungi:</h5>
            <div class="contact-info">
                <p><strong>Nama PIC:</strong> {{ $picName }}</p>
                <p><strong>Kontak PIC:</strong> {{ $picContact }}</p>
            </div>

            <div class="btn-container">
                <a href="{{ route('booking-user.create') }}" class="btn-custom">Kembali</a>
            </div>

            <div class="screenshot-info">
                <p>Screenshoot Halaman Ini Untuk Bukti Reservasi.</p>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS and Popper -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
