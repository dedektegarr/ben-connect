@extends('admin.layouts.app')

@section('title', 'Data IKM')
@section('content')
<x-panel.panel>
    <x-panel.panel-header title="{{ __('Data Industri Kecil Menengah') }}">
        <div class="flex items-center gap-2">
            <div id="import-modal" class="hidden"></div>
            <button type="button" data-modal-target="import-modal" data-modal-toggle="import-modal"
                class="md:inline-flex text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 text-center items-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-5h7.586l-.293.293a1 1 0 0 0 1.414 1.414l2-2a1 1 0 0 0 0-1.414l-2-2a1 1 0 0 0-1.414 1.414l.293.293H4V9h5a2 2 0 0 0 2-2Z"
                        clip-rule="evenodd" />
                </svg>
                <span class="hidden lg:block lg:ms-2">{{ __('Impor') }}</span>

            </button>
            <button type="button"
                class="md:inline-flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>
                <span class="hidden lg:block lg:ms-2">{{ __('Tambah Data') }}</span>
            </button>
        </div>

    </x-panel.panel-header>
    <x-panel.panel-body>
    <div
    class="overflow-hidden rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
    <table id="default-table">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th>
                            <span class="flex items-center">
                                Nama Perusahaan
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                        <th>

                            <span class="flex items-center">
                                Nama Pemilik
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Kontak Person
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Sentra
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                              Alamat
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Bentuk Badan Usaha
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Nomor Izin
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Kode KBLI
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Jenis Produk
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                cabang Industri
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Jumlah Tenaga Kerja
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </span>
                        </th>


                    </tr>
                </thead>
                <tbody>
                    <!-- Baris Utama -->
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            ANEKA KRIPIK SUKA JAYA
                        </th>
                        <td class="px-6 py-4">SITI SULASTRI</td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4">Aneka Kripik Sukajaya </td>
                        <td class="px-6 py-4">
                            <button onclick="toggleDetail(this)" class="text-blue-600 underline">Lihat Alamat</button>
                        </td>
                        <td class="px-6 py-4">PO</td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4">10794</td>
                        <td class="px-6 py-4">Keripik Pisang, Salai Pisang dan Sejenisnya</td>
                        <td class="px-6 py-4">PANGAN</td>
                        <td class="px-6 py-4">2</td>
                    </tr>
                    <tr class="alamat-detail hidden">
                        <td colspan="11" class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                            <strong>Jalan:</strong> Jl. Lintas Barat Sumatera, <br>
                            <strong>Desa/Kelurahan:</strong> Suka Jaya, <br>
                            <strong>Kecamatan:</strong> Kedurang Ilir, <br>
                            <strong>Kab/Kota:</strong> Kabupaten Bengkulu Selatan.
                        </td>
                    </tr>

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            BATU BATA PASAR PINO
                        </th>
                        <td class="px-6 py-4">EMRON</td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4">Pasar Pino</td>
                        <td class="px-6 py-4">
                            <button onclick="toggleDetail(this)" class="text-blue-600 underline">Lihat Alamat</button>
                        </td>
                        <td class="px-6 py-4">PO</td>
                        <td class="px-6 py-4">-</td>
                        <td class="px-6 py-4">23921</td>
                        <td class="px-6 py-4">BATU BATA</td>
                        <td class="px-6 py-4">KIMIA</td>
                        <td class="px-6 py-4">2</td>
                    </tr>
                    <tr class="alamat-detail hidden">
                        <td colspan="11" class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                            <strong>Jalan:</strong> Jl. Raya Pasar Pino, <br>
                            <strong>Desa/Kelurahan:</strong> Pasar Pino, <br>
                            <strong>Kecamatan:</strong> Pino Raya, <br>
                            <strong>Kab/Kota:</strong> Kabupaten Bengkulu Selatan.
                        </td>
                    </tr>

                    <!-- Add additional rows for other companies -->
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            BATU BATA PASAR PINO
                        </th>
                        <td class="px-6 py-4">RAHIN</td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4">Gedung Agung</td>
                        <td class="px-6 py-4">
                            <button onclick="toggleDetail(this)" class="text-blue-600 underline">Lihat Alamat</button>
                        </td>
                        <td class="px-6 py-4">PO</td>
                        <td class="px-6 py-4">-</td>
                        <td class="px-6 py-4">10722</td>
                        <td class="px-6 py-4">GULA AREN</td>
                        <td class="px-6 py-4">PANGAN</td>
                        <td class="px-6 py-4">2</td>
                    </tr>
                    <tr class="alamat-detail hidden">
                        <td colspan="11" class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                            <strong>Jalan:</strong> Jl. Raya Gedung Agung, <br>
                            <strong>Desa/Kelurahan:</strong> Gedung Agung, <br>
                            <strong>Kecamatan:</strong> Pino, <br>
                            <strong>Kab/Kota:</strong> Kabupaten Bengkulu Selatan.
                        </td>
                    </tr>

                    <!-- Repeat similar structure for the remaining data entries -->

                </tbody>
            </table>
        </div>
    </x-panel.panel-body>

    <script>
        function toggleDetail(button) {
            // Find the row containing the details
            let row = button.closest('tr').nextElementSibling;

            // Toggle the visibility of the row
            row.classList.toggle('hidden');
        }
    </script>
        <script>
            function toggleDetail(button) {
                let detailRow = button.closest('tr').nextElementSibling;
                detailRow.classList.toggle('hidden');
            }
        </script>


</x-panel.panel>

@endsection
@push('scripts')
    {{-- <script>
        const errors = @json($errors->any());

        document.addEventListener("DOMContentLoaded", function() {
            const modalEl = document.getElementById("import-modal");
            const modal = new Modal(modalEl, {}, {
                id: 'modalEl',
                override: true
            });

            if (errors) {
                modal.show();
            }

        });
    </script> --}}
@endpush
