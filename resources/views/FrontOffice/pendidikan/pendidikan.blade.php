@extends('FrontOffice.dashboard.dashboard')
@section('title', 'Rumah Sakit')
@section('main')

    @php
        $data_persentase_sekolah = \App\Http\Controllers\FrontOffice\DashboardPendidikanController::getJumlah(
            'sekolah',
        );
        $data_persentase_guru = \App\Http\Controllers\FrontOffice\DashboardPendidikanController::getJumlah('guru');
        $data_persentase_siswa = \App\Http\Controllers\FrontOffice\DashboardPendidikanController::getJumlah('siswa');
        if (app('request')->input('jenis_data') != null) {
            $persentase_SD = \App\Http\Controllers\FrontOffice\DashboardPendidikanController::getPercentSekolahSD(
                $data_persentase_sekolah[app('request')->input('kab_kota')]['SD'],
                $data_persentase_sekolah[app('request')->input('kab_kota')]['SMP'],
                $data_persentase_sekolah[app('request')->input('kab_kota')]['SMA'],
                $data_persentase_sekolah[app('request')->input('kab_kota')]['SMK'],
            );
            $persentase_SMP = \App\Http\Controllers\FrontOffice\DashboardPendidikanController::getPercentSekolahSMP(
                $data_persentase_sekolah[app('request')->input('kab_kota')]['SD'],
                $data_persentase_sekolah[app('request')->input('kab_kota')]['SMP'],
                $data_persentase_sekolah[app('request')->input('kab_kota')]['SMA'],
                $data_persentase_sekolah[app('request')->input('kab_kota')]['SMK'],
            );
            $persentase_SMA = \App\Http\Controllers\FrontOffice\DashboardPendidikanController::getPercentSekolahSMA(
                $data_persentase_sekolah[app('request')->input('kab_kota')]['SD'],
                $data_persentase_sekolah[app('request')->input('kab_kota')]['SMP'],
                $data_persentase_sekolah[app('request')->input('kab_kota')]['SMA'],
                $data_persentase_sekolah[app('request')->input('kab_kota')]['SMK'],
            );
            $persentase_SMK = \App\Http\Controllers\FrontOffice\DashboardPendidikanController::getPercentSekolahSMK(
                $data_persentase_sekolah[app('request')->input('kab_kota')]['SD'],
                $data_persentase_sekolah[app('request')->input('kab_kota')]['SMP'],
                $data_persentase_sekolah[app('request')->input('kab_kota')]['SMA'],
                $data_persentase_sekolah[app('request')->input('kab_kota')]['SMK'],
            );
            $persentase_guru_SD = \App\Http\Controllers\FrontOffice\DashboardPendidikanController::getPercentSekolahSD(
                $data_persentase_guru[app('request')->input('kab_kota')]['SD'],
                $data_persentase_guru[app('request')->input('kab_kota')]['SMP'],
                $data_persentase_guru[app('request')->input('kab_kota')]['SMA'],
                $data_persentase_guru[app('request')->input('kab_kota')]['SMK'],
            );
            $persentase_guru_SMP = \App\Http\Controllers\FrontOffice\DashboardPendidikanController::getPercentSekolahSMP(
                $data_persentase_guru[app('request')->input('kab_kota')]['SD'],
                $data_persentase_guru[app('request')->input('kab_kota')]['SMP'],
                $data_persentase_guru[app('request')->input('kab_kota')]['SMA'],
                $data_persentase_guru[app('request')->input('kab_kota')]['SMK'],
            );
            $persentase_guru_SMA = \App\Http\Controllers\FrontOffice\DashboardPendidikanController::getPercentSekolahSMA(
                $data_persentase_guru[app('request')->input('kab_kota')]['SD'],
                $data_persentase_guru[app('request')->input('kab_kota')]['SMP'],
                $data_persentase_guru[app('request')->input('kab_kota')]['SMA'],
                $data_persentase_guru[app('request')->input('kab_kota')]['SMK'],
            );
            $persentase_guru_SMK = \App\Http\Controllers\FrontOffice\DashboardPendidikanController::getPercentSekolahSMK(
                $data_persentase_guru[app('request')->input('kab_kota')]['SD'],
                $data_persentase_guru[app('request')->input('kab_kota')]['SMP'],
                $data_persentase_guru[app('request')->input('kab_kota')]['SMA'],
                $data_persentase_guru[app('request')->input('kab_kota')]['SMK'],
            );
            $persentase_siswa_SD = \App\Http\Controllers\FrontOffice\DashboardPendidikanController::getPercentSekolahSD(
                $data_persentase_siswa[app('request')->input('kab_kota')]['SD'],
                $data_persentase_siswa[app('request')->input('kab_kota')]['SMP'],
                $data_persentase_siswa[app('request')->input('kab_kota')]['SMA'],
                $data_persentase_siswa[app('request')->input('kab_kota')]['SMK'],
            );
            $persentase_siswa_SMP = \App\Http\Controllers\FrontOffice\DashboardPendidikanController::getPercentSekolahSMP(
                $data_persentase_siswa[app('request')->input('kab_kota')]['SD'],
                $data_persentase_siswa[app('request')->input('kab_kota')]['SMP'],
                $data_persentase_siswa[app('request')->input('kab_kota')]['SMA'],
                $data_persentase_siswa[app('request')->input('kab_kota')]['SMK'],
            );
            $persentase_siswa_SMA = \App\Http\Controllers\FrontOffice\DashboardPendidikanController::getPercentSekolahSMA(
                $data_persentase_siswa[app('request')->input('kab_kota')]['SD'],
                $data_persentase_siswa[app('request')->input('kab_kota')]['SMP'],
                $data_persentase_siswa[app('request')->input('kab_kota')]['SMA'],
                $data_persentase_siswa[app('request')->input('kab_kota')]['SMK'],
            );
            $persentase_siswa_SMK = \App\Http\Controllers\FrontOffice\DashboardPendidikanController::getPercentSekolahSMK(
                $data_persentase_siswa[app('request')->input('kab_kota')]['SD'],
                $data_persentase_siswa[app('request')->input('kab_kota')]['SMP'],
                $data_persentase_siswa[app('request')->input('kab_kota')]['SMA'],
                $data_persentase_siswa[app('request')->input('kab_kota')]['SMK'],
            );
        } elseif (app('request')->input('jenis_data') == 'all' || !app('request')->input('jenis_data')) {
            $persentase_SD[0] = array_sum(array_column($data_persentase_sekolah, 'SD'));
            $persentase_SMP[0] = array_sum(array_column($data_persentase_sekolah, 'SMP'));
            $persentase_SMA[0] = array_sum(array_column($data_persentase_sekolah, 'SMA'));
            $persentase_SMK[0] = array_sum(array_column($data_persentase_sekolah, 'SMK'));

            $persentase_guru_SD[0] = array_sum(array_column($data_persentase_guru, 'SD'));
            $persentase_guru_SMP[0] = array_sum(array_column($data_persentase_guru, 'SMP'));
            $persentase_guru_SMA[0] = array_sum(array_column($data_persentase_guru, 'SMA'));
            $persentase_guru_SMK[0] = array_sum(array_column($data_persentase_guru, 'SMK'));

            $persentase_siswa_SD[0] = array_sum(array_column($data_persentase_siswa, 'SD'));
            $persentase_siswa_SMP[0] = array_sum(array_column($data_persentase_siswa, 'SMP'));
            $persentase_siswa_SMA[0] = array_sum(array_column($data_persentase_siswa, 'SMA'));
            $persentase_siswa_SMK[0] = array_sum(array_column($data_persentase_siswa, 'SMK'));
        }
    @endphp
    @php
        $jumlah_sd = 0;
        $jumlah_smp = 0;
        $jumlah_sma = 0;
        $jumlah_smk = 0;
        if (app('request')->input('kab_kota') != 'all') {
            for ($i = 0; $i < count($data_sd); $i++) {
                if (app('request')->input('kab_kota') == $data_sd[$i]['nama_daerah']) {
                    if (app('request')->input('jenis_data') == $data_sd[$i]['kategori']) {
                        $jumlah_sd = $jumlah_sd + $data_sd[$i]['jumlah'];
                    }
                }
            }
            for ($i = 0; $i < count($data_smp); $i++) {
                if (app('request')->input('kab_kota') == $data_smp[$i]['nama_daerah']) {
                    if (app('request')->input('jenis_data') == $data_smp[$i]['kategori']) {
                        $jumlah_smp = $jumlah_smp + $data_smp[$i]['jumlah'];
                    }
                }
            }
            for ($i = 0; $i < count($data_sma); $i++) {
                if (app('request')->input('kab_kota') == $data_sma[$i]['nama_daerah']) {
                    if (app('request')->input('jenis_data') == $data_sma[$i]['kategori']) {
                        $jumlah_sma = $jumlah_sma + $data_sma[$i]['jumlah'];
                    }
                }
            }
            for ($i = 0; $i < count($data_smk); $i++) {
                if (app('request')->input('kab_kota') == $data_smk[$i]['nama_daerah']) {
                    if (app('request')->input('jenis_data') == $data_smk[$i]['kategori']) {
                        $jumlah_smk = $jumlah_smk + $data_smk[$i]['jumlah'];
                    }
                }
            }
        } elseif (app('request')->input('kab_kota') == 'all') {
            for ($i = 0; $i < count($data_sd); $i++) {
                if (app('request')->input('jenis_data') == $data_sd[$i]['kategori']) {
                    $jumlah_sd = $jumlah_sd + $data_sd[$i]['jumlah'];
                }
            }
            for ($i = 0; $i < count($data_smp); $i++) {
                if (app('request')->input('jenis_data') == $data_smp[$i]['kategori']) {
                    $jumlah_smp = $jumlah_smp + $data_smp[$i]['jumlah'];
                }
            }
            for ($i = 0; $i < count($data_sma); $i++) {
                if (app('request')->input('jenis_data') == $data_sma[$i]['kategori']) {
                    $jumlah_sma = $jumlah_sma + $data_sma[$i]['jumlah'];
                }
            }
            for ($i = 0; $i < count($data_smk); $i++) {
                if (app('request')->input('jenis_data') == $data_smk[$i]['kategori']) {
                    $jumlah_smk = $jumlah_smk + $data_smk[$i]['jumlah'];
                }
            }
        } else {
            for ($i = 0; $i < count($data_sd); $i++) {
                if ('sekolah' == $data_sd[$i]['kategori']) {
                    $jumlah_sd = $jumlah_sd + $data_sd[$i]['jumlah'];
                }
            }
            for ($i = 0; $i < count($data_smp); $i++) {
                if ('sekolah' == $data_smp[$i]['kategori']) {
                    $jumlah_smp = $jumlah_smp + $data_smp[$i]['jumlah'];
                }
            }
            for ($i = 0; $i < count($data_sma); $i++) {
                if ('sekolah' == $data_sma[$i]['kategori']) {
                    $jumlah_sma = $jumlah_sma + $data_sma[$i]['jumlah'];
                }
            }
            for ($i = 0; $i < count($data_smk); $i++) {
                if ('sekolah' == $data_smk[$i]['kategori']) {
                    $jumlah_smk = $jumlah_smk + $data_smk[$i]['jumlah'];
                }
            }
        }
    @endphp


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
                            <h5 class="card-title">Jumlah Sekolah Per Kab/Kota</h5>
                            <h2 class="text-success">{{ $totalSeluruhSekolah }}</h2>
                            <hr>
                            <canvas id="sekolahKabKotaChart" height="400"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card shadow-sm">
                        <div class="card-body" style="height: 430px;">
                            <h5 class="card-title fw-bold">Filter</h5>
                            <form action="{{ route('pendidikan.dashboard') }}" method="GET">
                                <div class="mb-3">
                                    <label for="kab_kota" class="form-label">Kabupaten/Kota</label>
                                    <select class="form-control" name="kab_kota" id="kab_kota">
                                        {{-- <option value="all" @if (app('request')->input('kab_kota') == 'all') selected @endif>Semua
                                            Kabupaten/Kota</option> --}}
                                        @for ($i = 0; $i < count($data_sd); $i++)
                                            @if ($data_sd[$i]['kategori'] == 'sekolah')
                                                <option value="{{ $data_sd[$i]['nama_daerah'] }}"
                                                    @if (app('request')->input('kab_kota') == $data_sd[$i]['nama_daerah']) selected @endif>
                                                    {{ $data_sd[$i]['nama_daerah'] }}
                                                </option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_data" class="form-label">Jenis Data</label>
                                    <select class="form-control" name="jenis_data" id="jenis_data"
                                        aria-label="Default select example">
                                        <option value="sekolah" @if (app('request')->input('jenis_data') == 'sekolah') selected @endif>Sekolah
                                        </option>
                                        <option value="guru" @if (app('request')->input('jenis_data') == 'guru') selected @endif>Guru
                                        </option>
                                        <option value="siswa" @if (app('request')->input('jenis_data') == 'siswa') selected @endif>Siswa
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <select class="form-control" name="tahun" id="tahun"
                                        aria-label="Default select example">
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
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
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Sekolah</h5>
                                    <h2 class="text-success">
                                        @if (app('request')->input('kab_kota') == 'all' || !app('request')->input('kab_kota'))
                                            {{ $persentase_SD[0] + $persentase_SMP[0] + $persentase_SMA[0] + $persentase_SMK[0] }}
                                        @else
                                            {{ $data_persentase_sekolah[app('request')->input('kab_kota')]['SD'] +
                                                $data_persentase_sekolah[app('request')->input('kab_kota')]['SMP'] +
                                                $data_persentase_sekolah[app('request')->input('kab_kota')]['SMA'] +
                                                $data_persentase_sekolah[app('request')->input('kab_kota')]['SMK'] }}
                                        @endif
                                    </h2>
                                    <canvas id="chartSekolah" width="400" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Guru</h5>
                                    <h2 class="text-success">
                                        @if (app('request')->input('kab_kota') == 'all' || !app('request')->input('kab_kota'))
                                            {{ $persentase_guru_SD[0] + $persentase_guru_SMP[0] + $persentase_guru_SMA[0] + $persentase_guru_SMK[0] }}
                                        @else
                                            {{ $data_persentase_guru[app('request')->input('kab_kota')]['SD'] +
                                                $data_persentase_guru[app('request')->input('kab_kota')]['SMP'] +
                                                $data_persentase_guru[app('request')->input('kab_kota')]['SMA'] +
                                                $data_persentase_guru[app('request')->input('kab_kota')]['SMK'] }}
                                        @endif
                                    </h2>
                                    <canvas id="chartGuru" width="400" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Siswa</h5>
                                    <h2 class="text-success">
                                        @if (app('request')->input('kab_kota') == 'all' || !app('request')->input('kab_kota'))
                                            {{ $persentase_siswa_SD[0] + $persentase_siswa_SMP[0] + $persentase_siswa_SMA[0] + $persentase_siswa_SMK[0] }}
                                        @else
                                            {{ $data_persentase_siswa[app('request')->input('kab_kota')]['SD'] +
                                                $data_persentase_siswa[app('request')->input('kab_kota')]['SMP'] +
                                                $data_persentase_siswa[app('request')->input('kab_kota')]['SMA'] +
                                                $data_persentase_siswa[app('request')->input('kab_kota')]['SMK'] }}
                                        @endif
                                    </h2>
                                    <canvas id="chartMurid" width="400" height="400"></canvas>
                                </div>
                            </div>
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
        function popUp(f, l) {
            if (f.properties.Nama && (selectedKabupaten === 'all' || f.properties.Nama === selectedKabupaten)) {
                l.bindPopup(`<div class="popup-card">
                        <h4>${f.properties.Nama}</h4>
                        <div class="line"></div>
                        <div class="text-wrapper">
                            <p>
                                <b>Lokasi:</b>
                                Data Pendidikan yang terdapat di Kota/Kabupaten ini sebagai berikut:.
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="icon-wrapper">
                                    <img src="{{ asset('assets/logo_sekolah/sd.png') }}" width="25" height="25" >
                                    <div class="status">
                                    (SD)
                                    {{ $jumlah_sd }} {{ app('request')->input('jenis_data') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="icon-wrapper">
                                    <img src="{{ asset('assets/logo_sekolah/smp.png') }}" width="25" height="25" >
                                    <div class="status">
                                    (SMP)
                                    {{ $jumlah_smp }} {{ app('request')->input('jenis_data') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="icon-wrapper">
                                    <img src="{{ asset('assets/logo_sekolah/sma.png') }}" width="25" height="25" >
                                    <div class="status">
                                    (SMA)
                                    {{ $jumlah_sma }} {{ app('request')->input('jenis_data') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="icon-wrapper">
                                    <img src="{{ asset('assets/logo_sekolah/smk.png') }}" width="25" height="25" >
                                    <div class="status">
                                    (SMK)
                                    {{ $jumlah_smk }} {{ app('request')->input('jenis_data') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`);
            }
        }
    </script>
    <script>
        var ctx = document.getElementById('sekolahKabKotaChart').getContext('2d');
        var sekolahKabKotaChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Total Sekolah per Daerah',
                    data: {!! json_encode($jumlah_total) !!},
                    backgroundColor: '#004d00',
                    borderColor: '#004d00',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // This makes the chart horizontal
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>


    <script>
        const chrt = document.getElementById('chartSekolah').getContext('2d');
        const chartSekolah = new Chart(chrt, {
            type: 'pie',
            data: {
                labels: ['SD', 'SMP', 'SMA', 'SMK'],
                datasets: [{
                    label: 'Sekolah',
                    data: [{{ $persentase_SD[0] }},
                        {{ $persentase_SMP[0] }}, {{ $persentase_SMA[0] }}, {{ $persentase_SMK[0] }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            }
        });
    </script>
    <script>
        const chrtg = document.getElementById('chartGuru').getContext('2d');
        const chartGuru = new Chart(chrtg, {
            type: 'pie',
            data: {
                labels: ['SD', 'SMP', 'SMA', 'SMK'],
                datasets: [{
                    label: 'Guru',
                    data: [{{ $persentase_guru_SD[0] }}, {{ $persentase_guru_SMP[0] }},
                        {{ $persentase_guru_SMA[0] }}, {{ $persentase_guru_SMK[0] }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            }
        });
    </script>
    <script>
        const chrtm = document.getElementById('chartMurid').getContext('2d');
        const chartMurid = new Chart(chrtm, {
            type: 'pie',
            data: {
                labels: ['SD', 'SMP', 'SMA', 'SMK'],
                datasets: [{
                    label: 'Dataset 1',
                    data: [{{ $persentase_siswa_SD[0] }}, {{ $persentase_siswa_SMP[0] }},
                        {{ $persentase_siswa_SMA[0] }}, {{ $persentase_siswa_SMK[0] }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            }
        });
    </script>

@endsection
