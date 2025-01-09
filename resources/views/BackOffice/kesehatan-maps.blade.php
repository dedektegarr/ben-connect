@extends('BackOffice.layout.layout')
@section('title', 'Pendidikan')
@section('main')

    <div class="row">
        <div class="col-md-">
            <div class="row g-2">
                <div class="col-md-12">
                    <div class="card content-card float-end" style="margin-top:40px; width:350px;">
                        <div class="card-body">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $jumlah_swasta = 0;
        $jumlah_pemkot = 0;
    @endphp
    @for ($i = 0; $i < count($data_rs); $i++)
        <?php
        if ($data_rs[$i]['Pemilik'] == 'Swasta') {
            $jumlah_swasta += 1;
        } elseif ($data_rs[$i]['Pemilik'] == 'Pemkot') {
            $jumlah_pemkot += 1;
        }
        ?>
    @endfor

    {{-- <script>
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
    </script> --}}
    <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Swasta', 'Pemkot'],
                datasets: [{
                    label: 'Jenis Pemilik Rumah Sakit',
                    data: [{{ $jumlah_swasta }}, {{ $jumlah_pemkot }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',

                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Total Rumah Sakit',
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
