@extends('BackOffice.layout.layout')
@section('title', 'Komoditas')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <div class="card content-card" style="margin-top:40px; width:350px;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Filter</h5>
                    <hr>
                    <form action="{{ route('komoditas') }}" method="get">
                        <div class="mb-3">
                            <label for="pasar" class="form-label">Pasar</label>
                            <select class="form-select" name="pasar" id="pasar">
                                <option value="" @if (app('request')->input('pasar') == '') selected @endif>Semua
                                    Pasar</option>
                                @foreach ($pasarData as $key => $pasar)
                                    <option value="{{ $pasar }}" @if (app('request')->input('pasar') == $pasar) selected @endif>
                                        {{ ucfirst($pasar) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pasar" class="form-label">Komoditas</label>
                            <select class="form-select" name="komoditas" id="komoditas">
                                <option value="" @if (app('request')->input('komoditas') == '') selected @endif>Semua
                                    Komoditas</option>
                                @foreach ($komoditasData as $key => $komoditasItem)
                                    <option value="{{ $komoditasItem }}" @if (app('request')->input('komoditas') == $komoditasItem) selected @endif>
                                        {{ ucfirst($komoditasItem) }}
                                    </option>
                                @endforeach
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
                    <div class="card content-card float-end" style="margin-top:40px; width:350px;">
                        <div class="card-body">
                            <h5 class="card-title">Data Komoditas di Provinsi Bengkulu
                            </h5>
                            <h2 class="text-success">{{ count($jumlahBahanPokokKomoditas) }} Komoditas</h2>
                            <hr>
                            <canvas id="komoditasChart" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <script>
        const jumlahKomoditasData = @json($jumlahBahanPokokKomoditas);
        const komoditasName = Object.keys(jumlahKomoditasData);
        const jumlahDataKomoditas = Object.values(jumlahKomoditasData);

        // const canvasHeight = komoditasName.length * 25;
        // const canvas = document.getElementById('komoditasChart');

        // canvas.height = canvasHeight;
        var ctx = document.getElementById('komoditasChart').getContext('2d');
        const maxDataValue = Math.max(...jumlahDataKomoditas);

        function getDarkGreen(value) {
            const baseGreen = 50;
            const greenValue = Math.floor(255 - ((value / maxDataValue) * (255 - baseGreen)));
            return `rgb(0, ${greenValue}, 0)`;
        }

        const backgroundColors = jumlahDataKomoditas.map(value => getDarkGreen(value));
        var komoditasChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: komoditasName,
                datasets: [{
                    label: 'Jumlah Data Komoditas',
                    data: jumlahDataKomoditas,
                    backgroundColor: backgroundColors,
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
                        display: false, // Sembunyikan label sumbu Y
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
@endsection
