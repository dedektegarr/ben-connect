@extends('FrontOffice.layout.layout')
@section('title', 'List Daftar OPD')
@section('main')
    <style>
        body {
            font-family: "inter";
        }

        .card-layanan {
            gap: 25px;
            width: 100%;
            display: flex;
            padding: 26px 35px;
            overflow: hidden;
            position: relative;
            box-sizing: border-box;
            align-items: flex-start;
            border-radius: 20px 20px 20px 20px;
            flex-direction: column;
            justify-content: space-between;
            background-color: #fff;
            border:3px solid #f7f7f7;
        }

        .card-layanan-frame,
        .card-layanan-frame1,
        .card-layanan1 {
            width: 100%;
            overflow: hidden;
            box-sizing: border-box;
            justify-content: flex-start;
        }

        .card-layanan-frame {
            gap: 6px;
            display: flex;
            position: relative;
            max-width: 250px;
            align-items: center;
        }

        .card-layanan-frame1,
        .card-layanan1 {
            max-width: 48px;
            align-items: flex-start;
            flex-direction: column;
        }

        .card-layanan-frame1 {
            gap: 15px;
            display: flex;
            position: relative;
            max-width: 250px;
        }

        .card-layanan-text,
        .card-layanan-text1 {
            margin-top: 0;
            text-align: left;
            margin-bottom: 0;
        }

        .card-layanan-text {
            width: 100%;
            max-width: 100%;
            min-height: auto;
        }

        .card-layanan-text1 {
            color: #081225;
            font-size: 31px;
            font-style: normal;
            font-family: "Inter", sans-serif;
            font-weight: 800;
            line-height: 37px;
            letter-spacing: 0;
            text-transform: none;
        }

        .card-layanan-text2 {
            width: 100%;
            max-width: 100%;
            margin-top: 0;
            min-height: 74px;
            text-align: left;
            margin-bottom: 0;
        }

        .card-layanan-text3 {
            color: #081225;
            font-size: 16px;
            font-style: normal;
            margin-top: 0;
            text-align: left;
            font-family: "Inter", sans-serif;
            font-weight: 400;
            line-height: 24px;
            margin-bottom: 0;
            letter-spacing: 0;
            text-transform: none;
        }

        .card-layanan-frame2 {
            gap: 10px;
            width: 100%;
            display: flex;
            overflow: hidden;
            position: relative;
            max-width: 250px;
            box-sizing: border-box;
            align-items: flex-start;
            justify-content: flex-start;
        }

        .card-layanan-text4 {
            width: 100%;
            max-width: auto;
            margin-top: 0;
            min-height: auto;
            text-align: left;
            margin-bottom: 0;
        }

        .card-layanan-text5 {
            color: #028c45;
            font-size: 16px;
            font-style: normal;
            margin-top: 0;
            text-align: left;
            font-family: "Inter", sans-serif;
            font-weight: 700;
            line-height: 24px;
            margin-bottom: 0;
            letter-spacing: 0;
            text-transform: none;
        }

        .card-layanan2 {
            width: 100%;
            overflow: hidden;
            max-width: 24px;
            box-sizing: border-box;
            align-items: flex-start;
            flex-direction: column;
            justify-content: flex-start;
        }

        .chart-container {
            display: flex;
            justify-content: center;
            /* Center secara horizontal */
            align-items: center;
            /* Center secara vertikal */
            max-height: 250px;
            height: 100%;
            /* Sesuaikan tinggi div */
        }

        #header {
        transition: all 0.5s;
        z-index: 997;
        padding: 20px 0;
        background-color: #27445D;
        }
        
    </style>

    <main id="main" style="background-image: #f7f7f7">
        <!-- ======= About Section ======= -->
        <section id="about" class="about" style="background-color:transparent">
            <div class="container">
                <style>
                    .card-layanan:hover {
                        box-shadow: 1px 8px 20px grey;
                        -webkit-transition: box-shadow .6s ease-in;
                    }
                </style>
                <div class="row content" style="margin-top: 80px;">
                    <div class="container">
                        <h1 class="text-dark text-capitalize" style="font-family: inter; font-weight:900; text-align:center;"><span
                                style="background: -webkit-linear-gradient(left,#000,rgb(0, 0, 0)); 
                                -webkit-background-clip: text;
                                -webkit-text-fill-color: transparent;">Data
                                List OPD di Provinsi Bengkulu</span></h1>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/bappeda.png') }}" class="img-fluid mx-auto"
                                    alt="bappeda.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">BAPPEDA</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Badan Perencanaan Pembangunan Daerah, disingkat Bappeda,
                                        merupakan unsur penunjang urusan pemerintahan Bidang Perencanaan ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://dukcapil.bengkulukota.go.id/layanan-dukcapil"
                                        class="card-layanan-text5">Detail <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/birobangda.png') }}"
                                    class="img-fluid mx-auto" alt="birobangda.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">BIROBANGDA</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Biro Administrasi Pembangunan mempunyai tugas perumusan
                                        kebijakan, koordinasi, pembinaan monitoring, pemantauan dan evaluasi pelaksanaan
                                        urusan pemerintahan ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="http://birobangda.bengkuluprov.go.id/" class="card-layanan-text5">Detail <i
                                            class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/bpbd.png') }}" class="img-fluid mx-auto"
                                    alt="bpbd.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">BPBD</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Focal Point penanggulangan bencana di tingkat provinsi dan
                                        kabupaten/kota adalah Badan Penanggulangan Bencana Daerah (BPBD) ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://bpbd.bengkuluprov.go.id/" class="card-layanan-text5">Detail <i
                                            class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/BPKD.png') }}" class="img-fluid mx-auto"
                                    alt="BPKD.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">BPKD</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        BPKD Provinsi Bengkulu merupakan salah satu organisasi
                                        perangkat daerah yang membantu Gubernur dan DPRD ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://bpkd.bengkuluprov.go.id/" class="card-layanan-text5">Detail <i
                                            class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/bppb.png') }}" class="img-fluid mx-auto"
                                    alt="bppb.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">BPPB</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Badan Penghubung Provinsi Bengkulu telah memiliki media
                                        informasi online ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://badanpenghubung.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/bpsdm.png') }}" class="img-fluid mx-auto"
                                    alt="bpsdm.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">BPSDM</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Badan Pengembangan Sumber Daya Manusia (BPSDM) Provinsi
                                        Bengkulu, menggelar Pendidikan dan Pelatihan (Diklat) ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://bengkuluprov.go.id/tag/bpsdm/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/desdm.png') }}" class="img-fluid mx-auto"
                                    alt="desdm.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">DESDM</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Dinas Energi Dan Sumber Daya Mineral mempunyai tugas pokok
                                        membantu Gubernur melaksanakan urusan pemerintahan ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://esdm.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/dikbud.png') }}" class="img-fluid mx-auto"
                                    alt="dikbud.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">DIKBUD</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Dinas Pendidikan dan Kebudayaan mempunyai tugas melaksanakan
                                        sebagaian urusan Pemerintahan Daerah ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://dikbud.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/dinkes.png') }}" class="img-fluid mx-auto"
                                    alt="dinkes.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">DINKES</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Bidang Program Pencegahan dan Pengendalian Penyakit Dinas
                                        Kesehatan Provinsi Bengkulu laksanakan Advokasi, Sosialisasi dan Koordinasi ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://dinkes.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/dinsos.png') }}"
                                    class="img-fluid mx-auto" alt="dinsos.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">DINSOS</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Dinas Sosial Kota Bengkulu ini dalam rangka mewujudkan visi
                                        Pemerintah Kota Bengkulu ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://dinsos.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/dishub.png') }}"
                                    class="img-fluid mx-auto" alt="dishub.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">DISHUB</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Dinas Perhubungan (DISHUB) merupakan unsur pelaksana
                                        Pemerintah Daerah di bidang Perhubungan yang ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://dishub.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/diskominfo.png') }}"
                                    class="img-fluid mx-auto" alt="diskominfo.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">DISKOMINFO</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Diskominfo merupakan unsur pelaksana urusan pemerintahan di
                                        bidang komunikasi, informatika, persandian dan statistik ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://diskominfotik.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/disperindag.png') }}"
                                    class="img-fluid mx-auto" alt="disperindag.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">DISPERINDAG</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Dinas Perindustrian dan Perdagangan mempunyai tugas membantu
                                        Bupati melaksanakan urusan pemerintahan daerah di bidang perindustrian perdagangan
                                        ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://disperindag.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/dkp.png') }}" class="img-fluid mx-auto"
                                    alt="dkp.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">DKP</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Dinas Perikanan mempunyai tugas melaksanakan urusan
                                        Pemerintahan Daerah di bidang Perikanan ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://dkp.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/dpmptsp.png') }}"
                                    class="img-fluid mx-auto" alt="dpmptsp.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">DPMPTSP</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu
                                        Provinsi Bengkulu yang merupakan turunan ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://dpmptsp.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/dpk.png') }}" class="img-fluid mx-auto"
                                    alt="dpk.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">DPK</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Dinas Kearsipan dan Perpustakaan merupakan unsur pelaksana
                                        urusan pemerintahan bidang kearsipan ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://perpusda.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/dpkh.png') }}" class="img-fluid mx-auto"
                                    alt="dpkh.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">DPKH</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Dinas Peternakan dan Kesehatan Hewan Provinsi Bengkulu telah
                                        menjadi bagian penting dari pengembangan sektor peternakan dan kesehatan ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://disnakkeswan.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/dpkpp.png') }}" class="img-fluid mx-auto"
                                    alt="dpkpp.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">DPKPP</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Pelaksanaan kebijakan teknis perencanaan, pembangunan,
                                        operasi dan pemeliharaan, pemantauan dan evaluasi ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://dpkpp.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/dpmd.png') }}" class="img-fluid mx-auto"
                                    alt="dpmd.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">DPMD</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Dinas Pemberdayaan Masyarakat dan Desa mempunyai tugas pokok
                                        membantu Bupati melaksanakan kewenangan daerah ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://dpmd.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/dtphp.png') }}" class="img-fluid mx-auto"
                                    alt="dtphp.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">DTPHP</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Dinas Tanaman Pangan Hortikultura dan Perkebunan (TPHP)
                                        Provinsi Bengkulu siap untuk mensukseskan Sensus Pertanian 2023 ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://dtphp.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/dukcapil.png') }}"
                                    class="img-fluid mx-auto" alt="dukcapil.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">DUKCAPIL</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Untuk menunjang terselenggaranya penyelenggaraan pelayanan
                                        publik yang tepat sasaran ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://dukcapil.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/inspektorat.png') }}"
                                    class="img-fluid mx-auto" alt="inspektorat.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">INSPEKTORAT</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Pengawasan penyelenggaraan urusan Pemerintahan Daerah oleh
                                        perangkat daerah. Evaluasi laporan kinerja dan akuntabilitas ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://inspektorat.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/kesbangpol.png') }}"
                                    class="img-fluid mx-auto" alt="kesbangpol.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">KESBANGPOL</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Badan Kesbangpol Provinsi Bengkulu bersama DPRD Provinsi
                                        Bengkulu terus ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://kesbangpol.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/m-yunus.png') }}"
                                    class="img-fluid mx-auto" alt="m-yunus.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">M YUNUS</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Rumah sakit RS Umum Daerah Dr. M. Yunus Bengkulu di Bengkulu.
                                        Temukan dan ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="https://rsudmyunus.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/pemkesra.png') }}"
                                    class="img-fluid mx-auto" alt="pemkesra.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">PEMKESRA</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        Biro Pemkesra Hantarkan Keberangkatan Kepala Biro Pemkesra
                                        Sebagai Jemaah Umroh Xtra Ekslusif Pemprov Bengkulu ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="http://pemkesra.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 g-3">
                        <div class="card-layanan" style="height: 550px;">
                            <div class="card-layanan-frame">
                                <img src="{{ asset('assets/FrontOffice/logo-opd/polpp.png') }}" class="img-fluid mx-auto"
                                    alt="polpp.png" style="max-width: 150px;">
                            </div>
                            <div class="card-layanan-frame1">
                                <div class="card-layanan-text">
                                    <h3 class="fw-bold">POLPP</h3>
                                </div>
                                <div class="card-layanan-text2">
                                    <p class="card-layanan-text3">
                                        SATUAN POLISI PAMONG PRAJA PROVINSI BENGKULU ORGANISASI
                                        PERANGKAT DAERAH YANG MELAYANI URUSAN BIDANG PEMERINTAHAN SERTA ...
                                    </p>
                                </div>
                            </div>
                            <div class="card-layanan-frame2">
                                <div class="card-layanan-text4">
                                    <a href="http://polpp.bengkuluprov.go.id/" class="card-layanan-text5">Detail
                                        <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- End About Section -->
    </main><!-- End #main -->


@endsection
