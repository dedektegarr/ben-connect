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
        #header {
        transition: all 0.5s;
        z-index: 997;
        padding: 20px 0;
        background-color: #27445D;
        }
        
    </style>

    <main id="main" style="background-image:#ffff">
        <!-- ======= About Section ======= -->
        <section id="about" class="about" style="background-color:transparent">
            <div class="container">
                <style>
                    .card-layanan:hover {
                        box-shadow: 1px 8px 20px grey;
                        -webkit-transition: box-shadow .6s ease-in;
                    }
                </style>
                <div class="row content" style="margin-top: 80px; text-align: justify;">
                    <div class="container">
                        <h1 class="text-dark text-capitalize" style="font-family: inter; font-weight:900;"><span                                style="background: -webkit-linear-gradient(left,black,rgb(0, 0, 0)
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;">Syarat
                                dan Ketentuan Penggunaan BEN-CONNECT</span></h1>
                        <p>Selamat datang di BEN-CONNECT, platform resmi untuk sinergi integrasi data di lingkungan
                            Pemerintah
                            Provinsi Bengkulu. Dengan menggunakan layanan ini, Anda setuju untuk mematuhi syarat dan
                            ketentuan
                            berikut. Mohon baca dengan saksama.</p>
                        <div class="row my-3" style="border: 2px solid #CACACA; display: inline-block; border-radius: 20px; background-color:rgb(255, 255, 255); padding:20px 5px 20px 5px;">
                                <h4 style="font-weight:bold;">Syarat:</h4>
                                <div class="col">
                                    <ol>
                                        <li>
                                        <p class="d-inline">Dengan mengakses dan menggunakan BEN-CONNECT, Anda menyetujui
                                            untuk
                                            terikat dengan syarat dan ketentuan yang telah ditetapkan. Jika Anda tidak
                                            setuju dengan
                                            syarat-syarat ini, Anda tidak diperbolehkan menggunakan layanan ini.</p>
                                        </li>
                                            <hr>
                                        <li>
                                        <p class="d-inline">Semua data yang diintegrasikan melalui BEN-CONNECT merupakan
                                            data resmi
                                            dari Organisasi Perangkat Daerah (OPD) di lingkungan Pemerintah Provinsi
                                            Bengkulu.
                                            Pengguna diwajibkan menggunakan data sesuai dengan ketentuan hukum dan peraturan
                                            yang
                                            berlaku. Penggunaan data yang melanggar hukum atau tidak sah akan dikenakan
                                            tindakan
                                            sesuai dengan peraturan yang berlaku</p>
                                        </li>
                                            <hr>
                                        <li>
                                        <p class="d-inline">Konten dan layanan di BEN-CONNECT merupakan milik Pemerintah
                                            Provinsi
                                            Bengkulu dan dilindungi oleh undang-undang hak cipta yang berlaku. Pengguna
                                            tidak
                                            diizinkan menyalin, mendistribusikan, atau memodifikasi konten tanpa izin
                                            tertulis dari
                                            Pemerintah Provinsi Bengkulu.
                                        </p>
                                        </li>
                                        <hr>
                                        <li>
                                        <p class="d-inline">Kami berkomitmen untuk melindungi privasi pengguna. Data pribadi
                                            yang
                                            dikumpulkan melalui BEN-CONNECT akan digunakan sesuai dengan kebijakan privasi
                                            kami,
                                            yang menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi
                                            informasi
                                            pribadi Anda.
                                        </p>
                                        </li>
                                    </ol>
                                </div>
                            </div>

                        <div class="row my-3" style="border: 2px solid #CACACA; display: inline-block; border-radius: 20px; background-color:rgb(255, 255, 255); padding:20px 5px 20px 5px;">
                                <h4 style="font-weight:bold;">Ketentuan:</h4>
                                <div class="col">
                                    <ol>
                                        <li>
                                        <p class="d-inline">Pengguna bertanggung jawab untuk menjaga kerahasiaan informasi akun mereka, termasuk kata sandi dan akses ke BEN-CONNECT. Pemerintah Provinsi Bengkulu tidak bertanggung jawab atas segala kerugian yang timbul dari akses yang tidak sah ke akun pengguna.</p>
                                        </li>
                                            <hr>
                                        <li>
                                        <p class="d-inline">Pemerintah Provinsi Bengkulu tidak bertanggung jawab atas segala kerugian atau kerusakan yang diakibatkan oleh penggunaan atau ketidakmampuan untuk menggunakan BEN-CONNECT. Kami tidak menjamin bahwa layanan akan selalu bebas dari gangguan, kesalahan, atau virus.</p>
                                        </li>
                                            <hr>
                                        <li>
                                        <p class="d-inline">Kami berhak untuk mengubah syarat dan ketentuan ini kapan saja tanpa pemberitahuan sebelumnya. Perubahan akan segera berlaku setelah dipublikasikan di situs ini. Pengguna disarankan untuk secara berkala meninjau halaman ini untuk mengetahui perubahan terbaru.
                                        </p>
                                        </li>
                                        <hr>
                                        <li>
                                        <p class="d-inline">Syarat dan ketentuan ini diatur oleh hukum yang berlaku di Indonesia. Segala sengketa yang timbul sehubungan dengan penggunaan BEN-CONNECT akan diselesaikan sesuai dengan prosedur hukum yang berlaku di Indonesia.
                                        </p>
                                        </li>
                                    </ol>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </section><!-- End About Section -->
    </main><!-- End #main -->


@endsection
