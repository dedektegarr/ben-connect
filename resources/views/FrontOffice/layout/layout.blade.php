<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>BEN CONNECT - @yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Favicons -->
    <link href="{{ asset('assets/FrontOffice/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/FrontOffice/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/FrontOffice/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/FrontOffice/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/FrontOffice/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/FrontOffice/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/FrontOffice/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/FrontOffice/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/FrontOffice/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/FrontOffice/css/custom.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo"><img src="{{ asset('assets/FrontOffice/img/logo.png') }}"
                    alt="" class="img-fluid"></a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto {{ Route::is('index') ? 'active' : '' }}"
                            href="{{ route('index') }}">Beranda</a>
                    </li>
                    <li><a class="nav-link scrollto" href="{{ route('pendidikan.dashboard') }}">Dataset</a></li>
                    <li><a class="nav-link scrollto {{ Route::is('syarat') ? 'active' : '' }}"
                            href="{{ route('syarat') }}">Syarat & Ketentuan</a></li>
                    <li><a class="nav-link scrollto {{ Route::is('tentang') ? 'active' : '' }}"
                            href="{{ route('tentang') }}">Tentang Kami</a></li>
                    <li><a class="nav-link scrollto {{ Route::is('opd') ? 'active' : '' }}"
                            href="{{ route('opd') }}">Data OPD</a></li>
                    <li><a class="nav-link scrollto" href="https://diskominfotik.bengkuluprov.go.id/kontak/"
                            target="_blank">Kontak</a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link" href="{{ route('feedback') }}">
                            <button class="btn btn-success">Help/Feedback</button>
                        </a>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    @yield('main')

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top" style="background-color:#028C45;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-6 footer-contact">
                        <img src="{{ asset('assets/FrontOffice/img/footer.png') }}" alt="" class="img-fluid">
                        <ul class="list-group list-group-horizontal mt-4">
                            <li class="list-group-item border-0 bg-transparent">
                                <a href="#" class="text-dark fw-bold text-white"
                                    style="font-family: inter;">Beranda</a>
                            </li>
                            <li class="list-group-item border-0 bg-transparent">
                                <a href="#" class="text-dark fw-bold text-white"
                                    style="font-family: inter;">Layanan</a>
                            </li>
                            <li class="list-group-item border-0 bg-transparent">
                                <a href="#" class="text-dark fw-bold text-white"
                                    style="font-family: inter;">Syarat dan Ketentuan</a>
                            </li>
                            <li class="list-group-item border-0 bg-transparent">
                                <a href="https://diskominfotik.bengkuluprov.go.id/kontak/" target="_blank"
                                    class="text-dark fw-bold text-white" style="font-family: inter;">Contact</a>
                            </li>
                        </ul>
                        <div class="social-links text-md-right mt-4 pt-3 pt-md-0">
                            <a href="https://www.facebook.com/share/sV6XrhYD3gzQpdg4/?mibextid=xfxF2i" target="_blank"
                                class="facebook bg-dark"><i class="bx bxl-facebook"></i></a>
                            <a href="https://www.instagram.com/diskominfotikbengkulu?igsh=MWFhZXpyamo0amVtcg=="
                                target="_blank" class="instagram bg-dark"><i class="bx bxl-instagram"></i></a>
                            <a href="https://youtube.com/@kominfoprovbengkuluchannel6809?si=C0fi1F5UDO1gSWZz"
                                target="_blank" class="google-plus bg-dark"><i class="bx bxl-youtube"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links text-white">
                        <h4 class="text-white">Punya Pertanyaan ?</h4>
                        <p>Ajukan Pertanyaanmu dengan mengklik tombol dibawah ini!</p>
                        <a class="btn btn-light">Ajukan Sekarang <i class="ri-arrow-right-line"></i></a>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="float-end">
                            <p class="float-end text-white">© 2024 BEN Connect All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/FrontOffice/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/FrontOffice/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/FrontOffice/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/FrontOffice/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/FrontOffice/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/FrontOffice/js/main.js') }}"></script>

</body>

</html>
