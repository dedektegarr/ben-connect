@extends('admin.layouts.app')

@section('title', 'Data Komoditas')
@section('content')
    <x-panel.panel>
        <x-panel.panel-header title="{{ __('Data Harga Komoditas') }}">
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
            <form method="GET" action="">
                <div class="flex items-center gap-4 justify-between mb-6">
                    <div class="flex gap-4 items-center w-full">
                        {{-- Kabupaten/Kota --}}
                        <div class="w-full">
                            <label for="region" class="sr-only">Kab/Kota Kantor</label>
                            <select id="region" name="region"
                                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                <option value="" {{ request('region') == '' ? 'selected' : '' }}>Semua Kabupaten/Kota
                                    Kantor
                                </option>
                                @foreach ($regions as $item)
                                    <option value="{{ $item['region_name'] }}"
                                        {{ request('region') == $item['region_name'] ? 'selected' : '' }}>
                                        {{ $item['region_name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    {{-- Tombol Filter --}}
                    <button type="submit"
                        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M5.05 3C3.291 3 2.352 5.024 3.51 6.317l5.422 6.059v4.874c0 .472.227.917.613 1.2l3.069 2.25c1.01.742 2.454.036 2.454-1.2v-7.124l5.422-6.059C21.647 5.024 20.708 3 18.95 3H5.05Z" />
                        </svg>
                        Filter
                    </button>
                </div>
            </form>

            <div
                class="overflow-x-auto rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
                <table id="default-table">
                    <thead>
                        <tr>
                            <th>
                                <span class="flex items-center">
                                    Kabupaten Kota
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Nama Varian
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            @foreach ($dates as $date)
                                <th>
                                    <span class="flex items-center">
                                        {{ \Carbon\Carbon::parse($date)->translatedFormat('d/m/Y') }}
                                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                        </svg>
                                    </span>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_price as $region => $variants)
                            @foreach ($variants as $variant => $items)
                                <tr>
                                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $region }}</td>
                                    <td>{{ $variant }}</td>
                                    @foreach ($dates as $date)
                                        <td>
                                            Rp.{{ number_format($items->firstWhere('date', $date)['prices_value']) ?? '-' }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
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
@endpush
