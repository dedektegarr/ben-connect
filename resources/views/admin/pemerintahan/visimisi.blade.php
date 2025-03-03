@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('content')
    <x-panel.panel class="w-full">
        <x-panel.panel-header title="DASHBOARD COMMAND CENTER" />
        <x-panel.panel-body class="w-full p-10 bg-gray-900 rounded-lg shadow-lg">

            <div class="flex flex-col md:flex-row items-center border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">

                <!-- Bagian Foto -->
                <img class="object-cover w-full md:w-1/2 rounded-t-lg md:rounded-none md:rounded-l-lg self-start"
                     src="{{ asset('assets/FrontOffice/img/gubernur1.png') }}" alt="Gubernur Bengkulu">

                <!-- Bagian Visi Misi -->
                <div class="flex flex-col justify-between p-10 leading-normal w-full md:w-2/3">
                    <h5 class="mb-4 text-4xl font-extrabold tracking-wide text-[#2f46a2] dark:text-[#2f46a2]">VISI</h5>
                    <p class="mb-6 text-lg text-gray-700 dark:text-gray-300">Bengkulu Maju, Religius, Sejahtera, dan Berkelanjutan.</p>

                    <h5 class="mb-4 text-4xl font-extrabold tracking-wide text-[#2f46a2] dark:text-[#2f46a2]">MISI</h5>
                    <ul class="list-disc pl-6 space-y-4 text-lg text-gray-700 dark:text-gray-300">

                        <li>Fokus pada membangun Bengkulu yang berbasis religiusitas, kesejahteraan sosial, dan keberlanjutan ekonomi.</li>
                        <li>Mengutamakan pemerintahan yang bersih dan akuntabel dengan pembangunan SDM berbasis pengetahuan dan teknologi.</li>
                        <li>Program percepatan peningkatan kualitas jalan dan jembatan melalui program Jalan Mulus.</li>
                        <li>Ambulance gratis di setiap desa dan moda angkutan darat gratis di setiap kabupaten/kota.</li>
                         <li>Pembangunan stadion bertaraf internasional dan fasilitas olahraga yang memadai. Menjamin seluruh rakyat Bengkulu mendapatkan BPJS Kesehatan untuk mewujudkan UHC.</li>
                        <li>Menurunkan harga BBM non-subsidi demi membantu meringankan beban masyarakat. Menyediakan program santunan untuk anak yatim serta memperkuat ekonomi kerakyatan berbasis UMKM.</li>
                        <li>Fokus pada peningkatan kesejahteraan petani dan nelayan melalui bantuan bibit, peralatan, serta stabilitas harga dengan membangun pusat pengolahan agropolitan.</li>
                        <li>Pemberdayaan desa dengan penguatan BUMDes, desa wisata, dan one village-one product.</li>
                        <li>Menciptakan keselarasan pembangunan ekonomi pada sektor pertanian, perkebunan, perikanan, kelautan, pariwisata, dan pertambangan dengan mengutamakan hilirisasi yang berkelanjutan.</li>
                        <li>Program-program UMKM dan BUMDes untuk meningkatkan kemandirian ekonomi di tingkat desa.</li>
                    </ul>
                </div>

            </div>

        </x-panel.panel-body>
    </x-panel.panel>
@endsection

