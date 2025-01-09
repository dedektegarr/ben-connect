@extends('FrontOffice.dashboard.dashboard')
@section('title', 'Data Bencana di Provinsi Bengkulu')
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
                            <h5 class="card-title">Data Bencana di Provinsi Bengkulu
                            </h5>
                            <hr>
                            <canvas id="bencanaChart" height="400"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card shadow-sm">
                        <div class="card-body" style="height: 430px;">
                            <h5 class="card-title fw-bold">Filter</h5>
                            <form action="{{ route('bencana.dashboard') }}" method="GET">
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
                            <h2 class="card-title">Tabel Data Bencana di Provinsi Bengkulu</h2>
                            <hr>
                            <table id="example" class="display table table-responsive" style="width:100%;background-color: transparent;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kab/Kota</th>
                                        <th>Tanah Longsor</th>
                                        <th>Banjir</th>
                                        <th>Banjir Bandang</th>
                                        <th>Gempa Bumi</th>
                                        <th>Tsunami</th>
                                        <th>Gelombang Pasang Laut</th>
                                        <th>Angin Topan/Puyuh/Beliung</th>
                                        <th>Gunung Meletus</th>
                                        <th>Kebakaran Hutan dan Lahan</th>
                                        <th>Kekeringan</th>
                                        <th>Tahun</th>
                                    </tr>
                                </thead>
                                @foreach ($bencana as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item['nama_daerah'] }}</td>
                                        <td>{{ $item['tanah_longsor'] }}</td>
                                        <td>{{ $item['banjir'] }}</td>
                                        <td>{{ $item['banjir_bandang'] }}</td>
                                        <td>{{ $item['gempa_bumi'] }}</td>
                                        <td>{{ $item['tsunami'] }}</td>
                                        <td>{{ $item['gel_pasang_laut'] }}</td>
                                        <td>{{ $item['angin_topan'] }}</td>
                                        <td>{{ $item['gunung_meletus'] }}</td>
                                        <td>{{ $item['kebakaran_hutan_lahan'] }}</td>
                                        <td>{{ $item['kekeringan'] }}</td>
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
    <script>
        const bencanaData = @json($bencana);
        const kab_kota = bencanaData.map(d => d.nama_daerah);
        const total = bencanaData.map(d => d.total);
        var ctxjln = document.getElementById('bencanaChart').getContext('2d');
        var bencanaChart = new Chart(ctxjln, {
            type: 'bar',
            data: {
                labels: kab_kota,
                datasets: [{
                    label: 'Data Bencana Per Kab/Kota',
                    data: total,
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
        var jsonData = @json($bencana);

        function popUp(feature, layer) {
            let daerah = feature.properties.Nama;
            let info = jsonData.find(item => item.nama_daerah === daerah);

            if (info) {
                layer.bindPopup(`<div class="popup-card">
            <h4>${daerah}</h4>
            <div class="line"></div>
                <div class="text-wrapper">
                    <p>
                        Data Bencana yang terdapat di Kota/Kabupaten ini sebagai berikut:
                        <br>
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <b>Tanah Longsor : ${info.tanah_longsor}</b>
                        </div>
                        <div class="col-md-6">
                            <b>Banjir : ${info.banjir}</b>
                        </div>
                        <div class="col-md-6">
                            <b>Banjir Bandang : ${info.banjir_bandang}</b>
                        </div>
                        <div class="col-md-6">
                            <b>Gempa Bumi : ${info.gempa_bumi}</b>
                        </div>
                        <div class="col-md-6">
                            <b>Tsunami: ${info.tsunami}</b>
                        </div>
                        <div class="col-md-6">
                            <b>Gelombang Pasang Laut: ${info.gel_pasang_laut}</b>
                        </div>
                        <div class="col-md-6">
                            <b>Angin Topan: ${info.angin_topan}</b>
                        </div>
                        <div class="col-md-6">
                            <b>Gunung Meletus: ${info.gunung_meletus}</b>
                        </div>
                        <div class="col-md-6">
                            <b>Kebakaran Hutan dan Lahan: ${info.kebakaran_hutan_lahan}</b>
                        </div>
                        <div class="col-md-6">
                            <b>Kekeringan: ${info.kekeringan}</b>
                        </div>
                    </div>
                </div>
            </div>`);
            } else {
                layer.bindPopup("<b>" + daerah + "</b><br>Data tidak tersedia.");
            }
        }
    </script>

@endsection
