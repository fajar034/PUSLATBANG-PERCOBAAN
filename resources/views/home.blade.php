@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    {{-- @dd($bulananChart, $harianChart); --}}

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

    <div class="row">

        <div class="col-lg-8 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Booking</h6>
                    <div>
                        <a href="{{ route('home.preview') }}" class="btn btn-sm btn-danger">Preview Pdf</a>
                        <a href="{{ route('home.download') }}" class="btn btn-sm btn-danger"> <i
                                class="fa-solid fa-file-pdf"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg order-lg-1">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
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
                                                        <td>{{ $booking->ruangan ? $booking->ruangan->nama_ruangan : 'Tidak ada ruangan' }}
                                                        </td>
                                                        <td>{{ $booking->nama_pengunjung }}</td>
                                                        <td>{{ $booking->waktu_pemakaian_awal }} -
                                                            {{ $booking->waktu_pemakaian_akhir }}</td>

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
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">

            <!-- Chart Bulanan -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pemakaian Ruangan Bulanan</h6>
                </div>
                <div class="card-body">
                    {!! $bulananChart->container() !!}
                </div>
            </div>


            <!-- Chart Harian -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pemakaian Ruangan Mingguan</h6>
                </div>
                <div class="card-body">
                    {!! $harianChart->container() !!}
                </div>

            </div>
        </div>
    </div>

    <script src="{{ $bulananChart->cdn() }}"></script>
    <script src="{{ $harianChart->cdn() }}"></script>

    {{ $bulananChart->script() }}
    {{ $harianChart->script() }}
@endsection
