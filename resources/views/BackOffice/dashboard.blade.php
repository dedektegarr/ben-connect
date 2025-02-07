@extends('BackOffice.layout.layout1')
@section('title', 'Dashboard')
@section('main')
<<<<<<< HEAD
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h1>Selamat Datang, {{ Auth::user()->name }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Kotak -->
                <div class="col-md-3 mb-0">
                    <div class="card" style="border-radius:20px;">
                        <div class="card-body">
                            <a href="">
                                <p class="card-text">Kategori</p>
                                <h5 class="card-title">WEB PROV BKL</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Kotak -->
                <!-- Kotak -->
                <div class="col-md-3 mb-0">
                    <div class="card" style="border-radius:20px;">
                        <div class="card-body">
                            <a href="">
                                <p class="card-text">Kategori</p>
                                <h5 class="card-title">E PRESENSI</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Kotak -->
                <!-- Kotak -->
                <div class="col-md-3 mb-0">
                    <div class="card" style="border-radius:20px;">
                        <div class="card-body">
                            <a href="">
                                <p class="card-text">Kategori</p>
                                <h5 class="card-title">E LAPOR</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Kotak -->
                <!-- Kotak -->
                <div class="col-md-3 mb-0">
                    <div class="card" style="border-radius:20px;">
                        <div class="card-body">
                            <a href="">
                                <p class="card-text">Kategori</p>
                                <h5 class="card-title">PPID</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Kotak -->
                <!-- Kotak -->
                <div class="col-md-3 mb-0">
                    <div class="card" style="border-radius:20px;">
                        <div class="card-body">
                            <a href="">
                                <p class="card-text">Kategori</p>
                                <h5 class="card-title">EIS</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Kotak -->
                <!-- Kotak -->
                <div class="col-md-3 mb-0">
                    <div class="card" style="border-radius:20px;">
                        <div class="card-body">
                            <a href="">
                                <p class="card-text">Kategori</p>
                                <h5 class="card-title">E-STATISTIK</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Kotak -->
                <!-- Kotak -->
                <div class="col-md-3 mb-0">
                    <div class="card" style="border-radius:20px;">
                        <div class="card-body">
                            <a href="">
                                <p class="card-text">Kategori</p>
                                <h5 class="card-title">LAYANAN E-GOV</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Kotak -->
                <!-- Kotak -->
                <div class="col-md-3 mb-0">
                    <div class="card" style="border-radius:20px;">
                        <div class="card-body">
                            <a href="">
                                <p class="card-text">Kategori</p>
                                <h5 class="card-title">COVID 19</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Kotak -->
            </div>
        </div>
=======
    <div style="margin-left: 5rem; margin-top:5rem">
        {{ Auth::user()->hasRole('admin') }}
>>>>>>> auth-api
    </div>
@endsection
