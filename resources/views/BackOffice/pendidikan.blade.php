@extends('BackOffice.layout.layout')
@section('title', 'Pendidikan')
@section('main')

    <div class="row">
        <div class="col-md-6">
            <div class="card content-card" style="margin-top:40px; width:350px;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Filter</h5>
                    <hr>
                    <form action="{{ route('pendidikan') }}" method="get">
                        <div class="mb-3">
                            <label for="kab_kota" class="form-label">Kabupaten/Kota</label>
                            <select class="form-select" name="kab_kota" id="kab_kota">
                                <option value="all" @if (app('request')->input('kab_kota') == 'all') selected @endif>Semua
                                    Kabupaten/Kota</option>
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
                            <select class="form-select" name="jenis_data" id="jenis_data"
                                aria-label="Default select example">
                                <option value="sekolah" @if (app('request')->input('jenis_data') == 'sekolah') selected @endif>Sekolah</option>
                                <option value="guru" @if (app('request')->input('jenis_data') == 'guru') selected @endif>Guru</option>
                                <option value="siswa" @if (app('request')->input('jenis_data') == 'siswa') selected @endif>Siswa</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select class="form-select" name="tahun" id="tahun" aria-label="Default select example">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-inline float-end">
                            <button class="btn btn-light" type="reset">Reset</button>
                            <button class="btn btn-primary button-gradient" type="submit">Terapkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row g-2">
                <div class="col-md-12">
                    <div class="card content-card float-end" style="margin-top:40px; width:350px;">
                        <div class="card-body">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-12">
                    <div class="card content-card float-end" style="margin-top:10px; width:350px;">
                        <div class="card-body">
                            <canvas id="myBarChart"></canvas>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

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
        const hcart = document.getElementById('myBarChart').getContext('2d');
        new Chart(hcart, {
            type: 'bar', // Jenis grafik
            data: {
                labels: ['Bengkulu Selatan', 'Bengkulu Tengah', 'Bengkulu Utara', 'Kaur',
                    'Kepahiang'
                ], // Label sumbu Y
                datasets: [{
                    label: 'Jumlah Fasilitas',
                    data: [10, 20, 30, 40, 50], // Data batang
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna latar belakang batang
                    borderColor: 'rgba(75, 192, 192, 1)', // Warna garis tepi batang
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // Menyebabkan batang menjadi horizontal
                scales: {
                    x: {
                        beginAtZero: true // Memulai sumbu X dari nol
                    },
                    y: {
                        beginAtZero: true // Memulai sumbu Y dari nol
                    }
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['SD', 'SMP', 'SMA', 'SMK'],
                datasets: [{
                    label: 'Jumlah ' + '{{ app('request')->input('jenis_data') }}',
                    data: [{{ $jumlah_sd }}, {{ $jumlah_smp }}, {{ $jumlah_sma }},
                        {{ $jumlah_smk }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 145, 86, 0.2)',

                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 145, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Jumlah ' + '{{ app('request')->input('jenis_data') }}',
                        font: {
                            size: 10
                        },
                        color: '#333'
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
@endsection
