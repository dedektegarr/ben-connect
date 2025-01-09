@extends('FrontOffice.layout.layout')
@section('title', 'Beranda')
@section('main')
    <style>
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
                    -webkit-text-fill-color: transparent;">Help
                                & Feedback</span></h1>
                        <p>Terima kasih telah menggunakan BEN-CONNECT! Kami berkomitmen untuk memberikan pengalaman terbaik
                            dalam mengakses dan mengelola data di lingkungan Pemerintah Provinsi Bengkulu. Jika Anda
                            memerlukan bantuan atau ingin memberikan umpan balik, berikut adalah cara-cara untuk mendapatkan
                            dukungan dan berkomunikasi dengan kami.</p>
                        <div class="row my-5">
                            <div class="col-md-12">
                                <h3 class="text-dark text-capitalize" style="font-family: inter; font-weight:900;"><span
                                        style="background: -webkit-linear-gradient(left,#028C45, #FCCD00); 
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;">Bantuan
                                        Teknis</span></h3>
                                <p>Jika Anda mengalami kesulitan atau masalah teknis dalam menggunakan BEN-CONNECT, kami
                                    menyediakan beberapa opsi bantuan:
                                </p>
                            </div>
                            <div class="col-md-4 g-3">
                                <div class="card-layanan" style="background-color: #fff">
                                    <div class="card-layanan-frame" style="max-width:100%">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36"
                                            height="36" fill="currentColor">
                                            <path
                                                d="M5.45455 15L1 18.5V3C1 2.44772 1.44772 2 2 2H17C17.5523 2 18 2.44772 18 3V15H5.45455ZM4.76282 13H16V4H3V14.3851L4.76282 13ZM8 17H18.2372L20 18.3851V8H21C21.5523 8 22 8.44772 22 9V22.5L17.5455 19H9C8.44772 19 8 18.5523 8 18V17Z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="card-layanan-frame1" style="max-width:100%">
                                        <div class="card-layanan-text">
                                            <h3 class="fw-bold">Pertanyaan Umum (FAQ)</h3>
                                        </div>
                                        <div class="card-layanan-text2">
                                            <p class="card-layanan-text3">
                                                Untuk pertanyaan yang sering ditanyakan, Anda bisa mengunjungi halaman [FAQ]
                                                kami. Di sini, kami telah mengumpulkan berbagai pertanyaan yang sering
                                                muncul terkait penggunaan BEN-CONNECT dan solusi yang bisa Anda coba.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 g-3">
                                <div class="card-layanan" style="background-color: #fff">
                                    <div class="card-layanan-frame" style="max-width:100%">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36"
                                            height="36" fill="currentColor">
                                            <path
                                                d="M13 21V23H11V21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H9C10.1947 3 11.2671 3.52375 12 4.35418C12.7329 3.52375 13.8053 3 15 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H13ZM20 19V5H15C13.8954 5 13 5.89543 13 7V19H20ZM11 19V7C11 5.89543 10.1046 5 9 5H4V19H11Z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="card-layanan-frame1" style="max-width:100%">
                                        <div class="card-layanan-text">
                                            <h3 class="fw-bold">Panduan Pengguna</h3>
                                        </div>
                                        <div class="card-layanan-text2">
                                            <p class="card-layanan-text3">
                                                Silakan kunjungi [Pusat Bantuan] untuk melihat panduan langkah demi langkah
                                                penggunaan BEN-CONNECT. Di sana, Anda akan menemukan jawaban atas pertanyaan
                                                umum, serta instruksi detail terkait fitur-fitur aplikasi kami.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 g-3">
                                <div class="card-layanan" style="background-color: #fff">
                                    <div class="card-layanan-frame" style="max-width:100%">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36"
                                            height="36" fill="currentColor">
                                            <path
                                                d="M22 17.0022C21.999 19.8731 19.9816 22.2726 17.2872 22.8616L16.6492 20.9476C17.8532 20.7511 18.8765 20.0171 19.4649 19H17C15.8954 19 15 18.1046 15 17V13C15 11.8954 15.8954 11 17 11H19.9381C19.446 7.05369 16.0796 4 12 4C7.92038 4 4.55399 7.05369 4.06189 11H7C8.10457 11 9 11.8954 9 13V17C9 18.1046 8.10457 19 7 19H4C2.89543 19 2 18.1046 2 17V12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12V12.9987V13V17V17.0013V17.0022ZM20 17V13H17V17H20ZM4 13V17H7V13H4Z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="card-layanan-frame1" style="max-width:100%">
                                        <div class="card-layanan-text">
                                            <h3 class="fw-bold">Hubungi Tim Dukungan</h3>
                                        </div>
                                        <div class="card-layanan-text2">
                                            <p class="card-layanan-text3">
                                                Jika Anda membutuhkan bantuan langsung, Anda bisa menghubungi tim dukungan
                                                kami;
                                                <br>
                                                <br>
                                                Email: diskominfotik@bengkuluprov.go.id
                                                <br>
                                                Telepon: (0736) 7325176 (Senin - Jumat, 09:00 - 17:00 WIB)
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-md-12">
                                <h3 class="text-dark text-capitalize" style="font-family: inter; font-weight:900;"><span
                                        style="background: -webkit-linear-gradient(left,#028C45, #FCCD00); 
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;">Memberikan
                                        Umpan Balik</span></h3>
                                <p>Kami sangat menghargai setiap masukan yang Anda berikan untuk membantu kami meningkatkan
                                    layanan BEN-CONNECT. Berikut adalah cara untuk memberikan umpan balik:
                                </p>
                            </div>
                            <div class="col-md-4 g-3">
                                <div class="card-layanan" style="background-color: #fff">
                                    <div class="card-layanan-frame" style="max-width:100%">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36"
                                            height="36" fill="currentColor">
                                            <path
                                                d="M5.45455 15L1 18.5V3C1 2.44772 1.44772 2 2 2H17C17.5523 2 18 2.44772 18 3V15H5.45455ZM4.76282 13H16V4H3V14.3851L4.76282 13ZM8 17H18.2372L20 18.3851V8H21C21.5523 8 22 8.44772 22 9V22.5L17.5455 19H9C8.44772 19 8 18.5523 8 18V17Z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="card-layanan-frame1" style="max-width:100%">
                                        <div class="card-layanan-text">
                                            <h3 class="fw-bold">Formulir Umpan Balik</h3>
                                        </div>
                                        <div class="card-layanan-text2">
                                            <p class="card-layanan-text3">
                                                Anda bisa mengirimkan umpan balik Anda secara langsung melalui [Formulir
                                                Umpan Balik]. Kami akan meninjau setiap masukan yang diterima dan berupaya
                                                untuk menindaklanjutinya dalam pengembangan platform di masa depan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 g-3">
                                <div class="card-layanan" style="background-color: #fff">
                                    <div class="card-layanan-frame" style="max-width:100%">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36"
                                            height="36" fill="currentColor">
                                            <path
                                                d="M13 21V23H11V21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H9C10.1947 3 11.2671 3.52375 12 4.35418C12.7329 3.52375 13.8053 3 15 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H13ZM20 19V5H15C13.8954 5 13 5.89543 13 7V19H20ZM11 19V7C11 5.89543 10.1046 5 9 5H4V19H11Z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="card-layanan-frame1" style="max-width:100%">
                                        <div class="card-layanan-text">
                                            <h3 class="fw-bold">Survei Pengguna</h3>
                                        </div>
                                        <div class="card-layanan-text2">
                                            <p class="card-layanan-text3">
                                                Bantu kami untuk terus berkembang dengan berpartisipasi dalam survei
                                                kepuasan pengguna. Kami secara rutin melakukan survei untuk mengetahui
                                                bagaimana kami dapat meningkatkan layanan kami lebih lanjut
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 g-3">
                                <div class="card-layanan" style="background-color: #fff">
                                    <div class="card-layanan-frame" style="max-width:100%">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36"
                                            height="36" fill="currentColor">
                                            <path
                                                d="M22 17.0022C21.999 19.8731 19.9816 22.2726 17.2872 22.8616L16.6492 20.9476C17.8532 20.7511 18.8765 20.0171 19.4649 19H17C15.8954 19 15 18.1046 15 17V13C15 11.8954 15.8954 11 17 11H19.9381C19.446 7.05369 16.0796 4 12 4C7.92038 4 4.55399 7.05369 4.06189 11H7C8.10457 11 9 11.8954 9 13V17C9 18.1046 8.10457 19 7 19H4C2.89543 19 2 18.1046 2 17V12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12V12.9987V13V17V17.0013V17.0022ZM20 17V13H17V17H20ZM4 13V17H7V13H4Z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="card-layanan-frame1" style="max-width:100%">
                                        <div class="card-layanan-text">
                                            <h3 class="fw-bold">Saran dan Keluhan</h3>
                                        </div>
                                        <div class="card-layanan-text2">
                                            <p class="card-layanan-text3">
                                                Jika Anda memiliki saran atau keluhan spesifik terkait penggunaan
                                                BEN-CONNECT, kirimkan email langsung kepada kam
                                                <br>
                                                Email Saran & Keluhan: diskominfotik@bengkuluprov.go.id
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-dark text-capitalize" style="font-family: inter; font-weight:900;"><span
                                        style="background: -webkit-linear-gradient(left,#028C45, #FCCD00); 
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;">Memberikan
                                        Umpan Balik</span></h3>
                                <p>Kami sangat menghargai setiap masukan yang Anda berikan untuk membantu kami meningkatkan
                                    layanan BEN-CONNECT. Berikut adalah cara untuk memberikan umpan balik:
                                </p>
                            </div>
                            <div class="col-md-12">
                                <p>
                                    Jika Anda menemukan kesalahan atau bug pada sistem BEN-CONNECT, Anda bisa melaporkannya
                                    langsung kepada tim pengembangan kami. Harap lampirkan deskripsi lengkap masalah yang
                                    Anda temukan, serta tangkapan layar jika memungkinkan, untuk membantu kami memperbaiki
                                    bug tersebut secepat mungkin.
                                    <br>
                                    <br>
                                    <b> Email Laporan Bug: diskominfotik@bengkuluprov.go.id </b>
                                    <br>
                                    Kami sangat menghargai partisipasi Anda dalam membantu kami menjadikan BEN-CONNECT
                                    platform yang lebih baik dan lebih bermanfaat bagi semua pengguna. Jangan ragu untuk
                                    menghubungi kami kapan saja!
                                    <br>
                                    <br>
                                    <b>Terima kasih telah menjadi bagian dari inisiatif digitalisasi di Provinsi Bengkulu :)
                                    </b>

                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section><!-- End About Section -->
    </main><!-- End #main -->


@endsection
