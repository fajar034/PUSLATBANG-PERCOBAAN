@extends('layouts.admin')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('BOOKING') }}</h1>

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

    <div class="row">
        <div class="col-lg order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-body">

                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('booking.add') }}" class="btn btn-primary">Booking Ruangan</a>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">Daftar Booking</h6>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>

                                            <th>Tanggal</th>
                                            <th>Nama Ruangan</th>
                                            <th>Lantai</th>
                                            <th>Nama Pengunjung</th>
                                            <th>Kontak Pengunjung</th>
                                            <th>Waktu Pemakaian</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $booking)
                                            <tr>
                                                <td>{{ $booking->tanggal }}</td>
                                                <td>{{ $booking->ruangan ? $booking->ruangan->nama_ruangan : 'Tidak ada ruangan' }}
                                                </td>
                                                <td>{{ $booking->ruangan ? $booking->ruangan->lantai : 'Tidak ada lantai' }}
                                                </td>
                                                <td>{{ $booking->nama_pengunjung }}</td>
                                                <td>{{ $booking->kontak_pengunjung }}</td>
                                                <td>{{ $booking->waktu_pemakaian_awal }}-{{ $booking->waktu_pemakaian_akhir }}
                                                </td>
                                                @php
                                                    $class = '';
                                                    if ($booking->status == 'pending') {
                                                        $class = 'badge bg-warning';
                                                    } elseif ($booking->status == 'booked') {
                                                        $class = 'badge bg-success';
                                                    } elseif ($booking->status == 'canceled') {
                                                        $class = 'badge bg-danger';
                                                    }
                                                @endphp

                                                <td>
                                                    <span class="{{ $class }}" style="color: white;">
                                                        {{ ucfirst($booking->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($booking->status === 'pending')
                                                    <a href="{{ route('booking.edit', $booking->id) }}"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    @endif
                                                    <form action="{{ route('booking.destroy', $booking->id) }}"
                                                        method="POST" style="display:inline-block;"
                                                        onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Card Riwayat Booking (Confirmed & Canceled) -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3>Riwayat Booking</h3>
                        </div>
                        <div class="card-body">
                            @if($confirmedBookings->isEmpty())
                                <p>Tidak ada riwayat booking yang dikonfirmasi atau dibatalkan.</p>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Pengguna</th>
                                            <th>Tanggal Booking</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($confirmedBookings as $index => $booking)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $booking->nama_pengunjung }}</td>
                                            <td>{{ $booking->tanggal }}</td>
                                            <td>{{ $booking->status_changed_at ? $booking->status_changed_at->format('d-m-Y H:i') : 'Belum ada perubahan' }}</td>
                                            <td>
                                                @if($booking->status == 'booked')
                                                    <span class="badge badge-success">Booked</span>
                                                @else
                                                    <span class="badge badge-danger">Canceled</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Optional action buttons -->
                                                <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-info btn-sm">Detail</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
