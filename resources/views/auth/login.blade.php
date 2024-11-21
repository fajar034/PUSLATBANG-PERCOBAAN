@extends('layouts.auth')

<style>
.bg-full {
    background-image: url('img/tampakatas.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh; /* Tinggi penuh untuk viewport */
    width: 100vw; /* Lebar penuh untuk viewport */
    display: flex;
    align-items: center;
    justify-content: center;
}

.card {
    background-color: rgba(255, 255, 255, 0.9); /* Warna putih dengan sedikit transparansi */
    border-radius: 10px; /* Sudut melengkung */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Bayangan untuk efek kedalaman */
    width: 100%; /* Mengatur lebar kartu */
    max-width: 500px; /* Maksimal lebar kartu */
}

.logo-card {
    background-image: url('img/lanrinobg.png');
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    height: 200px; /* Tentukan tinggi logo card agar lebih konsisten */
}

.card-body {
    padding: 2rem; /* Padding yang lebih banyak untuk isi kartu */
}

.text-center {
    margin-bottom: 1rem; /* Spasi di bawah judul */
}
</style>

@section('main-content')
<div class="bg-full">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Card untuk Logo dan Form Login -->
                <div class="card my-3">
                    <div class="logo-card"></div>
                    <div class="card-body">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">{{ __('Login') }}</h1>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger border-left-danger" role="alert">
                                <ul class="pl-4 my-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="user">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autofocus>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" name="password" placeholder="{{ __('Password') }}" required>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
