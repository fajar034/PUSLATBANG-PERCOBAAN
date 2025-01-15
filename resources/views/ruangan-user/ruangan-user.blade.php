<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('img/lanriicon.png') }}" rel="icon" type="image/png">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Tambahkan Font Awesome CDN untuk ikon -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Roboto', sans-serif;
            color: #333;
        }

        .container {
            max-width: 1200px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }

        .container label {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 0.25rem;
            margin-bottom: 0;
        }

        .container label i {
            display: flex;
        }

        .container label p {
            line-height: 100%;
            font-size: 1rem;
        }

        /*.container label p {
            font-size: 1rem;
            border: 2px solid black;
        }*/

        .container select {
            padding: 0.5em;
            color: #fff;
            background-color: #007bff;
            border: 1px solid #007bff;
        }

        .container .select option {
            color: #333;
            background-color: #fff;
        }

        .margin {
            margin: 1rem 0;
        }

        .card {
            margin-bottom: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .room-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .room-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            padding: 15px;
        }

        .floor-header {
            margin-top: 20px;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border-radius: 8px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        h1 {
            color: #000;
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.7);
            font-weight: bold;
            font-size: 30px;
        }

        h2 {
            font-size: 20px;
        }

        @media (max-width: 767px) {
            h1 {
                font-size: 20px;
            }

            h2 {
                font-size: 16px;
            }

            h5 {
                font-size: 16px;
            }
        }

        .back-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            font-size: 22px;
        }

        .back-btn:hover {
            background-color: rgba(0, 4, 255, 0.8);
        }

        .back-btn i {
            color: white;
        }
    </style>
</head>

<body class="bg-light text-dark py-5"
    style="background-image: url('/img/assets/lan2.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">

    <!-- Tombol Kembali -->
    <a href="javascript:history.back()" class="back-btn" title="Kembali">
        <i class="fa-solid fa-arrow-left"></i>
    </a>

    <div class="container">
        <h1 class="mb-4 text-center">DAFTAR RUANGAN</h1>

        <!-- (BARU) Form Filter dan Pengurutan Harga -->
        <form method="GET" action="/ruangan-user" class="mb-4">
            <label for="order"><i class="fa-solid fa-arrow-down-short-wide"></i><p>Urutan</p></label>
            <select name="order" value="fajar" id="order" onchange="this.form.submit()" class="select rounded">
                <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Harga Terendah</option>
                <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Harga Tertinggi</option>
            </select>
        </form>

        <!-- (BARU), jangan dihapus, jika perlu digunakan
        <div class="mb-4">
            <h4>Contoh Harga:</h4>
            <ul>
                @foreach($hargaUnik as $harga)
                    <li>IDR {{ number_format($harga, 0, ',', '.') }}</li>
                @endforeach
            </ul>
        </div> -->

        @php
        $currentFloor = null;
        @endphp

        @foreach ($ruangans as $ruangan)
        @if ($currentFloor !== $ruangan->lantai)
        @php
        $currentFloor = $ruangan->lantai;
        @endphp
        <!-- Header Lantai -->
        <div class="floor-header rounded">
            <h2 class="mb-0">Lantai {{ $ruangan->lantai }}</h2>
        </div>
        <div class="row">
            @endif
            <!-- (BARU) Daftar ruangan dalam grid per lantai -->
            <div class="col-lg-4 col-md-6 col-sm-12 margin border">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/ruangan/' . $ruangan->image) }}" class="room-image"
                        alt="{{ $ruangan->nama_ruangan }}">
                    <div class="room-body">
                        <h5 class="card-title">{{ $ruangan->nama_ruangan }}</h5>
                        <p class="card-text text-muted">Kapasitas: {{ $ruangan->kapasitas_ruangan }} orang</p>
                        <p class="card-text text-success">IDR {{ number_format($ruangan->harga, 0, ',', '.') }}</p>
                        <a href="{{ route('booking-user.create', $ruangan->id) }}" class="btn btn-primary">Booking</a>
                    </div>
                </div>
            </div>
            @if ($loop->last || $ruangans[$loop->index + 1]->lantai !== $ruangan->lantai)
        </div> <!-- Akhiri .row jika lantai berbeda atau terakhir -->
        @endif
        @endforeach
    </div>

    <!-- JS Files -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
