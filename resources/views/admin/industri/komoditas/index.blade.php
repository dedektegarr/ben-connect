@extends('admin.layouts.app')

@section('title', 'Data Komoditas')
@section('content')
<x-panel.panel>
    <x-panel.panel-header title="{{ __('Data Industri Kecil Menengah') }}">
        <div class="flex items-center gap-2">
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
        <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
            <table id="default-table" class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">Kode BPS 2023</th>
                        <th class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">Kabupaten Kota</th>
                        <th class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">Nama Variant</th>
                        <!-- Header tanggal akan ditambahkan secara dinamis oleh JavaScript -->
                    </tr>
                </thead>
                <tbody id="table-body">
                    <!-- Data akan dimasukkan secara dinamis melalui JavaScript -->
                </tbody>
            </table>
        </div>
    </x-panel.panel-body>
</x-panel.panel>
<!-- Modal Import Data -->
<div id="import-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="relative w-full max-w-md mx-auto mt-20">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold">Impor Data</h3>
            <input type="file" class="w-full mt-4 p-2 border rounded" />
            <div class="mt-4 flex justify-end">
                <button data-modal-hide="import-modal" class="px-4 py-2 bg-gray-500 text-white rounded">Tutup</button>
                <button class="ml-2 px-4 py-2 bg-blue-600 text-white rounded">Impor</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const tableHeadRow = document.querySelector("thead tr");
    const tableBody = document.getElementById("table-body");
    const currentDate = new Date();
    let dates = [];

    // Mengambil 4 tanggal terbaru dalam format DD/MM/YY
    for (let i = 0; i < 4; i++) {
        let date = new Date();
        date.setDate(currentDate.getDate() - (3 - i)); // Agar urutannya dari lama ke terbaru
        let formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: '2-digit' });
        dates.push(formattedDate);
    }

    // Menambahkan header tanggal ke tabel
    dates.forEach(date => {
        let th = document.createElement("th");
        th.className = "text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400";
        th.innerText = date;
        tableHeadRow.appendChild(th);
    });

    // Data contoh
    const data = [
        { kode: "1701", kota: "Kab. Bengkulu Selatan", variant: "Bawang Bombai", prices: [38000, 38000, 38000, 38000] },
        { kode: "1701", kota: "Kab. Bengkulu Selatan", variant: "Bawang Merah", prices: [40000, 35000, 35000, 35000] },
        { kode: "1701", kota: "Kab. Bengkulu Selatan", variant: "Bawang Putih Honan", prices: [42000, 40000, 40000, 40000] }
    ];

    // Menambahkan data ke tabel
    data.forEach(item => {
        let row = `<tr>
            <td class="px-6 py-4">${item.kode}</td>
            <td class="px-6 py-4">${item.kota}</td>
            <td class="px-6 py-4">${item.variant}</td>
            ${item.prices.map(price => `<td class="px-6 py-4">${price.toLocaleString('id-ID')}</td>`).join('')}
        </tr>`;
        tableBody.innerHTML += row;
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.getElementById("table-body");

});
</script>
@endpush
