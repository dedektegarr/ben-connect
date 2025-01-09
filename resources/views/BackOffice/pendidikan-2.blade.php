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
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card content-card" style="margin-top:40px;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Rasio Fasilitas Pendidikan Menurut per Kabupaten</h5>
                    <hr>
                    <table id="example" class="display table" style="width:100%;background-color: transparent;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kabupaten</th>
                                <th>SD</th>
                                <th>SMP</th>
                                <th>SMA</th>
                                <th>SMK</th>
                                <th>UNIVERSITAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 5; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>Rejang Lebong</td>
                                    <td>{{ rand(0, 100) }}</td>
                                    <td>{{ rand(0, 100) }}</td>
                                    <td>{{ rand(0, 100) }}</td>
                                    <td>{{ rand(0, 100) }}</td>
                                    <td>{{ rand(0, 100) }}</td>
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
                labels: ['SD', 'SMP', 'SMA', 'UNIVERSITAS'],
                datasets: [{
                    label: 'Jumlah',
                    data: [65, 59, 12, 4],
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
                        text: 'Jumlah Fasilitas Pendidikan',
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
