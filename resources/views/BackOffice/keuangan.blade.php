@extends('BackOffice.layout.layout')
@section('title', 'Infrastruktur')
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
        <div class="col-md-3">
            <div class="card content-card float-end" style="margin-top:40px; width:100%;">
                <div class="card-body">
                    <h6 class="card-title fw-bold container">Total Anggaran Masing-masing OPD Tahun 2023 Provinsi Bengkulu
                    </h6>
                    <div class="overflow-auto">
                        <div class="mt-1">
                            @for ($i = 0; $i < 3; $i++)
                                <div class="c_card-instance mt-3">
                                    <div class="c_card-frame">
                                        <img src="{{ asset('assets/kominfo.png') }}" alt="rectangle" width="25"
                                            height="25" class="c_card-rectangle" />
                                    </div>
                                    <div class="c_card-frame1">
                                        <div class="c_card-text">
                                            <p class="c_card-text1">Rp 1.480.000.000</p>
                                        </div>
                                        <div class="c_card-text2">
                                            <p class="c_card-text3">Rp 1.280.000.000</p>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card content-card" style="margin-top:40px;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Total Anggaran Masing-masing OPD Tahun 2023 Provinsi Bengkulu</h5>
                    <hr>
                    <table id="example" class="display table" style="width:100%;background-color: transparent;"">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Uraian</th>
                                <th>Sebelum Perubahan</th>
                                <th>Setelah Perubahan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i < 9; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>Pendapattan Asli Daerah (PAD)</td>
                                    <td>Rp.{{ number_format(rand(0, 1000000), 0) }}</td>
                                    <td>Rp.{{ number_format(rand(0, 1000000), 0) }}</td>
                                </tr>
                            @endfor
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
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
    </script>
@endsection
