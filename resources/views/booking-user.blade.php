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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/lanriicon.png') }}" rel="icon" type="image/png">

    <!-- Custom Styles -->
    <style>
        .logo-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 110px;
        }

        .logo-right {
            max-width: 70px;
        }

        .logo-left {
            max-width: 90px;
        }

        .bg-white-transparent {
            background-color: rgba(255, 255, 255, 0.5);
            padding: 30px;
            max-width: 900px;
            backdrop-filter: blur(2px);
        }

        .rounded-custom {
            border-radius: 12px;
        }

        .no-shadow {
            box-shadow: none;
        }

        .text-center h1 {
            color: #000;
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.7);
            font-weight: bold;
            font-size: 25px;
        }

        .form-label {
            font-size: 1.1rem;
            color: #000;
        }

        .btn-primary {
            padding: 12px 24px;
            font-size: 1.1rem;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .bg-white-transparent {
                max-width: 100%;
                padding: 20px;
            }
        }
    </style>
</head>

<body style="background-image: url('/img/assets/lan2.jpg'); background-size: cover; background-position: center;">
    <div class="min-vh-100 d-flex align-items-center justify-content-center">
        <div class="w-100 bg-white-transparent rounded-custom no-shadow">
            <!-- Wrapper untuk logo kiri, tengah, dan kanan -->
            <div class="logo-container">
                <div class="left">
                    <img src="/img/lanrinobg.png" class="logo logo-center">
                </div>
                <div class="right">
                    <img src="/img/Picture1.png" class="logo logo-left">
                    <img src="/img/HIMATEKKOM 2.png" class="logo logo-right">
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success border-left-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="text-center mb-3">
                <h1 class="h4 font-weight-bold">Reservasi Ruangan Gedung - B</h1>
            </div>

            <!-- Mulai form reservasi -->
            <form action="{{ route('booking-user.store') }}" method="POST">
                @csrf
                <div class="col-lg order-lg-1">
                    <div class="row" style="margin-bottom: 50px;">
                        <div class="col-lg-6">
                            <div class="row"></div>
                            <div class="form-group focused ">
                                <label class="form-control-label" for="tanggal"
                                    style="font-size: 16px; font-weight:700;">Tanggal</label>
                                <input type="date" id="tanggal" class="form-control" name="tanggal"
                                    style="height: 50px;" placeholder="Select tanggal">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="lantai"
                                    style="font-size: 16px; font-weight:700;">Lantai</label>
                                <select id="lantai" class="form-control" name="lantai" style="height: 50px;">
                                    <option value="">Pilih lantai</option>
                                    <option value="1">Lantai 1</option>
                                    <option value="2">Lantai 2</option>
                                    <option value="3">Lantai 3</option>
                                    <option value="4">Lantai 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="ruangan_id"
                                    style="font-size: 16px; font-weight:700;">Ruangan</label>
                                <select id="nama_ruangan" class="form-control" name="ruangan_id" style="height: 50px;">
                                    <option value="">Pilih Ruangan</option>
                                    @foreach ($ruangans as $ruangan)
                                        <option value="{{ $ruangan->id }}" data-lantai="{{ $ruangan->lantai }}"
                                            {{ $ruanganDipilih && $ruanganDipilih->id == $ruangan->id ? 'selected' : '' }}>
                                            {{ $ruangan->nama_ruangan }} ( {{ $ruangan->kapasitas_ruangan }} orang )
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="waktu_pemakaian"
                                    style="font-size: 16px; font-weight:700;">Waktu</label>
                                <select id="waktu_pemakaian" class="form-control" name="waktu_pemakaian"
                                    style="height: 50px;">
                                    <option value="">Pilih waktu</option>
                                    @php
                                        use App\Models\Booking; // Impor namespace lengkap model Booking

                                        $ruanganId = old('ruangan_id'); // Ambil ID ruangan yang dipilih jika ada
                                        $tanggal = old('tanggal'); // Ambil tanggal jika ada
                                        // Ambil data booking untuk ruangan dan tanggal yang sama
                                        $existingBookings = Booking::where('ruangan_id', $ruanganId)
                                            ->where('tanggal', $tanggal)
                                            ->get();
                                        $usedTimes = [];

                                        foreach ($existingBookings as $booking) {
                                            $usedTimes[] =
                                                $booking->waktu_pemakaian_awal . '-' . $booking->waktu_pemakaian_akhir;
                                        }
                                    @endphp
                                    <option value="09:00-12:00"
                                        {{ in_array('09:00-12:00', $usedTimes) ? 'disabled style=color:red;' : '' }}>
                                        09:00:00-12:00:00</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group focused ">
                                <label class="form-control-label" for="nama_pengunjung"
                                    style="font-size: 16px; font-weight:700;">Nama Pengunjung</label>
                                <input type="text" id="nama_pengunjung" class="form-control"
                                    name="nama_pengunjung" style="height: 50px;" placeholder="Masukkan pengunjung">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group focused ">
                                <label class="form-control-label" for="kontak_pengunjung"
                                    style="font-size: 16px; font-weight:700;">Kontak Pengunjung</label>
                                <input type="text" id="kontak_pengunjung" class="form-control"
                                    name="kontak_pengunjung" style="height: 50px;" placeholder="Masukkan Kontak">
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('lantai').addEventListener('change', function() {
                        var selectedLantai = this.value;
                        var ruanganOptions = document.getElementById('nama_ruangan').options;

                        // Loop through ruangan options and display only those that match the selected lantai
                        for (var i = 0; i < ruanganOptions.length; i++) {
                            var option = ruanganOptions[i];
                            var ruanganLantai = option.getAttribute('data-lantai');

                            if (ruanganLantai === selectedLantai || selectedLantai === "") {
                                option.style.display = ''; // Show option
                            } else {
                                option.style.display = 'none'; // Hide option
                            }
                        }
                    });

                    var ruanganDipilih = @json($ruanganDipilih);
                    var ruangans = @json($ruangans);

                    document.getElementById('tanggal').addEventListener('change', updateWaktuPemakaian);
                    document.getElementById('nama_ruangan').addEventListener('change', updateWaktuPemakaian);

                    function cekIdRuangan() {
                        if (ruanganDipilih) {
                            // Cari ruangan yang cocok berdasarkan id
                            var selectedRuangan = ruangans.find(function(ruangan) {
                                return ruangan.id === ruanganDipilih.id;
                            });

                            // Jika ruangan ditemukan, ubah nilai input
                            if (selectedRuangan) {
                                // Mengisi input tanggal dan nama ruangan
                                document.getElementById('tanggal').value = ''; // Sesuaikan dengan nilai yang diinginkan
                                document.getElementById('nama_ruangan').value = selectedRuangan.id; // Set ID ruangan

                                // Jika ingin juga mengisi lantai
                                var lantaiSelect = document.getElementById('lantai');
                                lantaiSelect.value = selectedRuangan.lantai; // Set lantai yang sesuai
                            }
                        }
                    }

                    function updateWaktuPemakaian() {
                        var tanggal = document.getElementById('tanggal').value;
                        var ruanganId = document.getElementById('nama_ruangan').value;

                        // Hanya fetch data jika tanggal dan ruangan dipilih
                        if (tanggal && ruanganId) {
                            fetch(`/check-booking?ruangan_id=${ruanganId}&tanggal=${tanggal}`)
                                .then(response => response.json())
                                .then(data => {
                                    var waktuPemakaianSelect = document.getElementById('waktu_pemakaian');
                                    waktuPemakaianSelect.innerHTML = ''; // Kosongkan pilihan yang ada

                                    // Cek apakah jumlah ruangan tersedia lebih besar dari booking hari ini
                                    if (data.jumlahTersedia > data.jumlahBookingHariIni) {

                                        // Tampilkan semua opsi waktu
                                        var availableTimes = ['09:00:00-16:00:00'];
                                        availableTimes.forEach(function(timeSlot) {
                                            var option = document.createElement('option');
                                            option.value = timeSlot;
                                            option.text = timeSlot;
                                            // Disable jika waktu sudah dipakai
                                            waktuPemakaianSelect.appendChild(option);

                                        });
                                    } else {
                                        // Jika ruangan sudah penuh, tampilkan pesan
                                        var messageOption = document.createElement('option');
                                        messageOption.text = 'Hari ini sudah dibooking penuh';
                                        messageOption.disabled = true; // Tidak bisa dipilih
                                        messageOption.style.color = 'red'; // Beri warna merah pada teks
                                        waktuPemakaianSelect.appendChild(messageOption);
                                    }
                                })
                                .catch(error => console.error('Error fetching booking data:', error));
                        }
                    }

                    window.onload = cekIdRuangan();
                </script>


                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and Popper -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html
