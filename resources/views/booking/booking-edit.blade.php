@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4  text-gray-800" style="font-size: 28px; font-weight:600;">{{ __('Reservasi Ruangan Gedung - B') }}
    </h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-lg order-lg-1">

        <div class="card shadow mb-4">

            <div class="row">
                <div class="card-body">

                    <form method="POST" action="{{ route('booking.update', $booking->id) }}" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <h6 class="heading-small text-muted mb-4">Informasi BOOKING</h6>

                        <div class="col-lg order-lg-1">
                            <div class="row" style="margin-bottom: 50px;">
                                <div class="col-lg-6">
                                    <div class="row"></div>
                                    <div class="form-group focused ">
                                        <label class="form-control-label" for="tanggal"
                                            style="font-size: 24px; font-weight:400;">Tanggal</label>
                                        <input type="date" id="tanggal" class="form-control" name="tanggal"
                                            style="height: 50px;" value="{{ $booking->tanggal }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused ">
                                        <label class="form-control-label" for="lantai"
                                            style="font-size: 24px; font-weight:400;">Lantai</label>
                                        <select id="lantai" class="form-control" name="lantai" style="height: 50px;">
                                            <option value="">Pilih lantai</option>
                                            @php
                                                $selectedLantai = $booking->ruangan ? $booking->ruangan->lantai : '';
                                            @endphp
                                            <option value="1" {{ $selectedLantai == 1 ? 'selected' : '' }}>Lantai 1
                                            </option>
                                            <option value="2" {{ $selectedLantai == 2 ? 'selected' : '' }}>Lantai 2
                                            </option>
                                            <option value="3" {{ $selectedLantai == 3 ? 'selected' : '' }}>Lantai 3
                                            </option>
                                            <option value="4" {{ $selectedLantai == 4 ? 'selected' : '' }}>Lantai 4
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused ">
                                        <label class="form-control-label" for="ruangan_id"
                                            style="font-size: 24px; font-weight:400;">Ruangan</label>
                                        <select id="nama_ruangan" class="form-control" name="ruangan_id"
                                            style="height: 50px;">
                                            <option value="">Pilih Ruangan</option>
                                            @foreach ($ruangans as $ruangan)
                                                <option value="{{ $ruangan->id }}" data-lantai="{{ $ruangan->lantai }}"
                                                    {{ $booking->ruangan_id == $ruangan->id ? 'selected' : '' }}>
                                                    {{ $ruangan->nama_ruangan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="waktu_pemakaian"
                                            style="font-size: 24px; font-weight:400;">Waktu</label>
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
                                                        $booking->waktu_pemakaian_awal .
                                                        '-' .
                                                        $booking->waktu_pemakaian_akhir;
                                                }
                                            @endphp
                                            <option value="09:00:00-16:00:00"
                                                {{ old('waktu_pemakaian_awal') && old('waktu_pemakaian_akhir') ? (old('waktu_pemakaian_awal') . '-' . old('waktu_pemakaian_akhir') == '09:00:00-16:00:00' ? 'selected' : '') : ($booking->waktu_pemakaian_awal . '-' . $booking->waktu_pemakaian_akhir == '09:00:00-16:00:00' ? 'selected' : '') }}>
                                                09:00:00-16:00:00
                                            </option>


                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused ">
                                        <label class="form-control-label" for="nama_pengunjung"
                                            style="font-size: 24px; font-weight:400;">Nama Pengunjung</label>
                                        <input type="text" id="nama_pengunjung" class="form-control"
                                            name="nama_pengunjung" style="height: 50px;" placeholder="Masukkan pengunjung"
                                            value="{{ $booking->nama_pengunjung }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused ">
                                        <label class="form-control-label" for="kontak_pengunjung"
                                            style="font-size: 24px; font-weight:400;">Kontak Pengunjung</label>
                                        <input type="text" id="kontak_pengunjung" class="form-control"
                                            name="kontak_pengunjung" style="height: 50px;" placeholder="Masukkan Kontak"
                                            value="{{ $booking->kontak_pengunjung }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="status"
                                            style="font-size: 24px; font-weight:400;">Status</label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="statusBooked" name="status"
                                                class="custom-control-input" value="booked"
                                                {{ $booking->status == 'booked' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="statusBooked">
                                                Booked <i class="fas fa-check-circle" style="color: green;"></i>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="statusCanceled" name="status"
                                                class="custom-control-input" value="canceled"
                                                {{ $booking->status == 'canceled' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="statusCanceled">
                                                Canceled <i class="fas fa-times-circle" style="color: red;"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- Button -->
                            <div class="pl-lg-4" style="margin-top: 30px">
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-success">Tambah</button>
                                    </div>
                                </div>
                            </div>
                    </form>
                    <script>
                        document.getElementById('lantai').addEventListener('change', function() {
                            var selectedLantai = this.value;
                            var ruanganOptions = document.getElementById('nama_ruangan').options;

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


                        document.getElementById('tanggal').addEventListener('change', updateWaktuPemakaian);
                        document.getElementById('nama_ruangan').addEventListener('change', updateWaktuPemakaian);

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
                    </script>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
