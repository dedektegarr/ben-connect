@extends('BackOffice.layout.layout')
@section('title', 'Infrastruktur')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <div class="card content-card" style="margin-top:40px; width:350px;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Filter</h5>
                    <hr>
                    <form action="{{ route('infrastruktur') }}" method="get">
                        <div class="mb-3">
                            <label for="kab_kota" class="form-label">Kabupaten/Kota</label>
                            <select class="form-select" name="kab_kota" id="kab_kota">
                                <option value="all" @if (app('request')->input('kab_kota') == 'all') selected @endif>Semua
                                    Kabupaten/Kota</option>
                                @for ($i = 0; $i < count($kab_kota); $i++)
                                    <option value="{{ $kab_kota[$i] }}" @if (app('request')->input('kab_kota') == $kab_kota[$i]) selected @endif>
                                        {{ $kab_kota[$i] }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_data" class="form-label">Jenis Data</label>
                            <select class="form-select" name="jenis_data" id="jenis_data"
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
                            <select class="form-select" name="tahun" id="tahun" aria-label="Default select example">
                                <option value="2023" @if (app('request')->input('tahun') == '2023') selected @endif>
                                    2023</option>
                            </select>
                        </div>
                        <div class="d-inline float-end">
                            <button type="reset" class="btn btn-light">Reset</button>
                            <button class="btn btn-primary button-gradient" type="submit">Terapkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row g-2">
                <div class="col-md-12">
                    <div class="card content-card float-end" style="margin-top:40px; width:350px;" >
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
                            <canvas id="jalanChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
