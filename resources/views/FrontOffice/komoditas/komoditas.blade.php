@extends('FrontOffice.dashboard.dashboard')
@section('title', 'Data Komoditas di Provinsi Bengkulu')
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
                            <h5 class="card-title">Data Komoditas di Provinsi Bengkulu
                            </h5>
                            <h2 class="text-success">{{ count($jumlahBahanPokokKomoditas) }} Komoditas</h2>
                            <hr>
                            <canvas id="komoditasChart" height="400"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card shadow-sm">
                        <div class="card-body" style="height: 430px;">
                            <h5 class="card-title fw-bold">Filter</h5>
                            <form action="{{ route('komoditas.dashboard') }}" method="GET">
                                <div class="mb-3">
                                    <label for="pasar" class="form-label">Pasar</label>
                                    <select class="form-control" name="pasar" id="pasar">
                                        <option value="" @if (app('request')->input('pasar') == '') selected @endif>Semua
                                            Pasar</option>
                                        @foreach ($pasarData as $key => $pasar)
                                            <option value="{{ $pasar }}"
                                                @if (app('request')->input('pasar') == $pasar) selected @endif>
                                                {{ ucfirst($pasar) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="pasar" class="form-label">Komoditas</label>
                                    <select class="form-control" name="komoditas" id="komoditas">
                                        <option value="" @if (app('request')->input('komoditas') == '') selected @endif>Semua
                                            Komoditas</option>
                                        @foreach ($komoditasData as $key => $komoditasItem)
                                            <option value="{{ $komoditasItem }}"
                                                @if (app('request')->input('komoditas') == $komoditasItem) selected @endif>
                                                {{ ucfirst($komoditasItem) }}
                                            </option>
                                        @endforeach
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Tabel Data Komoditas di Provinsi Bengkulu</h2>
                            <hr>
                            <table id="example" class="display table table-responsive"
                                style="width:100%;background-color: transparent;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Komoditas</th>
                                        <th>Bahan</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Pasar</th>
                                        <th>Warna</th>
                                        <th>Update Terakhir</th>
                                    </tr>
                                </thead>
                                @foreach ($bahanPokokWithKomoditas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item['komoditi'] }}</td>
                                        <td>{{ $item['bahan'] }}</td>
                                        <td>{{ $item['satuan'] }}</td>
                                        <td>{{ $item['harga'] }}</td>
                                        <td>{{ $item['pasar'] }}</td>
                                        <td>
                                            <span
                                                style="background-color: {{ $item['color'] }}; display: block; width: 20px; height: 20px; border-radius: 50%;"></span>
                                        </td>

                                        <td>{{ date('Y-m-d', strtotime($item['waktu'])) }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
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
            iconUrl: '{{ asset('assets/toko.png') }}',
            iconSize: [20, 25], // size of the icon
            iconAnchor: [18, 25], // point of the icon which will correspond to marker's location
            popupAnchor: [-3, -36] // point from which the popup should open relative to the iconAnchor
        });

        const urlParams = new URLSearchParams(window.location.search);
        const pasar = urlParams.get('pasar');

        fetch("{{ asset('assets/data_json/komoditas/pasar.json') }}")
            .then(response => response.json())
            .then(data => {
                if (pasar) {
                    data = data.filter(d => d.pasar.toLowerCase() === pasar)

                    data.forEach(function(pasar) {
                        var lat = pasar.latitude;
                        var long = pasar.longitude;
                        var nama = pasar.pasar;
                        L.marker([lat, long], {
                                icon: greenIcon
                            })
                            .addTo(map)
                            .bindPopup(
                                `<div class="popup-card">
                                    <h4>Pasar ${nama}</h4>
                                    <div class="line"></div>
                                </div>`
                            );
                    });
                } else {
                    data.forEach(function(pasar) {
                        var lat = pasar.latitude;
                        var long = pasar.longitude;
                        var nama = pasar.pasar;
                        L.marker([lat, long], {
                                icon: greenIcon
                            })
                            .addTo(map)
                            .bindPopup(
                                `<div class="popup-card">
                                    <h4>Pasar ${nama}</h4>
                                    <div class="line"></div>
                                </div>`
                            );
                    });
                }
            });
    </script>
    <script>
        const jumlahKomoditasData = @json($jumlahBahanPokokKomoditas);
        const komoditasName = Object.keys(jumlahKomoditasData);
        const jumlahDataKomoditas = Object.values(jumlahKomoditasData);

        // const canvasHeight = komoditasName.length * 25;
        // const canvas = document.getElementById('komoditasChart');

        // canvas.height = canvasHeight;
        var ctx = document.getElementById('komoditasChart').getContext('2d');
        const maxDataValue = Math.max(...jumlahDataKomoditas);

        function getDarkGreen(value) {
            const baseGreen = 50;
            const greenValue = Math.floor(255 - ((value / maxDataValue) * (255 - baseGreen)));
            return `rgb(0, ${greenValue}, 0)`;
        }

        const backgroundColors = jumlahDataKomoditas.map(value => getDarkGreen(value));
        var komoditasChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: komoditasName,
                datasets: [{
                    label: 'Jumlah Data Komoditas',
                    data: jumlahDataKomoditas,
                    backgroundColor: backgroundColors,
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

@endsection
