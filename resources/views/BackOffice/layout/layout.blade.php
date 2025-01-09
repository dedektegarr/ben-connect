<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Provinsi Bengkulu</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/leaflet.ajax.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/my-custom.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-4 up-to-front">
                <div class="form-check form-switch">
                    <form action="{{ route('mode') }}" method="post">
                        @csrf
                        <input class="form-check-input" onchange="this.form.submit()" type="checkbox" role="switch"
                            id="flexSwitchCheckDefault" style="height: 30px; width:50px;"
                            @if (session('mode') == 'dark') checked @endif>
                    </form>
                </div>
            </div>
            <div class="col-md-8 up-to-front">
                <img src="{{ asset('assets/Logo.png') }}" class="float-end mt-3 pr-4" style="width: 160px;"
                    alt="">
            </div>
        </div>
        @yield('main')
        @include('BackOffice.layout.nav-card')
    </div>
    <div id="map"></div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<!-- jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "pageLength": 5 // DataTables options (if needed)
        });
    });
</script>

@if (session('mode') == 'dark')
    @php
        $mode = 'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png';
    @endphp
@else
    @php
        $mode = 'https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png';
    @endphp
@endif

@if (Route::is('kesehatan_maps'))
    <script>
        var map = L.map('map').setView([-3.8000, 102.2667], 13);

        L.tileLayer('{{ $mode }}', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var greenIcon = L.icon({
            iconUrl: '{{ asset('assets/rumah_sakit.png') }}',
            iconSize: [20, 25], // size of the icon
            iconAnchor: [18, 25], // point of the icon which will correspond to marker's location
            popupAnchor: [-3, -36] // point from which the popup should open relative to the iconAnchor
        });


        fetch("{{ asset('assets/data_json/kesehatan/rumah_sakit.json') }}")
            .then(response => response.json())
            .then(data => {
                data.forEach(function(rumahSakit) {
                    var lat = rumahSakit.lat;
                    var long = rumahSakit.long;
                    var nama = rumahSakit.Nama_Rumah_Sakit;
                    var jenis = rumahSakit.Jenis_RS;
                    var kelas = rumahSakit.Kelas_RS;
                    var pemilik = rumahSakit.Pemilik;
                    var ranjang = rumahSakit.Total_Ranjang;
                    L.marker([lat, long], {
                            icon: greenIcon
                        })
                        .addTo(map)
                        .bindPopup(
                            `<div class="popup-card">
                    <h4>${nama}</h4>
                    <div class="line"></div>
                    <div class="text-wrapper">
                        <div class="row">
                            <div class="col-md-6">
                                <p><b>Jenis RS:</b> ${jenis}</p>
                            </div>
                            <div class="col-md-6">
                                <p><b>Kelas RS:</b> ${kelas}</p>
                            </div>
                            <div class="col-md-6">
                                <p><b>Pemilik:</b> ${pemilik}</p>
                            </div>
                            <div class="col-md-6">
                                <p><b>Total Ranjang:</b> ${ranjang}</p>
                            </div>
                        </div>
                    </div>
                </div>`
                        );
                });
            });
    </script>
@elseif(Route::is('kependudukan'))
    <script>
        var selectedKabupaten = @json($selectedKabupaten);

        var map = L.map('map').setView([-3.8000, 102.2667], 8);

        L.tileLayer('{{ $mode }}', {
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
@elseif(Route::is('komoditas'))
    <script>
        var map = L.map('map').setView([-3.8000, 102.2667], 13);

        L.tileLayer('{{ $mode }}', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var greenIcon = L.icon({
            iconUrl: '{{ asset('assets/toko.png') }}',
            iconSize: [20, 25], // size of the icon
            iconAnchor: [18, 25], // point of the icon which will correspond to marker's location
            popupAnchor: [-3, -36] // point from which the popup should open relative to the iconAnchor
        });

        const urlParams = new URLSearchParams(window.location.search);
        const pasar = urlParams.get('pasar');

        fetch("{{ asset('assets/data_json/komoditas/pasar.json') }}")
            .then(response => response.json())
            .then(data => {
                if (pasar) {
                    data = data.filter(d => d.pasar.toLowerCase() === pasar)

                    data.forEach(function(pasar) {
                        var lat = pasar.latitude;
                        var long = pasar.longitude;
                        var nama = pasar.pasar;
                        L.marker([lat, long], {
                                icon: greenIcon
                            })
                            .addTo(map)
                            .bindPopup(
                                `<div class="popup-card">
                                <h4>Pasar ${nama}</h4>
                                <div class="line"></div>
                            </div>`
                            );
                    });
                } else {
                    data.forEach(function(pasar) {
                        var lat = pasar.latitude;
                        var long = pasar.longitude;
                        var nama = pasar.pasar;
                        L.marker([lat, long], {
                                icon: greenIcon
                            })
                            .addTo(map)
                            .bindPopup(
                                `<div class="popup-card">
                                <h4>Pasar ${nama}</h4>
                                <div class="line"></div>
                            </div>`
                            );
                    });
                }
            });
    </script>
@else
    <script>
        var selectedKabupaten = @json($selectedKabupaten ?? null);

        var map = L.map('map').setView([-3.8000, 102.2667], 8);

        L.tileLayer('{{ $mode }}', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var jsonTest = new L.GeoJSON.AJAX(["{{ asset('assets/kotaKabupatenBengkulu.geojson') }}"], {
            onEachFeature: function(feature, layer) {
                // Check if the current feature matches the selected Kabupaten/Kota
                if (selectedKabupaten === 'all' || feature.properties.Nama === selectedKabupaten) {
                    popUp(feature, layer);
                    layer.addTo(map); // Add the layer only if it matches
                }
            }
        });
    </script>
@endif

</html>
