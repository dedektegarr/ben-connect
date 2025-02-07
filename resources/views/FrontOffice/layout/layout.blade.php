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

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

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
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="." class="logo"><img src="{{ asset('assets/FrontOffice/img/logo.png') }}"
                    alt="" class="img-fluid"></a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto {{ Route::is('index') ? 'active' : '' }}"
                            href="{{ route('index') }}">Beranda</a>
                    </li>
                    <li><a class="nav-link scrollto" href="{{ route('beranda.dashboard') }}">Dataset</a></li>
                    <li><a class="nav-link scrollto {{ Route::is('opd') ? 'active' : '' }}"
                            href="{{ route('opd') }}">Data OPD</a></li>
                    <li><a class="nav-link scrollto {{ Route::is('syarat') ? 'active' : '' }}"
                            href="{{ route('syarat') }}">Syarat & Ketentuan</a></li>
                    <li><a class="nav-link scrollto {{ Route::is('tentang') ? 'active' : '' }}"
                            href="{{ route('tentang') }}">Tentang Kami</a></li>

                    <!-- <li><a class="nav-link scrollto" href="https://diskominfotik.bengkuluprov.go.id/kontak/"
                            target="_blank">Kontak</a>
                    </li> -->
                    <li class="dropdown">
                        <a class="nav-link scrollto {{ Route::is('feedback') ? 'active' : '' }}" href="{{ route('feedback') }}">
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
        <div class="footer-top" style="background-color: #27445D;">
            <div class="container">
                <div class="row">
                    <!-- Kolom 1 -->
                    <div class="col-lg-4 col-md-6 footer-contact">
                        <img src="{{ asset('assets/FrontOffice/img/footer.svg') }}" alt="" class="img-fluid" width="250px" height="50px">
                        <ul class="list-group list-group-vertical mt-4">
                            <li class="list-group-item border-0 bg-transparent">
                                <a href="{{ route('index') }}" class="text-dark fw-bold text-white" style="font-family: inter;">Beranda</a>
                            </li>
                            <li class="list-group-item border-0 bg-transparent">
                                <a href="" class="text-dark fw-bold text-white" style="font-family: inter;">Dataset</a>
                            </li>
                            <li class="list-group-item border-0 bg-transparent">
                                <a href="{{ route('opd') }}" class="text-dark fw-bold text-white" style="font-family: inter;">Data OPD</a>
                            </li>
                            <li class="list-group-item border-0 bg-transparent">
                                <a href="{{ route('syarat') }}" class="text-dark fw-bold text-white" style="font-family: inter;">Syarat & Ketentuan</a>
                            </li>
                            <li class="list-group-item border-0 bg-transparent">
                                <a href="{{ route('tentang') }}" class="text-dark fw-bold text-white" style="font-family: inter;">Tentang Kami</a>
                            </li>
                            <li class="list-group-item border-0 bg-transparent">
                                <a href="https://diskominfotik.bengkuluprov.go.id/kontak/" target="_blank" class="text-dark fw-bold text-white" style="font-family: inter;">Kontak</a>
                            </li>
                            <li class="list-group-item border-0 bg-transparent">
                                <a href="{{ route('feedback') }}" class="text-dark fw-bold text-white" style="font-family: inter;">Help/Feedback</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Kolom 2 -->
                    <div class="col-lg-4 col-md-6 footer-links1 text-white">
                        <p style="font-weight: 700; font-size: 20px;">Bengkulu</p>
                        <p>
                            <i class="bx bx-envelope"></i> diskominfotik@bengkuluprov.go.id<br>
                            <i class="bx bx-phone-call"></i> (0736) 7325176
                        </p>
                        <p>
                            <i class="bx bx-location-plus"></i> Jl. Basuki Rahmat No.06 Sawah Lebar Baru, Kecamatan Ratu Agung, Kota Bengkulu, Provinsi Bengkulu 38222
                        </p>
                        <button class="btn-terbaru" onclick="location.href='https://diskominfotik.bengkuluprov.go.id/berita/';">
                            <p>Berita</p>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="4"
                            >
                                <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"
                                ></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Kolom 3 -->
                    <div class="col-lg-4 col-md-12 footer-links text-white">
                                                <br>
                        <br>
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6022.567776063658!2d102.26481517048325!3d-3.794720344379449!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e36b03c0d312e4b%3A0x84a91934db8e4a14!2sDinas%20Kominfo%20dan%20Statistik%20Provinsi%20Bengkulu!5e0!3m2!1sen!2sus!4v1737518435316!5m2!1sen!2sus" 
                            style="border:0; border-radius: 10px;" 
                            allowfullscreen="true" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        <div class="social-links text-md-right mt-2 pt-4 pt-md-3" style="line-height: 5;">
                        <button class="Btn instagram" onclick="location.href='https://www.instagram.com/diskominfotikbengkulu/';">
                            <svg
                            class="svgIcon"
                            viewBox="0 0 448 512"
                            height="1.5em"
                            xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                                d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"
                            ></path>
                            </svg>
                            <span class="text">Instagram</span>
                        </button>

                        <button class="Btn youtube" onclick="location.href='https://diskominfotik.bengkuluprov.go.id/berita/';">
                            <svg
                            class="svgIcon"
                            viewBox="0 0 576 512"
                            height="1.5em"
                            xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                                d="M549.655 148.28c-6.281-23.64-24.041-42.396-47.655-48.685C462.923 85 288 85 288 85S113.077 85 74 99.595c-23.614 6.289-41.374 25.045-47.655 48.685-12.614 47.328-12.614 147.717-12.614 147.717s0 100.39 12.614 147.718c6.281 23.64 24.041 42.396 47.655 48.684C113.077 427 288 427 288 427s174.923 0 214-14.595c23.614-6.289 41.374-25.045 47.655-48.685 12.614-47.328 12.614-147.718 12.614-147.718s0-100.389-12.614-147.717zM240 336V176l144 80-144 80z"
                            ></path>
                            </svg>
                            <span class="text">YouTube</span>
                        </button>

                        <button class="Btn facebook" onclick="location.href='https://diskominfotik.bengkuluprov.go.id/berita/';">
                            <svg
                            class="svgIcon"
                            viewBox="0 0 512 512"
                            height="1.5em"
                            xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                                d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z"
                            ></path>
                            </svg>
                            <span class="text">Facebook</span>
                        </button>
                        </div>
                    </div>
                </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="float-end">
                            <p class="float-end text-white">© 2025 BEN Connect All Rights Reserved.</p>
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
