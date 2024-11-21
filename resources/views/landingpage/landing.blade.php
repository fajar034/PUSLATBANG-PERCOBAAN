<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts and Styles -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/lanriicon.png') }}" rel="icon" type="image/png">

    <style>
        body {
            background-color: white;
        }

        .navbar-custom {
            background-color: transparent;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            transition: background-color 0.5s ease;
        }

        .navbar-custom.navbar-scrolled {
            background-color: #525c65;
        }

        .navbar-logo img {
            height: 50px;
        }

        .navbar-nav .nav-link {
            color: #060606;
            font-weight: bold;
            font-size: 18px;
        }

        .navbar-nav .nav-link:hover {
            color: #ffffff;
        }

        .wrapper {
            margin-top: 0px;

        }

        .footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 1px 10px;
        }

        .footer .container {
            margin-bottom: 10px;
        }

        .carousel-item img {
            width: 100%;
            height: 90vh;
            object-fit: cover;
        }

        .card {
            position: relative;
            /* Agar elemen anak bisa diposisikan relatif */
            overflow: hidden;
            /* Mencegah overflow dari latar belakang */
        }

        .card::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            /* Lebar gradien */
            height: 300%;
            /* Tinggi gradien */
            background-color: #525c65;
            /* Warna background saat hover */
            border-radius: 50%;
            /* Membuat gradien menjadi bulat */
            transform: translate(-50%, -50%) scale(0);
            /* Memusatkan dan menyembunyikan gradien */
            transition: transform 0.9s ease;
            /* Animasi saat hover */
            z-index: 0;
            /* Menempatkan gradien di belakang konten */
        }

        .card:hover::after {
            transform: translate(-50%, -50%) scale(1);
            /* Memperbesar gradien saat hover */
        }

        .card-body {
            position: relative;
            /* Agar konten tetap di atas gradien */
            z-index: 1;
            /* Menempatkan konten di atas gradien */
            transition: color 0.3s ease;
            /* Animasi perubahan warna teks */
        }

        .card:hover .card-body {
            color: #ffffff;
            /* Ubah warna teks menjadi putih saat hover */
        }

        .card:hover i {
            color: #ffffff;
            /* Ubah warna ikon menjadi putih saat hover */
        }

        @media (max-width: 767px) {
            .navbar-logo img {
                height: 40px;
                /* Ukuran logo yang lebih kecil untuk mobile */
            }

            .navbar-custom {
                background-color: #525c65;
                /* Ganti warna navbar pada mobile agar lebih kontras */
            }

            .navbar-toggler {
                border: none;
                outline: none;
            }

            .navbar-toggler-icon {
                font-size: 24px;
            }

            .navbar-nav .nav-link {
                color: white;
                font-size: 16px;
            }

            .navbar-nav .nav-link:hover {
                color: #cccccc;
            }

            .carousel-item img {
                height: 80vh;
            }
        }

        @media (max-width: 426px) {
            .carousel-item img {
                height: 70vh;
            }
        }
    </style>
</head>

<body>

    <!-- Wrapper untuk seluruh halaman -->
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-logo" href="#">
                    <img src="{{ url('img/lanrinobg.png') }}" alt="Lan Logo">
                </a>

                <!-- Button Toggler (untuk mobile view) -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fas fa-bars" style="color: #060606;"></i>
                    </span>
                </button>

                <!-- Center Navbar Links (collapsed in mobile) -->
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="ruangan-user">Ruangan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="booking-user">Booking</a>
                        </li>


                <!-- Tombol Login/Logout -->
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary ml-3">Admin Login</a>
                @endguest

                @auth
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}" class="btn btn-primary ml-3" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                @endauth
            </div>
        </nav>



        <!-- Slideshow -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/assets/lan3.jpg') }}" class="d-block" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/assets/lan2.jpg') }}" class="d-block" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/assets/lan1.jpg') }}" class="d-block" alt="Slide 3">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- Teks Tambahan di Bawah Slideshow -->
        <div class="container text-center my-5">
            <h2 style="border-bottom: 2px solid #000; display: inline-block;">Selamat Datang di Puslatbang Khan LAN RI
            </h2>
            <p>Kami berkomitmen untuk memberikan pelayanan terbaik bagi Anda</p>
        </div>

        <!-- Section for 2 Booking Now Columns -->
        <section class="services py-5">
            <div class="container text-center">
                <h2 style="border-bottom: 2px solid #000; display: inline-block;">PUSLATBANG KHAN LAN RI</h2>
                <h2 class="text-center small text-muted mb-5">BANGGA MELAYANI BANGSA</h2>

                <div class="row">
                    <!-- Card for Room Features -->
                    <div class="col-md-6 mb-4">
                        <a href="{{ route('ruangan-user.index') }}"
                            class="card text-center h-100 text-decoration-none">
                            <div class="card-body">
                                <i class="fas fa-door-open fa-3x mb-3" style="color: #060606;"></i>
                                <!-- Ikon Ruangan -->
                                <h2>Ruangan</h2>
                                <p>Menyediakan Berbagai Macam Ruangan Untuk Kepentingan Anda</p>
                            </div>
                        </a>
                    </div>

                    <!-- Card for Booking Features -->
                    <div class="col-md-6 mb-4">
                        <a href="{{ route('booking-user.store') }}"
                            class="card text-center h-100 text-decoration-none">
                            <div class="card-body">
                                <i class="fas fa-calendar-check fa-3x mb-3" style="color: #060606;"></i>
                                <!-- Ikon Booking -->
                                <h2>Booking</h2>
                                <p>Sewa Ruangan Sesuai dengan Kebutuhan Anda</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer py-1">
            <div class="container">
                <div class="row d-flex align-items-center justify-content-between text-center">
                    <div class="col-auto">
                        <img src="{{ asset('img/Picture1.png') }}" alt="Logo 1" class="img-fluid"
                            style="max-height: 50px; margin-right: 15px;">
                    </div>

                    <div class="col text-muted">
                        <span>&copy; Teknik Komputer USK 21</span>
                    </div>

                    <div class="col-auto">
                        <img src="{{ asset('img/HIMATEKKOM 2.png') }}" alt="Logo 3" class="img-fluid"
                            style="max-height: 50px; margin-left: 15px;">
                    </div>
                </div>
            </div>
        </footer>



        <!-- Scripts -->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Script untuk mengubah warna navbar setelah scroll -->
        <script>
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('.navbar-custom').addClass('navbar-scrolled');
                } else {
                    $('.navbar-custom').removeClass('navbar-scrolled');
                }
            });
        </script>

</body>

</html>
