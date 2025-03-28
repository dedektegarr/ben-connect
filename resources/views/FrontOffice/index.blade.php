@extends('FrontOffice.layout.layout')
@section('title', 'Beranda')
@section('main')
    <style>
        .card-layanan {
            gap: 25px;
            width: 100%;
            display: flex;
            padding: 26px 35px;
            overflow: hidden;
            position: relative;
            box-sizing: border-box;
            align-items: flex-start;
            border-radius: 20px 20px 20px 20px;
            flex-direction: column;
            justify-content: space-between;
            background-color: #fff;
        }

        .card-layanan-frame,
        .card-layanan-frame1,
        .card-layanan1 {
            width: 100%;
            overflow: hidden;
            box-sizing: border-box;
            justify-content: flex-start;
        }

        .card-layanan-frame {
            gap: 6px;
            display: flex;
            position: relative;
            max-width: 250px;
            align-items: center;
        }

        .card-layanan-frame1,
        .card-layanan1 {
            max-width: 48px;
            align-items: flex-start;
            flex-direction: column;
        }

        .card-layanan-frame1 {
            gap: 15px;
            display: flex;
            position: relative;
            max-width: 250px;
        }

        .card-layanan-text,
        .card-layanan-text1 {
            margin-top: 0;
            text-align: left;
            margin-bottom: 0;
        }

        .card-layanan-text {
            width: 100%;
            max-width: 100%;
            min-height: auto;
        }

        .card-layanan-text1 {
            color: #081225;
            font-size: 31px;
            font-style: normal;
            font-family: "Inter", sans-serif;
            font-weight: 800;
            line-height: 37px;
            letter-spacing: 0;
            text-transform: none;
        }

        .card-layanan-text2 {
            width: 100%;
            max-width: 100%;
            margin-top: 0;
            min-height: 74px;
            text-align: left;
            margin-bottom: 0;
        }

        .card-layanan-text3 {
            color: #081225;
            font-size: 16px;
            font-style: normal;
            margin-top: 0;
            text-align: left;
            font-family: "Inter", sans-serif;
            font-weight: 400;
            line-height: 24px;
            margin-bottom: 0;
            letter-spacing: 0;
            text-transform: none;
        }

        .card-layanan-frame2 {
            gap: 10px;
            width: 100%;
            display: flex;
            overflow: hidden;
            position: relative;
            max-width: 250px;
            box-sizing: border-box;
            align-items: flex-start;
            justify-content: flex-start;
        }

        .card-layanan-text4 {
            width: 100%;
            max-width: auto;
            margin-top: 0;
            min-height: auto;
            text-align: left;
            margin-bottom: 0;
        }

        .card-layanan-text5 {
            color: #028c45;
            font-size: 16px;
            font-style: normal;
            margin-top: 0;
            text-align: left;
            font-family: "Inter", sans-serif;
            font-weight: 700;
            line-height: 24px;
            margin-bottom: 0;
            letter-spacing: 0;
            text-transform: none;
        }

        .card-layanan2 {
            width: 100%;
            overflow: hidden;
            max-width: 24px;
            box-sizing: border-box;
            align-items: flex-start;
            flex-direction: column;
            justify-content: flex-start;
        }

        .chart-container {
            display: flex;
            justify-content: center;
            /* Center secara horizontal */
            align-items: center;
            /* Center secara vertikal */
            max-height: 250px;
            height: 100%;
            /* Sesuaikan tinggi div */
        }
    </style>
    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container">
            <h1 class="text-dark text-capitalize" style="font-family: inter; font-weight:900;"><span
                    style="background: -webkit-linear-gradient(left,#028C45, #FCCD00); 
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;">Pusat
                    Data Pelayanan Dasar</span></h1>
            <p class="d-none d-md-block" style="margin-left:200px;
            margin-right:200px;">Akses data pelayanan dasar
                dari berbagai instansi
                pemerintah di Provinsi Bengkulu secara realtime memungkinkan masyarakat untuk mendapatkan informasi yang
                up-to-date mengenai layanan publik yang tersedia. Hal ini mencakup berbagai aspek seperti kesehatan,
                pendidikan, infrastruktur, dan layanan administratif lainnya</p>
            <a href="{{ route('pendidikan.dashboard') }}" class="btn btn-success">Explore <i
                    class="ri-arrow-right-line"></i></a>
        </div>
    </section><!-- End Hero -->

    <main id="main" style="background-image: url('{{ asset('assets/FrontOffice/img/bg.png') }}')">
        <!-- ======= About Section ======= -->
        <section id="about" class="about" style="background-color:transparent">
            <div class="container">
                <style>
                    .card-layanan:hover {
                        box-shadow: 1px 8px 20px grey;
                        -webkit-transition: box-shadow .6s ease-in;
                    }
                </style>
                <div class="row content">
                    <div class="col-md-3 g-3">
                        <div class="g-3">
                            <div class="card-layanan">
                                <div class="card-layanan-frame">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36"
                                        height="36" fill="currentColor">
                                        <path
                                            d="M19 22H5C3.34315 22 2 20.6569 2 19V3C2 2.44772 2.44772 2 3 2H17C17.5523 2 18 2.44772 18 3V15H22V19C22 20.6569 20.6569 22 19 22ZM18 17V19C18 19.5523 18.4477 20 19 20C19.5523 20 20 19.5523 20 19V17H18ZM16 20V4H4V19C4 19.5523 4.44772 20 5 20H16ZM6 7H14V9H6V7ZM6 11H14V13H6V11ZM6 15H11V17H6V15Z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="card-layanan-frame1">
                                    <div class="card-layanan-text">
                                        <h3 class="fw-bold">Kesehatan</h3>
                                    </div>
                                    <div class="card-layanan-text2">
                                        <p class="card-layanan-text3">
                                            Data kesehatan meliputi jumlah puskesmas, tenaga kesehatan dan pasien.
                                        </p>
                                    </div>
                                </div>
                                <div class="card-layanan-frame2">
                                    <div class="card-layanan-text4">
                                        <a href="{{ route('kesehatan.dashboard') }}" class="card-layanan-text5">Detail <i
                                                class="ri-arrow-right-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="g-3">
                            <div class="card-layanan">
                                <div class="card-layanan-frame">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36"
                                        height="36" fill="currentColor">
                                        <path
                                            d="M2 20H22V22H2V20ZM4 12H6V19H4V12ZM9 12H11V19H9V12ZM13 12H15V19H13V12ZM18 12H20V19H18V12ZM2 7L12 2L22 7V11H2V7ZM4 8.23607V9H20V8.23607L12 4.23607L4 8.23607ZM12 8C11.4477 8 11 7.55228 11 7C11 6.44772 11.4477 6 12 6C12.5523 6 13 6.44772 13 7C13 7.55228 12.5523 8 12 8Z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="card-layanan-frame1">
                                    <div class="card-layanan-text">
                                        <h3 class="fw-bold">Sosial</h3>
                                    </div>
                                    <div class="card-layanan-text2">
                                        <p class="card-layanan-text3">
                                            Data Sosial meliputi data Rekap Bengkulu dalam Angka.
                                        </p>
                                    </div>
                                </div>
                                <div class="card-layanan-frame2">
                                    <div class="card-layanan-text4">
                                        <a href="{{ route('sosial.dashboard') }}" class="card-layanan-text5">Detail <i
                                                class="ri-arrow-right-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="g-3">
                            <div class="card-layanan">
                                <div class="card-layanan-frame">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36"
                                        height="36" fill="currentColor">
                                        <path
                                            d="M17 2V4H20.0066C20.5552 4 21 4.44495 21 4.9934V21.0066C21 21.5552 20.5551 22 20.0066 22H3.9934C3.44476 22 3 21.5551 3 21.0066V4.9934C3 4.44476 3.44495 4 3.9934 4H7V2H17ZM7 6H5V20H19V6H17V8H7V6ZM9 16V18H7V16H9ZM9 13V15H7V13H9ZM9 10V12H7V10H9ZM15 4H9V6H15V4Z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="card-layanan-frame1">
                                    <div class="card-layanan-text">
                                        <h3 class="fw-bold">Pendidikan</h3>
                                    </div>
                                    <div class="card-layanan-text2">
                                        <p class="card-layanan-text3">
                                            Data Pendidikan Meliputi Jumlah Sekolah, guru dan siswa.
                                        </p>
                                    </div>
                                </div>
                                <div class="card-layanan-frame2">
                                    <div class="card-layanan-text4">
                                        <a href="{{ route('pendidikan.dashboard') }}" class="card-layanan-text5">Detail <i
                                                class="ri-arrow-right-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan">
                            <div class="card-layanan-frame">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36"
                                    fill="currentColor">
                                    <path
                                        d="M4 6.14286V18.9669L9.06476 16.7963L15.0648 19.7963L20 17.6812V4.85714L21.303 4.2987C21.5569 4.18992 21.8508 4.30749 21.9596 4.56131C21.9862 4.62355 22 4.69056 22 4.75827V19L15 22L9 19L2.69696 21.7013C2.44314 21.8101 2.14921 21.6925 2.04043 21.4387C2.01375 21.3765 2 21.3094 2 21.2417V7L4 6.14286ZM16.2426 11.2426L12 15.4853L7.75736 11.2426C5.41421 8.89949 5.41421 5.10051 7.75736 2.75736C10.1005 0.414214 13.8995 0.414214 16.2426 2.75736C18.5858 5.10051 18.5858 8.89949 16.2426 11.2426ZM12 12.6569L14.8284 9.82843C16.3905 8.26633 16.3905 5.73367 14.8284 4.17157C13.2663 2.60948 10.7337 2.60948 9.17157 4.17157C7.60948 5.73367 7.60948 8.26633 9.17157 9.82843L12 12.6569Z">
                                    </path>
                                </svg>
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">infrastruktur</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Data infrastruktur seperti jalan dan jembatan.
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="#" class="card-layanan-text5">Detail <i
                                            class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End About Section -->
        <section class="about" style="background-color: transparent">
            <div class="container">
                <h2 class="fw-bold d-inline">Explore Data</h2>
                <a class="d-inline float-end btn btn-success" href="{{ route('kesehatan.dashboard') }}">Lihat Selengkapnya
                    <i class="ri-arrow-right-line"></i></a>
                <p>Jelajahi berbagai data pelayanan dasar provinsi bengkulu</p>
                <div class="row">
                    <div class="col-md-4 g-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h6 class="fw-bold">Jumlah Sekolah Berdasarkan Tingkat Pendidikan</h6>
                                        <p style="font-size: 13px;">Provinsi Bengkulu</p>
                                        <small style="font-size: 10px;">Sumber : Dinas Pendidikan</small>
                                    </div>
                                    <div class="col-md-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24" fill="rgba(173,184,194,1)">
                                            <path
                                                d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 9.5C12.8284 9.5 13.5 8.82843 13.5 8C13.5 7.17157 12.8284 6.5 12 6.5C11.1716 6.5 10.5 7.17157 10.5 8C10.5 8.82843 11.1716 9.5 12 9.5ZM14 15H13V10.5H10V12.5H11V15H10V17H14V15Z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <hr>
                                <div class="chart-container">
                                    <canvas id="lineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 g-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h6 class="fw-bold">Kunjungan Bulanan Pasien di RSUD Dr. M. Yunus</h6>
                                        <p style="font-size: 13px;">Provinsi Bengkulu</p>
                                        <small style="font-size: 10px;">Sumber : Dinas Kesehatan</small>
                                    </div>
                                    <div class="col-md-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24" fill="rgba(173,184,194,1)">
                                            <path
                                                d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 9.5C12.8284 9.5 13.5 8.82843 13.5 8C13.5 7.17157 12.8284 6.5 12 6.5C11.1716 6.5 10.5 7.17157 10.5 8C10.5 8.82843 11.1716 9.5 12 9.5ZM14 15H13V10.5H10V12.5H11V15H10V17H14V15Z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <hr>
                                <div class="chart-container">
                                    <canvas id="kunjunganChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 g-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h6 class="fw-bold">Indeks Angka Kemiskinan di Kab/Kota</h6>
                                        <p style="font-size: 13px;">Provinsi Bengkulu</p>
                                        <small style="font-size: 10px;">Sumber : Dinas Dukcapil</small>
                                    </div>
                                    <div class="col-md-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24" fill="rgba(173,184,194,1)">
                                            <path
                                                d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 9.5C12.8284 9.5 13.5 8.82843 13.5 8C13.5 7.17157 12.8284 6.5 12 6.5C11.1716 6.5 10.5 7.17157 10.5 8C10.5 8.82843 11.1716 9.5 12 9.5ZM14 15H13V10.5H10V12.5H11V15H10V17H14V15Z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <hr>
                                <div class="chart-container">
                                    <canvas id="kemiskinanChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <script>
        var ctx = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['SD', 'SMP', 'SMA', 'SMK'],
                datasets: [{
                    label: 'Jumlah Sekolah',
                    data: [
                        {{ $totalSekolahSD }}, {{ $totalSekolahSMP }}, {{ $totalSekolahSMA }},
                        {{ $totalSekolahSMK }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(54, 132, 215, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 132, 215, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // Chart responsive
                scales: {
                    y: {
                        beginAtZero: true // Mulai sumbu Y dari 0
                    }
                }
            }
        });
    </script>
{{--    <script>
        // Data dari PHP yang di-passing ke JavaScript
        const bulan = @json($bulan); // Nama bulan sudah dalam bentuk kalimat
        const pasienBaru = @json($pasienBaru);
        const pasienLama = @json($pasienLama);

        // Membuat chart menggunakan Chart.js
        const rsctx = document.getElementById('kunjunganChart').getContext('2d');
        const kunjunganChart = new Chart(rsctx, {
            type: 'line', // Tipe chart: Line
            data: {
                labels: bulan, // Label X (nama bulan)
                datasets: [{
                        label: 'Pasien Baru',
                        data: pasienBaru, // Data pasien baru
                        borderColor: 'rgba(75, 192, 192, 1)', // Warna garis
                        fill: false
                    },
                    {
                        label: 'Pasien Lama',
                        data: pasienLama, // Data pasien lama
                        borderColor: 'rgba(153, 102, 255, 1)', // Warna garis
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Pasien'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script> --}}

    <script>
        const ctxkk = document.getElementById('kemiskinanChart').getContext('2d');
        const kemiskinanChart = new Chart(ctxkk, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!}, // Data label dari controller
                datasets: [{
                    label: 'Jumlah',
                    data: {!! json_encode($jumlah) !!}, // Data jumlah dari controller
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie', // Tipe chart pie
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple'], // Label untuk masing-masing data
                datasets: [{
                    label: 'My First Dataset', // Label dataset
                    data: [12, 19, 3, 5, 2], // Data yang akan ditampilkan
                    backgroundColor: [ // Warna masing-masing bagian pie
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)'
                    ],
                    borderColor: [ // Warna garis tepi untuk masing-masing bagian pie
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1 // Ketebalan garis tepi
                }]
            },
            options: {
                responsive: true, // Chart responsive
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar', // Tipe chart bar
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'], // Data label
                datasets: [{
                    label: 'Dataset Example', // Label dataset
                    data: [12, 19, 3, 5, 2, 3], // Data nilai yang akan ditampilkan
                    backgroundColor: [ // Warna untuk setiap bar
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ],
                    borderColor: [ // Warna garis tepi untuk setiap bar
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1 // Ketebalan garis tepi
                }]
            },
            options: {
                responsive: true, // Membuat chart responsive
                scales: {
                    y: {
                        beginAtZero: true // Sumbu Y dimulai dari 0
                    }
                }
            }
        });
    </script>
@endsection
