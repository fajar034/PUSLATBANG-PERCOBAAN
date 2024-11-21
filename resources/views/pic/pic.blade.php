@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('PIC') }}</h1>

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
                        <a href="{{ route('pic.add') }}" class="btn btn-primary">Tambah PIC</a>
                    </div>
                        
                        <div class="card">
                            <div class="card-body">
                                <h6 class="heading-small text-muted mb-4">Daftar PIC</h6>
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Nomor Telepon</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pics as $pic)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $pic->nama_pic }}</td>
                                                    <td>{{ $pic->no_telepon }}</td>
                                                    <td>
                                                        <a href="{{ route('pic.edit', $pic->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                        <form action="{{ route('pic.destroy', $pic->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?');">

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

                </div>

            </div>
        </div>
    </div>

@endsection
