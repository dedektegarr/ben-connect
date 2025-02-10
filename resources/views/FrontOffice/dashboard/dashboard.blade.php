<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BEN CONNECT @yield('title')- BEN CONNECT PROVINSI BENGKULU </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('assets/FrontOffice/dashboard/images/favicon.png') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="stylesheet"
        href="{{ asset('assets/FrontOffice/dashboard/vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/FrontOffice/dashboard/vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    <link href="{{ asset('assets/FrontOffice/dashboard/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/FrontOffice/dashboard/css/style.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.min.css" rel="stylesheet">
    <style>
        /* From Uiverse.io by Mhyar-nsi */
        .btn-rumah {
            background-color: #f3f7fe;
            color: #000;
            border: none;
            cursor: pointer;
            border-radius: 14px;
            width: 80%;
            height: 45px;
            transition: 0.3s;
            padding: 10px 0px 0px 0px;
            margin: 0 auto;
            display: block;
        }

        .btn-rumah:hover {
            background-color: rgb(14, 119, 87);
            color: #000;
        }
    </style>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{ route('index') }}" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('assets/FrontOffice/img/favicon.png') }}" alt="">
                <img class="logo-compact" src="{{ asset('assets/FrontOffice/img/logo2.png') }}" alt="">
                <img class="brand-title" src="{{ asset('assets/FrontOffice/img/logo2.png') }}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <!-- <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('index') }}">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('kesehatan.dashboard') }}">Dataset</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('syarat') }}">Syarat & Ketentuan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('tentang') }}">Tentang Kami</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('opd') }}">Data OPD</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://diskominfotik.bengkuluprov.go.id/kontak/"
                                    target="_blank">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <a class="btn btn-sm btn-outline-success float-right"
                        href="{{ route('feedback') }}">Help/Feedback</a>
                </nav> -->
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav text-dark">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Halaman Awal</li>
                    <li><a href="{{ route('beranda.dashboard') }}" aria-expanded="false"><i
                                class="ri-layout-line"></i><span class="nav-text">Dashboard</span></a>
                    </li>

                    <li class="nav-label first">Katalog Data</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ri-hospital-line"></i><span class="nav-text">Kesehatan</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('kesehatan.dashboard') }}">Rekap Data
                                    Kesehatan</a></li>
                            <li><a href="{{ route('index') }}">Rekap Data Rumah Sakit</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ri-school-line"></i><span class="nav-text">Pendidikan</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('pendidikan.dashboard') }}">Rekap Data Pendidikan</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ri-team-line"></i><span class="nav-text">Sosial</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('sosial.dashboard') }}">Rekap Data Sosial</a></li>
                            <li><a href="{{ route('kependudukan.dashboard') }}">Rekap Data Kependudukan</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ri-road-map-line"></i><span class="nav-text">Infrastruktur</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('infrastruktur-jalan.dashboard') }}">Rekap Data Jalan</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ri-earthquake-line"></i><span class="nav-text">Kebencanaan</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('bencana.dashboard') }}">Rekap Data Bencana</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ri-store-3-line"></i><span class="nav-text">Komoditas</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('komoditas.dashboard') }}">Rekap Data Komoditas</a></li>
                        </ul>
                    </li>

                    <a class="btn btn-rumah" href="{{ route('index') }}" aria-expanded="false">
                        <i class="ri-home-line"></i><span class="nav-text "> Home</span></a>

                </ul>


            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        @yield('main')


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">BEN CONNECT BENGKULU</a>
                    2025</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->

    <!-- Required vendors -->
    <script src="{{ asset('assets/FrontOffice/dashboard/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets/FrontOffice/dashboard/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('assets/FrontOffice/dashboard/js/custom.min.js') }}"></script>


    <!-- Vectormap -->
    <script src="{{ asset('assets/FrontOffice/dashboard/vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/FrontOffice/dashboard/vendor/morris/morris.min.js') }}"></script>


    <script src="{{ asset('assets/FrontOffice/dashboard/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/FrontOffice/dashboard/vendor/chart.js/Chart.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/FrontOffice/dashboard/vendor/gaugeJS/dist/gauge.min.js') }}"></script>

    <!--  flot-chart js -->
    <script src="{{ asset('assets/FrontOffice/dashboard/vendor/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/FrontOffice/dashboard/vendor/flot/jquery.flot.resize.js') }}"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('assets/FrontOffice/dashboard/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>

    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({

            });
        });
    </script>
    <!-- Counter Up -->
    <script src="{{ asset('assets/FrontOffice/dashboard/vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/FrontOffice/dashboard/vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('assets/FrontOffice/dashboard/vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>


    <script src="{{ asset('assets/FrontOffice/dashboard/js/dashboard/dashboard-1.js') }}"></script>

</body>

</html>
