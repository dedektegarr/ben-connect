@extends('BackOffice.layout.layout')
@section('title', 'Kependudukan')
@section('main')

    <div class="row">
        <div class="col-md-6">
            <div class="card content-card" style="margin-top:40px; width:350px;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Filter</h5>
                    <hr>
                    <form action="{{ route('kependudukan') }}" method="get">
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
                            <label for="jenis_data" class="form-label">Jenis Data</label>
                            <select class="form-select" name="jenis_data" id="jenis_data"
                                aria-label="Default select example">
                                <option value="indeks_angka_kemiskinan" @if (app('request')->input('jenis_data') == 'indeks_angka_kemiskinan') selected @endif>
                                    Indeks Angka Kemiskinan</option>
                                <option value="indeks_pembangunan_gender" @if (app('request')->input('jenis_data') == 'indeks_pembangunan_gender') selected @endif>
                                    Indeks Pembangunan Gender</option>
                                <option value="indeks_pembangunan_manusia"
                                    @if (app('request')->input('jenis_data') == 'indeks_pembangunan_manusia') selected @endif>Indeks Pembangunan Manusia</option>
                                <option value="indeks_pemberdayaan_gender"
                                    @if (app('request')->input('jenis_data') == 'indeks_pemberdayaan_gender') selected @endif>Indeks Pemberdayaan Gender</option>
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
    </div>

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
@endsection
