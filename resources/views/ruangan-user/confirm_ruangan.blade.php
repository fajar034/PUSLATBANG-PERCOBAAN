<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://kit.fontawesome.com/a076d05399.css" rel="stylesheet">
    <style>
        /* Styles here */
    </style>
</head>

<body>
    <a href="javascript:history.back()" class="back-button" title="Back">&larr;</a>
    
    @foreach ($ruangans as $ruangan)
    <div class="container">
        <img src="{{ asset('storage/ruangan/' . $ruangan->image) }}" alt="{{ $ruangan->nama_ruangan }}" class="room-image">
        <div class="room-details">
            <div class="room-header">
                <h1>{{ $ruangan->nama_ruangan }}</h1>
                <span class="price">Rp {{ number_format($ruangan->harga_per_jam, 0, ',', '.') }}/Jam</span>
            </div>
            <div class="description">
                <h2>Deskripsi</h2>
                <p>{{ $ruangan->deskripsi }}</p>
            </div>
            <div class="facilities">
                <h2>Fasilitas</h2>
                <ul>
                    <li>Ruangan Bebas Rokok</li>
                    <li>WiFi Gratis</li>
                    <li>Parkir Gratis</li>
                    <li>Ruangan Ber-AC</li>
                </ul>
            </div>
            <div class="contact">
                <i class="fa fa-whatsapp"></i>
                <span>{{ $ruangan->kontak }}</span>
            </div>
            <a href="{{ route('booking-user.create', $ruangan->id) }}" class="booking-button">BOOKING</a>
        </div>
    </div>
    @endforeach

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>
