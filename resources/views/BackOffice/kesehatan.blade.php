@extends('BackOffice.layout.layout')
@section('title', 'Kesehatan')
@section('main')
    <style>
        /* Transparan untuk tabel dan elemen terkait */
        .dataTables_wrapper .dataTables_paginate .paginate_button,
        .dataTables_wrapper .dataTables_filter label,
        .dataTables_wrapper .dataTables_info {
            background: rgba(255, 255, 255, 0.5);
            /* Background putih dengan transparansi 50% */
        }

        /* Transparan untuk tabel */
        #example {
            background: rgba(255, 255, 255, 0.3);
            /* Background putih dengan transparansi 30% */
        }

        /* Transparan untuk header tabel */
        #example thead th {
            background: rgba(255, 255, 255, 0.5);
            /* Background putih dengan transparansi 50% untuk header */
        }

        .c_card-frame,
        .c_card-instance {
            gap: 33px;
            width: 100%;
            display: flex;
            padding: 16px;
            position: relative;
            box-sizing: border-box;
            align-items: center;
            border-radius: 12px 12px 12px 12px;
            justify-content: flex-start;
            background-color: #fcfcfc;
        }

        .c_card-frame {
            gap: 10px;
            max-width: 57px;
            align-items: flex-start;
            border-radius: 9999px 9999px 9999px 9999px;
            background-color: #e7e8ef;
        }

        .c_card-rectangle {
            width: 100%;
            height: auto;
            margin: 0;
            display: block;
            max-width: 25px;
        }

        .c_card-frame1 {
            width: 100%;
            display: flex;
            position: relative;
            max-width: 143px;
            box-sizing: border-box;
            align-items: flex-end;
            flex-direction: column;
            justify-content: flex-start;
        }

        .c_card-text {
            width: 100%;
            max-width: auto;
            margin-top: 0;
            min-height: auto;
            text-align: left;
            margin-bottom: 0;
        }

        .c_card-text1 {
            color: #565863;
            font-size: 16px;
            font-style: normal;
            font-family: "Inter", sans-serif;
            font-weight: 700;
            line-height: 24px;
            letter-spacing: 0;
            text-transform: none;
        }

        .c_card-text1,
        .c_card-text2,
        .c_card-text3 {
            margin-top: 0;
            text-align: left;
            margin-bottom: 0;
        }

        .c_card-text2 {
            width: 100%;
            max-width: auto;
            min-height: auto;
        }

        .c_card-text3 {
            color: #028c45;
            font-size: 16px;
            font-style: normal;
            font-family: "Inter", sans-serif;
            font-weight: 700;
            line-height: 24px;
            letter-spacing: 0;
            text-transform: none;
        }
    </style>
    <div class="row">
        <div class="col-md-8">
            <div class="card content-card" style="margin-top:40px;">
                @if (app('request')->input('pasien_harian') == 'pasien_harian')
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Data Pasien Harian Rumah Sakit di Provinsi Bengkulu</h5>
                        <hr>
                        <table id="example" class="display table" style="width:100%;background-color: transparent;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pasien Baru</th>
                                    <th>Pasien Lama</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['pasien_baru'] }} Jiwa</td>
                                    <td>{{ $item['pasien_lama'] }} Jiwa</td>
                                    <td>{{ $item['tanggal1'] }}</td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                @elseif(app('request')->input('data') == 'pasien_bulanan')
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Data Pasien Bulanan Rumah Sakit di Provinsi Bengkulu</h5>
                        <hr>
                        <table id="example" class="display table" style="width:100%;background-color: transparent;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pasien Baru</th>
                                    <th>Pasien Lama</th>
                                    <th>Bulan</th>
                                    <th>tahun</th>
                                </tr>
                            </thead>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['pasien_baru'] }} Jiwa</td>
                                    <td>{{ $item['pasien_lama'] }} Jiwa</td>
                                    <td>{{ date('F', mktime(0, 0, 0, $item['bulan'], 10)) }}</td>
                                    <td>{{ $item['tahun'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @elseif(app('request')->input('data') == 'kamar')
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Data Kamar Rumah Sakit di Provinsi Bengkulu</h5>
                        <hr>
                        <table id="example" class="display table" style="width:100%;background-color: transparent;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Klinik</th>
                                    <th>Nama Kelas</th>
                                    <th>Capasitas</th>
                                    <th>Isi</th>
                                    <th>Tarif</th>
                                </tr>
                            </thead>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['name_of_clinic'] }}</td>
                                    <td>{{ $item['NAME_OF_CLASS'] }}</td>
                                    <td>{{ $item['cap'] }} Kamar</td>
                                    <td>{{ $item['ISI'] }} Kamar</td>
                                    <td>Rp.{{ $item['TARIF'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @elseif(app('request')->input('data') == 'ketersedian_kamar')
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Data Ketersedian Kamar Rumah Sakit di Provinsi Bengkulu</h5>
                        <hr>
                        <table id="example" class="display table" style="width:100%;background-color: transparent;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Klinik</th>
                                    <th>Nama Kelas</th>
                                    <th>Capasitas</th>
                                    <th>Isi</th>
                                    <th>Tarif</th>
                                </tr>
                            </thead>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['name_of_clinic'] }}</td>
                                    <td>{{ $item['NAME_OF_CLASS'] }}</td>
                                    <td>{{ $item['cap'] }} Kamar</td>
                                    <td>{{ $item['ISI'] }} Kamar</td>
                                    <td>Rp.{{ $item['TARIF'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @elseif(app('request')->input('data') == 'kunjungan_poli')
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Data Kunjungan Poli Rumah Sakit di Provinsi Bengkulu</h5>
                        <hr>
                        <table id="example" class="display table" style="width:100%;background-color: transparent;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pengunjung</th>
                                    <th>Terlayani</th>
                                    <th>Poli</th>
                                </tr>
                            </thead>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['pengunjung'] }}</td>
                                    <td>{{ $item['terlayani'] }}</td>
                                    <td>{{ $item['poli'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @elseif(app('request')->input('data') == 'pasien_berdasarkan_umur')
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Data Pasien Berdasarkan Umur di Provinsi Bengkulu</h5>
                        <hr>
                        <table id="example" class="display table" style="width:100%;background-color: transparent;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Range Umur</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['isnew'] }}</td>
                                    <td>{{ $item['jml'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @elseif(app('request')->input('data') == 'dokter')
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Data Dokter di Provinsi Bengkulu</h5>
                        <hr>
                        <table id="example" class="display table" style="width:100%;background-color: transparent;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Dokter</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jumlah Pelayanan</th>
                                </tr>
                            </thead>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['EMPLOYEE_ID'] }}</td>
                                    <td>{{ $item['fullname'] }}</td>
                                    <td>{{ $item['jml'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @else
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Data Pengunjung Harian Rumah Sakit di Provinsi Bengkulu</h5>
                        <hr>
                        <table id="example" class="display table" style="width:100%;background-color: transparent;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pasien Baru</th>
                                    <th>Pasien Lama</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['pasien_baru'] }} Jiwa</td>
                                    <td>{{ $item['pasien_lama'] }} Jiwa</td>
                                    <td>{{ $item['tanggal1'] }}</td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                @endif

            </div>
        </div>
        <div class="col-md-4">
            <div class="card content-card float-end" style="margin-top:40px; height: 425px; width:100%;">
                <div class="card-body" style="overflow-y:auto;">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('kesehatan_maps') }}" class="btn btn-success gap-1 float-end">Buka Maps <i
                                    class="ri-map-2-fill"></i></a>
                        </div>
                    </div>
                    @for ($i = 0; $i < count($list); $i++)
                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="{{ asset('assets/file.png') }}" class="img-fluid mx-auto my-auto"
                                            alt="" srcset="">
                                    </div>
                                    <div class="col-md-10">
                                        <h6><a href="?data={{ $list[$i][1] }}">{{ $list[$i][0] }}</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                    {{-- <canvas id="barChart"></canvas> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Melikiki', 'Belum Memiliki', 'Bukan PBI'],
                datasets: [{
                    label: 'Jumlah',
                    data: [65, 59, 12],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Jumlah Pemilik Jaminan Kesehatan',
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
    </script> --}}
@endsection
