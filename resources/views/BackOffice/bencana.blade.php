@extends('BackOffice.layout.layout')
@section('title', 'bencana')
@section('main')
    <div class="row">
        <div class="col-md-6">
            <div class="card content-card" style="margin-top:40px; width:350px;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Filter</h5>
                    <hr>
                    <form action="{{ route('bencana') }}" method="get">
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
                    <div class="card content-card float-end" style="margin-top:40px; width:350px;">
                        <div class="card-body">
                            <h5 class="card-title">Data Bencana di Provinsi Bengkulu
                            </h5>
                            <hr>
                            <canvas id="bencanaChart" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    label: 'Total Bencana',
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
