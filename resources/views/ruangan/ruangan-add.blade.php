@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('RUANGAN') }}</h1>

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

                    <form method="POST" action="{{ route('ruangan.store') }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">Informasi RUANGAN</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="nama_ruangan">Nama Ruangan<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="nama_ruangan" class="form-control" name="nama_ruangan"
                                            placeholder="" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="lantai">Lantai<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="lantai" class="form-control" name="lantai"
                                            placeholder="" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="kapasitas_ruangan">Kapasitas Ruangan<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="kapasitas_ruangan" class="form-control"
                                            name="kapasitas_ruangan" placeholder="" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="pic_id">PIC<span
                                                class="small text-danger">*</span></label>
                                        <select id="pic_id" class="form-control" name="pic_id">
                                            <option value="">Pilih PIC </option>
                                            @foreach ($pics as $pic)
                                                <option value="{{ $pic->id }}">{{ $pic->nama_pic }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="jumlah">Jumlah<span
                                                class="small text-danger">*</span></label>
                                        <input type="number" id="jumlah" name="jumlah" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="image">image<span
                                                class="small text-danger">*</span></label>
                                        <input type="file" id="image" name="image">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-success">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
