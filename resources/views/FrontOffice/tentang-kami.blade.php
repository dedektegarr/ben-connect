@extends('FrontOffice.layout.layout')
@section('title', 'Beranda')
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
    </style>

    <main id="main" style="background-image: url('{{ asset('assets/FrontOffice/img/bg.png') }}')">
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
                        <h1 class="text-dark text-capitalize" style="font-family: inter; font-weight:900;"><span
                                style="background: -webkit-linear-gradient(left,#028C45, #FCCD00); 
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;">Selamat
                                datang di BEN-CONNECT, aplikasi pusat kendali (command center) Provinsi Bengkulu</span></h1>
                        <p>Ben-CONNECT dirancang untuk membangun sinergi dan integrasi data di lingkungan Pemerintah
                            Provinsi Bengkulu. Kami hadir sebagai solusi inovatif untuk mempermudah akses, monitoring, dan
                            pengelolaan data lintas Organisasi Perangkat Daerah (OPD), demi mewujudkan tata kelola
                            pemerintahan yang lebih efektif dan efisien.</p>
                        <div class="row my-5">
                            <div class="col-md-6">
                            <img src="{{ asset('assets/FrontOffice/img/gubernur.png') }}" class="img-fluid" width="600" height="600" alt="">
                            </div>
                            <div class="col-md-6">
                                <h4>Visi</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <i class="ri-checkbox-circle-fill my-auto"></i>
                                        <p class="d-inline">Menjadi platform data terintegrasi yang handal dan inovatif
                                            dalam mendukung tata kelola pemerintahan yang transparan, efisien, dan
                                            berorientasi pada pelayanan publik.</p>
                                        <hr>
                                    </div>
                                </div>
                                <p></p>
                                <h4>Misi:</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <i class="ri-checkbox-circle-fill my-auto"></i>
                                        <p class="d-inline">Mewujudkan keterpaduan data antar-OPD di lingkungan Pemerintah
                                            Provinsi Bengkulu.</p>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <i class="ri-checkbox-circle-fill my-auto"></i>
                                        <p class="d-inline">Memperkuat pengambilan keputusan berbasis data yang akurat dan
                                            real-time.</p>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <i class="ri-checkbox-circle-fill my-auto"></i>
                                        <p class="d-inline">Meningkatkan kolaborasi antara OPD dan masyarakat melalui
                                            transparansi informasi.
                                        </p>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <i class="ri-checkbox-circle-fill my-auto"></i>
                                        <p class="d-inline">Mengoptimalkan penggunaan teknologi informasi dalam pelayanan
                                            publik
                                        </p>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card" style="background: -webkit-linear-gradient(left,#028C45, #FCCD00); ">
                            <div class="card-body text-white">
                                <h1>Apa Itu BEN-CONNECT?</h1>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>BEN-CONNECT adalah platform digital yang mengintegrasikan berbagai sumber data
                                            dari OPD di Provinsi Bengkulu ke dalam satu pusat kendali yang terkoordinasi.
                                            Melalui aplikasi ini, Pemerintah Provinsi dapat:
                                            <br>

                                            1. Monitoring Kinerja: Memantau secara real-time kinerja dari berbagai instansi
                                            pemerintah.
                                            <br>
                                            2. Integrasi Data: Menyatukan data dari berbagai sektor seperti kesehatan,
                                            pendidikan, infrastruktur, dan lainnya dalam satu sistem terpadu.
                                            <br>
                                            3. Pengambilan Keputusan: Mendukung pengambilan keputusan yang lebih cepat dan
                                            akurat berdasarkan data yang tersedia.
                                            <br>
                                            4. Pelaporan Publik: Memberikan informasi terbuka dan transparan kepada
                                            masyarakat mengenai kinerja pemerintah daerah.
                                            <br>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Keunggulan BEN-CONNECT
                                            <br>
                                            1. Real-Time Monitoring: Data yang terintegrasi memungkinkan pemantauan yang
                                            lebih efektif terhadap aktivitas OPD.
                                            <br>
                                            2. Data yang Akurat: Semua data yang diolah adalah data resmi dari sumber yang
                                            terpercaya, sehingga memastikan akurasi dan validitas informasi.
                                            <br>
                                            3. Transparansi: Masyarakat dapat mengakses informasi terkait kinerja pemerintah
                                            daerah dengan lebih mudah, mendukung prinsip pemerintahan yang transparan.
                                            <br>
                                            4. Kolaborasi Antar OPD: Mendorong kerja sama yang lebih solid antar instansi
                                            pemerintah dalam berbagi data dan informasi.
                                            <br>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-5">
                        <h1>Tim Kami</h1>
                        <div class="row">
                            <div class="col-lg-6">
                                <P>BEN-CONNECT dikembangkan oleh Dinas Komunikasi, Informatika, dan Statistik Provinsi
                                    Bengkulu dengan dukungan berbagai ahli teknologi informasi dan data dari sektor publik
                                    dan swasta. Kami bekerja sama untuk mewujudkan layanan terbaik yang dapat diakses dan
                                    dimanfaatkan oleh semua pemangku kepentingan, baik di lingkungan pemerintah maupun
                                    masyarakat umum.

                                    Dengan adanya BEN-CONNECT, kami berkomitmen untuk membangun pemerintahan yang lebih baik
                                    dan transparan di Provinsi Bengkulu, dengan data sebagai pondasi utama dalam pengambilan
                                    keputusan.

                                    Jika Anda memiliki pertanyaan atau ingin mengetahui lebih lanjut tentang platform kami,
                                    silakan hubungi kami melalui kontak yang tersedia di situs ini.</P>
                            </div>
                            <div class="col-lg-6">
                                <img src="{{ asset('assets/FrontOffice/img/logo-depan.png') }}" class="img-fluid my-auto"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End About Section -->
    </main><!-- End #main -->


@endsection
