@extends('FrontOffice.dashboard.dashboard')
@section('title', 'Data Kependudukan di Provinsi Bengkulu')
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
                            <form action="{{ route('kependudukan.dashboard') }}" method="GET">
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
                                    <label for="tahun" class="form-label">Tahun Data</label>
                                    <select class="form-control" name="tahun" id="tahun"
                                        aria-label="Default select example">
                                        <option value="2023" @if (app('request')->input('tahun') == '2022') selected @endif>
                                            2023</option>
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
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">PERSENTASE KEPEMILIKAN AKTA KELAHIRAN ANAK USIA 0-18 TAHUN SEMESTER I
                                TAHUN 2024</h2>
                            <hr>
                            <table id="example" class="display table table-responsive"
                                style="width:100%;background-color: transparent; display:table;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Wilayah</th>
                                        <th>Jumlah Penduduk</th>
                                        <th>Ada</th>
                                        <th>Tidak Ada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($akta as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item['nama_daerah'] }}</td>
                                            <td>{{ $item['jumlah_penduduk'] }}</td>
                                            <td>{{ $item['ada'] }}</td>
                                            <td>{{ $item['tidak_ada'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        var jsonData = @json($akta);

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
                         <b>Jumlah_penduduk : ${info.jumlah_penduduk}</b>
                         <br>
                         <b>ada : ${info.ada}</b>
                         <br>
                         <b>tidak_ada : ${info.tidak_ada}</b>
                         <br>
                         <b>Tahun : ${info.tahun}</b>
                     </p>
                 </div>
             </div>`);
            } else {
                layer.bindPopup("<b>" + daerah + "</b><br>Data tidak tersedia.");
            }
        }
    </script>




@endsection
