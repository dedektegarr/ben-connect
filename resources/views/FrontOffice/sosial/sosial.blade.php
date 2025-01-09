@extends('FrontOffice.dashboard.dashboard')
@section('title', 'Data Sosial di Provinsi Bengkulu')
@section('main')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div id="map" style="height: 400px; z-index:1;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body" style="height: 430px;">
                            <h5 class="card-title fw-bold">Filter</h5>
                            <form action="{{ route('sosial.dashboard') }}" method="GET">
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
                                        <option value="indeks_angka_kemiskinan"
                                            @if (app('request')->input('jenis_data') == 'indeks_angka_kemiskinan') selected @endif>
                                            Indeks Angka Kemiskinan</option>
                                        <option value="indeks_pembangunan_gender"
                                            @if (app('request')->input('jenis_data') == 'indeks_pembangunan_gender') selected @endif>
                                            Indeks Pembangunan Gender</option>
                                        <option value="indeks_pembangunan_manusia"
                                            @if (app('request')->input('jenis_data') == 'indeks_pembangunan_manusia') selected @endif>Indeks Pembangunan Manusia
                                        </option>
                                        <option value="indeks_pemberdayaan_gender"
                                            @if (app('request')->input('jenis_data') == 'indeks_pemberdayaan_gender') selected @endif>Indeks Pemberdayaan Gender
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Tahun Data</label>
                                    <select class="form-control" name="tahun" id="tahun"
                                        aria-label="Default select example">
                                        <option value="2022" @if (app('request')->input('tahun') == '2022') selected @endif>
                                            2022</option>
                                        <option value="2021" @if (app('request')->input('tahun') == '2021') selected @endif>
                                            2021</option>
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
                            <h5 class="card-title">Jumlah Indeks Angka Kemiskinan di
                                Kab/Kota {{ app('request')->input('tahun') ? app('request')->input('tahun') : '2022' }}</h5>
                            <hr>
                            <canvas id="chartLineIAK" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Indeks Pembangunan Gender di
                                Kab/Kota {{ app('request')->input('tahun') ? app('request')->input('tahun') : '2022' }}</h5>
                            <hr>
                            <canvas id="chartLineIPG" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Indeks Pembangunan Manusia di
                                Kab/Kota {{ app('request')->input('tahun') ? app('request')->input('tahun') : '2022' }}</h5>
                            <hr>
                            <canvas id="chartLineIPM" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Indeks Pemberdayaan Gender di
                                Kab/Kota {{ app('request')->input('tahun') ? app('request')->input('tahun') : '2022' }}</h5>
                            <hr>
                            <canvas id="chartLineIPG2" height="200"></canvas>
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
    @if (app('request')->input('jenis_data') == 'indeks_angka_kemiskinan')
        <script>
            var jsonData = @json($indeks_angka_kemiskinan);

            function popUp(feature, layer) {
                let daerah = feature.properties.Nama;
                let info = jsonData.find(item => item.nama_daerah === daerah);

                if (info) {
                    layer.bindPopup(`<div class="popup-card">
                     <h4>${daerah}</h4>
                     <div class="line"></div>
                     <div class="text-wrapper">
                         <p>
                             Data Indeks Kemiskinan yang terdapat di Kota/Kabupaten ini sebagai berikut:
                             <br>
                             <b>Jumlah : ${info.jumlah}</b>
                             <br>
                             <b>Tanggal : ${info.tanggal_terbit}</b>
                         </p>
                     </div>
                 </div>`);
                } else {
                    layer.bindPopup("<b>" + daerah + "</b><br>Data tidak tersedia.");
                }
            }
        </script>
    @elseif(app('request')->input('jenis_data') == 'indeks_pembangunan_gender')
        <script>
            var jsonData = @json($indeks_pembangunan_gender);

            function popUp(feature, layer) {
                let daerah = feature.properties.Nama;
                let info = jsonData.find(item => item.nama_daerah === daerah);

                if (info) {
                    layer.bindPopup(`<div class="popup-card">
                 <h4>${daerah}</h4>
                 <div class="line"></div>
                 <div class="text-wrapper">
                     <p>
                         Data Indeks Pembangunan Gender yang terdapat di Kota/Kabupaten ini sebagai berikut:
                         <br>
                         <b>Jumlah : ${info.jumlah}</b>
                         <br>
                         <b>Tanggal : ${info.tahun}</b>
                     </p>
                 </div>
             </div>`);
                } else {
                    layer.bindPopup("<b>" + daerah + "</b><br>Data tidak tersedia.");
                }
            }
        </script>
    @elseif(app('request')->input('jenis_data') == 'indeks_pembangunan_manusia')
        <script>
            var jsonData = @json($indeks_pembangunan_manusia);

            function popUp(feature, layer) {
                let daerah = feature.properties.Nama;
                let info = jsonData.find(item => item.nama_daerah === daerah);

                if (info) {
                    layer.bindPopup(`<div class="popup-card">
             <h4>${daerah}</h4>
             <div class="line"></div>
             <div class="text-wrapper">
                 <p>
                     Data Indeks Pembangunan Manusia yang terdapat di Kota/Kabupaten ini sebagai berikut:
                     <br>
                     <b>Jumlah : ${info.jumlah}</b>
                     <br>
                     <b>Tanggal : ${info.tanggal_terbit}</b>
                 </p>
             </div>
         </div>`);
                } else {
                    layer.bindPopup("<b>" + daerah + "</b><br>Data tidak tersedia.");
                }
            }
        </script>
    @elseif(app('request')->input('jenis_data') == 'indeks_pemberdayaan_gender')
        <script>
            var jsonData = @json($indeks_pemberdayaan_gender);

            function popUp(feature, layer) {
                let daerah = feature.properties.Nama;
                let info = jsonData.find(item => item.nama_daerah === daerah);

                if (info) {
                    layer.bindPopup(`<div class="popup-card">
         <h4>${daerah}</h4>
         <div class="line"></div>
         <div class="text-wrapper">
             <p>
                 Data Indeks Pemerdayaan Gender yang terdapat di Kota/Kabupaten ini sebagai berikut:
                 <br>
                 <b>Jumlah : ${info.jumlah}</b>
                 <br>
                 <b>Tanggal : ${info.tahun}</b>
             </p>
         </div>
     </div>`);
                } else {
                    layer.bindPopup("<b>" + daerah + "</b><br>Data tidak tersedia.");
                }
            }
        </script>
    @endif

    <script>
        //  CHART INDEKS ANGKA KEMISKINAN
        var ctl = document.getElementById('chartLineIAK').getContext('2d');
        var chartLineIAK = new Chart(ctl, {
            type: 'line',
            data: {
                labels: @json($chart_indeks_angka_kemiskinan['nama_daerah']), // Labels (X-axis)
                datasets: [{
                    label: 'Indeks Angka Kemiskinan',
                    data: @json($chart_indeks_angka_kemiskinan['jumlah']),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }

            }
        });
    </script>
    <script>
        // CHART INDEKS PEMBANGUNAN GENDER
        var ctl4 = document.getElementById('chartLineIPG').getContext('2d');
        var chartLineIPG = new Chart(ctl4, {
            type: 'line',
            data: {
                labels: @json($chart_indeks_pembangunan_gender['nama_daerah']), // Labels (X-axis)
                datasets: [{
                    label: 'Indeks Pembangunan Gender',
                    data: @json($chart_indeks_pembangunan_gender['jumlah']),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }

            }
        });
    </script>
    <script>
        // CHART INDEKS PEMBANGUNAN MANUSIA
        var ctl2 = document.getElementById('chartLineIPM').getContext('2d');
        var chartLineIPM = new Chart(ctl2, {
            type: 'line',
            data: {
                labels: @json($chart_indeks_pembangunan_manusia['nama_daerah']), // Labels (X-axis)
                datasets: [{
                    label: 'Indeks Pembangunan Manusia',
                    data: @json($chart_indeks_pembangunan_manusia['jumlah']),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }

            }
        });
    </script>
    <script>
        var ctl3 = document.getElementById('chartLineIPG2').getContext('2d');
        var chartLineIPG2 = new Chart(ctl3, {
            type: 'line',
            data: {
                labels: @json($chart_indeks_pemerdayaan_gender['nama_daerah']), // Labels (X-axis)
                datasets: [{
                    label: 'Indeks Pemerdayaan Gender',
                    data: @json($chart_indeks_pemerdayaan_gender['jumlah']),
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }

            }
        });
    </script>
    {{-- @php
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
    </script> --}}

@endsection
