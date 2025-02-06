@extends('FrontOffice.dashboard.dashboard')
@section('title', 'Rumah Sakit')
@section('main')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="map" style="height: 400px; z-index:1;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Dokter di RSUD Dr. M. Yunus Bengkulu</h5>
                            <h2 class="text-success">{{ count($dokter) }} Dokter</h2>
                            <hr>
                            <canvas id="tenagaMedisChart" height="400"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card shadow-sm">
                        <div class="card-body" style="height: 430px;">
                            <h5 class="card-title fw-bold">Filter</h5>
                            <form action="{{ route('kesehatan.dashboard') }}" method="GET">
                                <!-- Gaya Peta -->
                                <div class="mb-3">
                                    <label for="gayaPeta" class="form-label">Gaya Peta</label>
                                    <select class="form-control" name="peta" id="gayaPeta" aria-label="Gaya Peta">
                                        <option value="1">Marker</option>
                                        <option value="2">Polygon</option>
                                    </select>
                                </div>

                                <!-- Tahun -->
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <select class="form-control" name="tahun" id="tahun" aria-label="Tahun">
                                        <option value="2024" selected>2024</option>
                                        <option value="2025" selected>2025</option>
                                        <option value="2026" selected>2026</option>
                                    </select>
                                </div>

                                <!-- Buttons -->
                                <div class="d-flex float-right">
                                    <button type="reset" class="btn btn-outline-dark mr-3">Reset</button>
                                    <button type="submit" class="btn btn-success text-white"
                                        style="background-color:#28a745; ">Terapkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Kunjungan Pasien Perbulan</h5>
                            <canvas id="kunjunganChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Pasien Berdasarkan Umur</h5>
                            <canvas id="pasienUmurChart"></canvas>
                        </div>
                    </div>
                </div>
                @foreach ($kamar_tidur as $item)
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $item['NAME_OF_CLASS'] }}</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="text-center">Kapasitas</h5>
                                        <h2 class="text-success text-center">{{ $item['cap'] }}</h2>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-center">Terisi</h5>
                                        <h2 class="text-success text-center">{{ $item['ISI'] }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "lengthMenu": [5, 10, 25, 50],
                "pageLength": 5,
                "searching": true, // Enable search box
            });
        });
    </script>
    <script>
        var map = L.map('map').setView([-3.8000, 102.2667], 13);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var greenIcon = L.icon({
            iconUrl: '{{ asset('assets/rumah_sakit.png') }}',
            iconSize: [20, 25], // size of the icon
            iconAnchor: [18, 25], // point of the icon which will correspond to marker's location
            popupAnchor: [-3, -36] // point from which the popup should open relative to the iconAnchor
        });


        fetch("{{ asset('assets/data_json/kesehatan/rumah_sakit.json') }}")
            .then(response => response.json())
            .then(data => {
                data.forEach(function(rumahSakit) {
                    var lat = rumahSakit.lat;
                    var long = rumahSakit.long;
                    var nama = rumahSakit.Nama_Rumah_Sakit;
                    var jenis = rumahSakit.Jenis_RS;
                    var kelas = rumahSakit.Kelas_RS;
                    var pemilik = rumahSakit.Pemilik;
                    var ranjang = rumahSakit.Total_Ranjang;
                    L.marker([lat, long], {
                            icon: greenIcon
                        })
                        .addTo(map)
                        .bindPopup(
                            `<div class="popup-card">
                                            <h4>${nama}</h4>
                                            <div class="line"></div>
                                            <div class="text-wrapper">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p><b>Jenis RS:</b> ${jenis}</p>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <p><b>Kelas RS:</b> ${kelas}</p>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <p><b>Pemilik:</b> ${pemilik}</p>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <p><b>Total Ranjang:</b> ${ranjang}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`
                        );
                });
            });
    </script>

    <script>
        const dokterData = @json($dokter);
        const dokterNames = dokterData.map(d => d.fullname);
        const jumlahPasien = dokterData.map(d => d.jml);
        var ctx = document.getElementById('tenagaMedisChart').getContext('2d');
        var tenagaMedisChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dokterNames,
                datasets: [{
                    label: 'Jumlah Pelayanan Pasien',
                    data: jumlahPasien,
                    backgroundColor: [
                        '#004d00', '#228B22', '#32CD32', '#66ff66',
                        '#32CD32', '#66ff66', '#228B22', '#66ff66',
                        '#228B22', '#004d00'
                    ],
                    borderColor: '#004d00',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // Menjadikan chart horizontal
                scales: {
                    x: {
                        beginAtZero: true,
                        display: true, // Sembunyikan label sumbu X
                    },
                    y: {
                        display: false, // Sembunyikan label sumbu Y
                    }
                },
                plugins: {
                    legend: {
                        display: true, // Jika ingin menyembunyikan label di atas chart, set ke false
                        position: 'top'
                    },
                    tooltip: {
                        enabled: true
                    }
                }
            }
        });
    </script>
    <script>
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
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const pasienData = @json($pasien);

            // Ambil kategori umur dan jumlah pasien dari data
            const umurCategories = pasienData.map(d => d.isnew); // Sesuaikan dengan struktur data API
            const jumlahPasien = pasienData.map(d => d.jml); // Sesuaikan dengan struktur data API

            const ctxpbu = document.getElementById('pasienUmurChart').getContext('2d');
            const pasienUmurChart = new Chart(ctxpbu, {
                type: 'bar', // Anda dapat mengubah ke 'line', 'pie', atau 'doughnut' jika diinginkan
                data: {
                    labels: umurCategories,
                    datasets: [{
                        label: 'Jumlah Pasien per Kategori Umur',
                        data: jumlahPasien,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Pasien'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Kategori Umur'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                }
            });
        });
    </script>

@endsection
