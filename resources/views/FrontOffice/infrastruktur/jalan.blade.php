@extends('FrontOffice.dashboard.dashboard')
@section('title', 'Data Jalan di Provinsi Bengkulu')
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
                            <h5 class="card-title">Panjang Jalan
                                @if (!app('request')->input('jenis_data'))
                                    Provinsi
                                @else
                                    {{ app('request')->input('jenis_data') }}
                                @endif
                                di Provinsi Bengkulu
                            </h5>
                            <h2 class="text-success">
                                @if (app('request')->input('jenis_data') == 'nasional' || !app('request')->input('jenis_data'))
                                    {{ $totalJalanNasional }} KM
                                @elseif(app('request')->input('jenis_data') == 'provinsi')
                                    {{ $totalJalanProvinsi }} KM
                                @elseif(app('request')->input('jenis_data') == 'kabupaten')
                                    {{ $totalJalanKabupaten }} KM
                                @endif
                            </h2>
                            <hr>
                            <canvas id="jalanChart" height="400"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card shadow-sm">
                        <div class="card-body" style="height: 430px;">
                            <h5 class="card-title fw-bold">Filter</h5>
                            <form action="{{ route('infrastruktur-jalan.dashboard') }}" method="GET">
                                <div class="mb-3">
                                    <label for="kab_kota" class="form-label">Kabupaten/Kota</label>
                                    <select class="form-control" name="kab_kota" id="kab_kota">
                                        <option value="all" @if (app('request')->input('kab_kota') == 'all') selected @endif>Semua
                                            Kabupaten/Kota</option>
                                        @for ($i = 0; $i < count($kab_kota); $i++)
                                            <option value="{{ $kab_kota[$i] }}"
                                                @if (app('request')->input('kab_kota') == $kab_kota[$i]) selected @endif>
                                                {{ $kab_kota[$i] }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_data" class="form-label">Jenis Data</label>
                                    <select class="form-control" name="jenis_data" id="jenis_data"
                                        aria-label="Default select example">
                                        <option value="nasional" @if (app('request')->input('jenis_data') == 'nasional') selected @endif>
                                            Jalan Nasional</option>
                                        <option value="provinsi" @if (app('request')->input('jenis_data') == 'provinsi') selected @endif>
                                            Jalan Provinsi</option>
                                        <option value="kabupaten" @if (app('request')->input('jenis_data') == 'kabupaten') selected @endif>
                                            Jalan Kabupaten</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Tahun Data</label>
                                    <select class="form-control" name="tahun" id="tahun"
                                        aria-label="Default select example">
                                        <option value="2023" @if (app('request')->input('tahun') == '2023') selected @endif>
                                            2023</option>
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
                            <h2 class="card-title">Tabel Data Jalan di Provinsi Bengkulu</h2>
                            <hr>
                            <table id="example" class="display table table-responsive"
                                style="width:100%;background-color: transparent;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kab/Kota</th>
                                        <th>Jalan Nasional (KM)</th>
                                        <th>Jalan Provinsi (KM)</th>
                                        <th>Jalan Kabupaten (KM)</th>
                                        <th>Total (KM)</th>
                                        <th>Tahun</th>
                                    </tr>
                                </thead>
                                @foreach ($jalan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item['nama_daerah'] }}</td>
                                        <td>{{ $item['nasional'] }}</td>
                                        <td>{{ $item['provinsi'] }}</td>
                                        <td>{{ $item['kabupaten'] }}</td>
                                        <td>{{ $item['total'] }}</td>
                                        <td>{{ $item['tahun'] }}</td>
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
        var selectedKabupaten = @json($selectedKabupaten);

        var map = L.map('map').setView([-3.8000, 102.2667], 8);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var jsonTest = new L.GeoJSON.AJAX(["{{ asset('assets/kotaKabupatenBengkulu.geojson') }}"], {
            onEachFeature: function(feature, layer) {
                if (selectedKabupaten === 'all' || feature.properties.Nama === selectedKabupaten) {
                    popUp(feature, layer);
                    layer.addTo(map);
                }
            }
        });

        geoJsonLayer.addTo(map);
    </script>

    @if (app('request')->input('jenis_data') == 'nasional' || !app('request')->input('jenis_data'))
        <script>
            const jalanData = @json($jalan);
            const kab_kota = jalanData.map(d => d.nama_daerah);
            const nasional = jalanData.map(d => d.nasional);
            var ctxjln = document.getElementById('jalanChart').getContext('2d');
            var jalanChart = new Chart(ctxjln, {
                type: 'bar',
                data: {
                    labels: kab_kota,
                    datasets: [{
                        label: 'Data Jalan Per Kab/Kota',
                        data: nasional,
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
                            display: true, // Sembunyikan label sumbu Y
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
            var jsonData = @json($jalan);

            function popUp(feature, layer) {
                let daerah = feature.properties.Nama;
                let info = jsonData.find(item => item.nama_daerah === daerah);

                if (info) {
                    layer.bindPopup(`<div class="popup-card">
                 <h4>${daerah}</h4>
                 <div class="line"></div>
                 <div class="text-wrapper">
                     <p>
                         Data Jalan yang terdapat di Kota/Kabupaten ini sebagai berikut:
                         <br>
                         <b>Jalan Nasional : ${info.nasional} KM</b>
                     </p>
                 </div>
             </div>`);
                } else {
                    layer.bindPopup("<b>" + daerah + "</b><br>Data tidak tersedia.");
                }
            }
        </script>
    @elseif(app('request')->input('jenis_data') == 'provinsi')
        <script>
            const jalanData = @json($jalan);
            const kab_kota = jalanData.map(d => d.nama_daerah);
            const provinsi = jalanData.map(d => d.provinsi);
            var ctxjln = document.getElementById('jalanChart').getContext('2d');
            var jalanChart = new Chart(ctxjln, {
                type: 'bar',
                data: {
                    labels: kab_kota,
                    datasets: [{
                        label: 'Data Jalan Per Kab/Kota',
                        data: provinsi,
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
                            display: true, // Sembunyikan label sumbu Y
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
            var jsonData = @json($jalan);

            function popUp(feature, layer) {
                let daerah = feature.properties.Nama;
                let info = jsonData.find(item => item.nama_daerah === daerah);

                if (info) {
                    layer.bindPopup(`<div class="popup-card">
             <h4>${daerah}</h4>
             <div class="line"></div>
             <div class="text-wrapper">
                 <p>
                     Data Jalan yang terdapat di Kota/Kabupaten ini sebagai berikut:
                     <br>
                     <b>Jalan Provinsi : ${info.provinsi} KM</b>
                 </p>
             </div>
         </div>`);
                } else {
                    layer.bindPopup("<b>" + daerah + "</b><br>Data tidak tersedia.");
                }
            }
        </script>
    @elseif(app('request')->input('jenis_data') == 'kabupaten')
        <script>
            const jalanData = @json($jalan);
            const kab_kota = jalanData.map(d => d.nama_daerah);
            const kabupaten = jalanData.map(d => d.kabupaten);
            var ctxjln = document.getElementById('jalanChart').getContext('2d');
            var jalanChart = new Chart(ctxjln, {
                type: 'bar',
                data: {
                    labels: kab_kota,
                    datasets: [{
                        label: 'Data Jalan Per Kab/Kota',
                        data: kabupaten,
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
                            display: true, // Sembunyikan label sumbu Y
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
            var jsonData = @json($jalan);

            function popUp(feature, layer) {
                let daerah = feature.properties.Nama;
                let info = jsonData.find(item => item.nama_daerah === daerah);

                if (info) {
                    layer.bindPopup(`<div class="popup-card">
             <h4>${daerah}</h4>
             <div class="line"></div>
             <div class="text-wrapper">
                 <p>
                     Data Jalan yang terdapat di Kota/Kabupaten ini sebagai berikut:
                     <br>
                     <b>Jalan Kabupaten : ${info.kabupaten} KM</b>
                 </p>
             </div>
         </div>`);
                } else {
                    layer.bindPopup("<b>" + daerah + "</b><br>Data tidak tersedia.");
                }
            }
        </script>
    @endif

@endsection
