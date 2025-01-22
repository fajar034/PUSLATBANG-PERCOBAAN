<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://kit.fontawesome.com/a076d05399.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .room-image {
            width: 100%;
            height: auto;
        }

        .room-details {
            padding: 20px;
        }

        .room-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .room-header h1 {
            font-size: 24px;
            margin: 0;
        }

        .description h2,
        .facilities h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .description p {
            margin: 0 0 20px;
            color: #333;
            line-height: 1.5;
        }

        .facilities ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .facilities ul li {
            margin-bottom: 8px;
            color: #555;
            font-size: 16px;
        }

        .contact {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .contact i {
            font-size: 20px;
            color: #25d366;
            margin-right: 10px;
        }

        .contact span {
            font-size: 16px;
            color: #333;
        }

        .booking-button {
            display: block;
            text-align: center;
            background-color: #007bff;
            color: #fff;
            padding: 10px 0;
            margin-top: 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
        }

        .booking-button:hover {
            background-color: #0056b3;
        }

        .back-button {
            display: inline-block;
            margin: 20px;
            font-size: 20px;
            text-decoration: none;
            color: #007bff;
        }

        .back-button:hover {
            text-decoration: underline;
        }
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
