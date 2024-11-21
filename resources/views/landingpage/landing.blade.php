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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/lanriicon.png') }}" rel="icon" type="image/png">

    <style>
        /* Navbar */
        .navbar-custom {
            background-color: rgba(82, 92, 101, 0.8);
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            transition: background-color 0.5s ease;
        }

        .navbar-custom.navbar-scrolled {
            background-color: rgba(82, 92, 101, 1);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .navbar-nav .nav-link {
            color: #ffffff;
            font-weight: bold;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #ffcb47;
        }

        /* Card */
        .card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
        }

        .card:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.3);
            background: rgba(255, 255, 255, 0.3);
        }

        .card-body h2 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #060606;
            transition: color 0.3s;
        }

        .card:hover .card-body h2 {
            color: #ffcb47;
        }

        .card i {
            color: #525c65;
            transition: color 0.3s, transform 0.3s;
        }

        .card:hover i {
            color: #ffcb47;
            transform: scale(1.2);
        }

        /* Slideshow */
        .carousel-item img {
            width: 100%;
            height: 90vh;
            object-fit: cover;
            animation: fade-zoom 1.5s ease-in-out;
        }

        .carousel-caption {
            position: absolute;
            bottom: 20%;
            left: 50%;
            transform: translateX(-50%);
            color: #ffffff;
            text-shadow: 0px 4px 10px rgba(0, 0, 0, 0.7);
            font-size: 3rem;
            font-weight: bold;
            text-align: center;
        }

        .carousel-caption p {
            font-size: 1.5rem;
            margin-top: 10px;
        }

        @keyframes fade-zoom {
            0% {
                opacity: 0;
                transform: scale(1.1);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Footer */
        .footer {
            background: linear-gradient(145deg, #343a40, #23272b);
            color: #ffffff;
            padding: 20px 10px;
            box-shadow: inset 2px 2px 10px #1d1f21, inset -2px -2px 10px #3f454b;
        }

        .footer .col img:hover {
            transform: scale(1.1);
            transition: transform 0.3s;
        }
    </style>
</head>

<body>

    <!-- Wrapper -->
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container">
                <a class="navbar-logo" href="#">
                    <img src="{{ url('img/lanrinobg.png') }}" alt="Lan Logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fas fa-bars" style="color: #060606;"></i>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" href="ruangan-user">Ruangan</a></li>
                        <li class="nav-item"><a class="nav-link" href="booking-user">Booking</a></li>
                    </ul>
                </div>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary ml-3">Admin Login</a>
                @endguest
                @auth
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    <a href="{{ route('logout') }}" class="btn btn-primary ml-3"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                @endauth
            </div>
        </nav>

        <!-- Slideshow -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/assets/lan3.jpg') }}" alt="Slide 1">
                    <div class="carousel-caption">
                        <h1>Selamat Datang di Puslatbang Khan LAN RI</h1>
                        <p>Kami berkomitmen untuk memberikan pelayanan terbaik bagi Anda.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/assets/lan2.jpg') }}" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/assets/lan1.jpg') }}" alt="Slide 3">
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

        <!-- Section for Booking -->
        <section class="services py-5">
            <div class="container text-center">
                <h2>PUSLATBANG KHAN LAN RI</h2>
                <h2 class="text-center small text-muted mb-5">BANGGA MELAYANI BANGSA</h2>
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card">
                            <a href="ruangan-user">
                                <i class="fas fa-door-open fa-3x my-4"></i>
                                <div class="card-body">
                                    <h2>Ruangan</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card">
                            <a href="booking-user">
                                <i class="fas fa-calendar-check fa-3x my-4"></i>
                                <div class="card-body">
                                    <h2>Booking</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer text-center">
            <p>&copy; 2024 PUSLATBANG KHAN LAN RI. All rights reserved.</p>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(document).on("scroll", function () {
            if ($(this).scrollTop() > 50) {
                $(".navbar-custom").addClass("navbar-scrolled");
            } else {
                $(".navbar-custom").removeClass("navbar-scrolled");
            }
        });
    </script>
</body>

</html>
