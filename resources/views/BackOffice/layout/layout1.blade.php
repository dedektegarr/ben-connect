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
        .header {
            position: relative;
            /* Untuk positioning anak di dalam header */
        }

        /* Membatasi lebar dropdown */
        .dropdown-menu {
            position: absolute;
            top: 50px;
            /* Jarak dari atas header, bisa sesuaikan */
            right: 0;
            /* Menjaga dropdown berada di sisi kanan tombol */
            z-index: 1050;
            /* Pastikan dropdown berada di atas elemen lain */
            max-width: 100%;
            /* Memastikan dropdown tidak melebihi lebar layar */
            overflow-x: auto;
            /* Menambahkan scroll horizontal jika dropdown terlalu lebar */
        }

        .dropdown-menu-end {
            right: 0 !important;
            /* Pastikan dropdown berada di sisi kanan */
        }

        /* Membatasi lebar item dalam dropdown */
        .dropdown-item {
            white-space: nowrap;
            /* Menjaga item dropdown dalam satu baris */
            overflow: hidden;
            text-overflow: ellipsis;
            /* Menambahkan tanda ellipsis (...) jika teks terlalu panjang */
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
            <div class="header-content d-flex justify-content-end align-items-center">
                <!-- Dropdown User -->
                <div class="dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="userDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/BackOffice/img/user.jpg') }}" alt="User Avatar" width="35"
                            height="35" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <a href="javascript:void(0)" class="dropdown-item disabled">
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                            <i class="ri-user-line"></i>
                            <p class="mb-0 ml-2">My Profile</p>
                        </a>
                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                            <i class="ri-settings-2-line"></i>
                            <p class="mb-0 ml-2">Settings</p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item"
                            onclick="document.getElementById('logout-form').submit();">
                            <i class="ri-logout-box-line"></i>
                            <p class="mb-0 ml-2">Logout</p>
                        </a>
                    </div>
                </div>
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
                    <li class="nav-label first"><b>Data Master</b></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ri-database-line"></i><span class="nav-text">Data Master</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('/admin/infrastruktur') }}">Data Wilayah</a></li>
                            <li><a href="{{ url('/admin/infrastruktur') }}">Kategori Rumah Sakit</a></li>
                            <li><a href="{{ url('/admin/infrastruktur') }}">Jenis Akreditasi Rumah Sakit</a></li>
                            <li><a href="{{ url('/admin/infrastruktur') }}">Kepemilikan Rumah Sakit</a></li>
                        </ul>
                    </li>
                    <li class="nav-label first">User</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ri-user-line"></i><span class="nav-text">Data User</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('/admin/user') }}">User OPD</a></li>
                            <li><a href="{{ url('/admin/user_role') }}">Data Role</a></li>
                        </ul>
                    </li>

                    <li class="nav-label first">Katalog Data</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ri-hospital-line"></i><span class="nav-text">Kesehatan</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('/admin/datarumahsakit') }}">Data Rumah Sakit</a></li>
                            <li><a href="{{ url('/admin/rsud') }}">RSUD</a></li>
                            <li><a href="{{ url('/admin/indexrumahsakit') }}">Index Rumah Sakit</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ri-school-line"></i><span class="nav-text">Pendidikan</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('pendidikan.dashboard') }}">Data Sekolah</a></li>
                            <li><a href="{{ route('pendidikan.dashboard') }}">Jenjang Pendidikan</a></li>
                            <li><a href="{{ route('pendidikan.dashboard') }}">Index Pendidikan Masyarakat</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ri-team-line"></i><span class="nav-text">Sosial</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('sosial.dashboard') }}">Kategori Sosial</a></li>
                            <li><a href="{{ route('kependudukan.dashboard') }}">Data Sosial</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ri-road-map-line"></i><span class="nav-text">Infrastruktur</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('infrastruktur-jalan.dashboard') }}">Kategori Jalan</a></li>
                            <li><a href="{{ route('infrastruktur-jalan.dashboard') }}">Jalan</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ri-earthquake-line"></i><span class="nav-text">Kebencanaan</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('bencana.dashboard') }}">Rekap Data Bencana</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ri-shopping-basket-line"></i><span class="nav-text">Perdagangan</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('komoditas.dashboard') }}">Jenis Barang</a></li>
                            <li><a href="{{ route('komoditas.dashboard') }}">Harga Barang</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="ri-store-3-line"></i><span class="nav-text">Perindustrian</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('komoditas.dashboard') }}">Data IKM</a></li>
                            <li><a href="{{ route('komoditas.dashboard') }}">Industri Besar</a></li>
                            <li><a href="{{ route('komoditas.dashboard') }}">Industri Kecil</a></li>
                        </ul>
                    </li>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({

            });
        });
    </script>


</body>

</html>
