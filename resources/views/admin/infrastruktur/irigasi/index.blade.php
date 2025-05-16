{{-- @endsection  --}}
@extends('admin.layouts.app')

@section('title', 'Irigasi')
@section('content')
    <x-panel.panel class="w-full">
        <x-panel.panel-header title="{{ __('Data Irigasi') }}">
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

        <x-panel.panel-body class="w-full p-10 bg-gray-900 rounded-lg shadow-lg">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div
                    class="p-6 rounded-xl text-white transition-all duration-300 transform hover:scale-[1.02] bg-gradient-to-br from-blue-500 to-blue-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium">Total Daerah Irigasi</p>
                            <p class="text-3xl font-bold">{{ number_format($total_daerah_irigasi ?? 0) }}</p>
                        </div>
                        <div class="p-3 bg-white/10 rounded-full">
                            <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M11.4453 3.16795c.3359-.22393.7735-.22393 1.1094 0l6 4c.4595.30635.5837.92722.2773 1.38675-.1925.28877-.5092.44511-.832.44541-.1748.00016-.3515-.04546-.5112-.1406-.0146-.00873-.0292-.01789-.0435-.02746L16 7.86853v8.59597l-.2322-.2323c-.9763-.9763-2.5593-.9763-3.5356 0-.9763.9763-.9763 2.5593 0 3.5356L13.4645 21H8V7.86853l-1.44532.96352c-.45952.30635-1.08039.18218-1.38675-.27735-.30635-.45953-.18217-1.0804.27735-1.38675l6.00002-4ZM11 11c-.5523 0-1 .4477-1 1s.4477 1 1 1h2c.5523 0 1-.4477 1-1s-.4477-1-1-1h-2Zm-1-2c0-.55228.4477-1 1-1h2c.5523 0 1 .44772 1 1s-.4477 1-1 1h-2c-.5523 0-1-.44772-1-1Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M21 13.708v-1.583c0-.448-.298-.8414-.7293-.9627L18 10.5237v3.9408l.2322-.2323c.7484-.7483 1.853-.923 2.7678-.5242ZM6 10.5237l-2.27075.6386C3.29797 11.2836 3 11.677 3 12.125V20c0 .5523.44772 1 1 1h2V10.5237Z" />
                                <path fill-rule="evenodd"
                                    d="M20.7071 15.2929c.3905.3905.3905 1.0237 0 1.4142l-4 4c-.3905.3905-1.0237.3905-1.4142 0l-2-2c-.3905-.3905-.3905-1.0237 0-1.4142.3905-.3905 1.0237-.3905 1.4142 0L16 18.5858l3.2929-3.2929c.3905-.3905 1.0237-.3905 1.4142 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="p-6 rounded-xl text-white transition-all duration-300 transform hover:scale-[1.02] bg-gradient-to-br from-green-500 to-green-600">
                    <div class="flex items-center justify-between">
                        <div>

                            <p class="text-sm font-medium">Total Luas Potensial</p>
                            <p class="text-3xl font-bold">{{ number_format($total_luas_potensial ?? 0) }} Ha</p>
                        </div>
                        <div class="p-3 bg-white/10 rounded-full">
                            <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M11.4453 3.16795c.3359-.22393.7735-.22393 1.1094 0l6 4c.4595.30635.5837.92722.2773 1.38675-.1925.28877-.5092.44511-.832.44541-.1748.00016-.3515-.04546-.5112-.1406-.0146-.00873-.0292-.01789-.0435-.02746L16 7.86853v8.59597l-.2322-.2323c-.9763-.9763-2.5593-.9763-3.5356 0-.9763.9763-.9763 2.5593 0 3.5356L13.4645 21H8V7.86853l-1.44532.96352c-.45952.30635-1.08039.18218-1.38675-.27735-.30635-.45953-.18217-1.0804.27735-1.38675l6.00002-4ZM11 11c-.5523 0-1 .4477-1 1s.4477 1 1 1h2c.5523 0 1-.4477 1-1s-.4477-1-1-1h-2Zm-1-2c0-.55228.4477-1 1-1h2c.5523 0 1 .44772 1 1s-.4477 1-1 1h-2c-.5523 0-1-.44772-1-1Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M21 13.708v-1.583c0-.448-.298-.8414-.7293-.9627L18 10.5237v3.9408l.2322-.2323c.7484-.7483 1.853-.923 2.7678-.5242ZM6 10.5237l-2.27075.6386C3.29797 11.2836 3 11.677 3 12.125V20c0 .5523.44772 1 1 1h2V10.5237Z" />
                                <path fill-rule="evenodd"
                                    d="M20.7071 15.2929c.3905.3905.3905 1.0237 0 1.4142l-4 4c-.3905.3905-1.0237.3905-1.4142 0l-2-2c-.3905-.3905-.3905-1.0237 0-1.4142.3905-.3905 1.0237-.3905 1.4142 0L16 18.5858l3.2929-3.2929c.3905-.3905 1.0237-.3905 1.4142 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div
                    class="p-6 rounded-xl text-white transition-all duration-300 transform hover:scale-[1.02] bg-gradient-to-br from-green-500 to-green-600">
                    <div class="flex items-center justify-between">
                        <div>

                            <p class="text-sm font-medium">Total Luas Fungsional</p>
                            <p class="text-3xl font-bold">{{ number_format($total_luas_fungsional ?? 0) }} Ha</p>
                        </div>
                        <div class="p-3 bg-white/10 rounded-full">
                            <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M11.4453 3.16795c.3359-.22393.7735-.22393 1.1094 0l6 4c.4595.30635.5837.92722.2773 1.38675-.1925.28877-.5092.44511-.832.44541-.1748.00016-.3515-.04546-.5112-.1406-.0146-.00873-.0292-.01789-.0435-.02746L16 7.86853v8.59597l-.2322-.2323c-.9763-.9763-2.5593-.9763-3.5356 0-.9763.9763-.9763 2.5593 0 3.5356L13.4645 21H8V7.86853l-1.44532.96352c-.45952.30635-1.08039.18218-1.38675-.27735-.30635-.45953-.18217-1.0804.27735-1.38675l6.00002-4ZM11 11c-.5523 0-1 .4477-1 1s.4477 1 1 1h2c.5523 0 1-.4477 1-1s-.4477-1-1-1h-2Zm-1-2c0-.55228.4477-1 1-1h2c.5523 0 1 .44772 1 1s-.4477 1-1 1h-2c-.5523 0-1-.44772-1-1Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M21 13.708v-1.583c0-.448-.298-.8414-.7293-.9627L18 10.5237v3.9408l.2322-.2323c.7484-.7483 1.853-.923 2.7678-.5242ZM6 10.5237l-2.27075.6386C3.29797 11.2836 3 11.677 3 12.125V20c0 .5523.44772 1 1 1h2V10.5237Z" />
                                <path fill-rule="evenodd"
                                    d="M20.7071 15.2929c.3905.3905.3905 1.0237 0 1.4142l-4 4c-.3905.3905-1.0237.3905-1.4142 0l-2-2c-.3905-.3905-.3905-1.0237 0-1.4142.3905-.3905 1.0237-.3905 1.4142 0L16 18.5858l3.2929-3.2929c.3905-.3905 1.0237-.3905 1.4142 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($irigations as $item)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-200">
                        <!-- Header -->
                        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                        {{ $item['daerah'] }}
                                    </h2>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                        {{ $item['region']['region_name'] }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 space-y-4">
                            <!-- Luas Lahan -->
                            <div class="space-y-2">
                                <div class="flex items-center justify-between text-sm">
                                    <div class="flex items-center gap-2 text-gray-600 dark:text-gray-300">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                        </svg>
                                        Luas Lahan
                                    </div>
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">
                                        {{ number_format($item['luas_fungsional'], 2) }} Ha
                                    </span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-700">
                                    <div class="bg-green-500 h-2 rounded-full"
                                        style="width: {{ ($item['luas_fungsional'] / $item['luas_potensial']) * 100 }}%">
                                    </div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-600 dark:text-gray-400">
                                    <span>Potensial: {{ number_format($item['luas_potensial'], 2) }} Ha</span>
                                    <span>{{ number_format(($item['luas_fungsional'] / $item['luas_potensial']) * 100, 1) }}%</span>
                                </div>
                            </div>

                            <!-- Panjang Saluran -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="flex items-center gap-2 text-gray-600 dark:text-gray-300">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                    </svg>
                                    <span class="text-sm">Panjang Saluran</span>
                                </div>
                                <span class="text-lg font-bold text-blue-600 dark:text-blue-300">
                                    {{ number_format($item['panjang_saluran'], 0, ',', '.') }} m
                                </span>
                            </div>

                            <!-- Status -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="flex items-center gap-2 text-gray-600 dark:text-gray-300">
                                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm">Status Fungsional</span>
                                </div>
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-medium 
                    @if ($item['luas_fungsional'] / $item['luas_potensial'] >= 0.8) bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                    @elseif($item['luas_fungsional'] / $item['luas_potensial'] >= 0.5) bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200
                    @else bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 @endif">
                                    @if ($item['luas_fungsional'] / $item['luas_potensial'] >= 0.8)
                                        Optimal
                                    @elseif($item['luas_fungsional'] / $item['luas_potensial'] >= 0.5)
                                        Cukup
                                    @else
                                        Perlu Perbaikan
                                    @endif
                                </span>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between text-xs text-gray-600 dark:text-gray-400">
                                <span>Terakhir Update</span>
                                <span>{{ \Carbon\Carbon::parse($item['updated_at'])->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div
                class="overflow-hidden rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
                <table id="default-table">
                    <thead>

                        <tr>

                            <th rowspan="2">
                                <span class="flex items-center">
                                    Daerah Irigasi
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th rowspan="2">
                                <span class="flex items-center">
                                    Luas Potensial (Ha)
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Luas Fungsional (Ha)
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Panjang Saluran (m)
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Keterangan
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
                        @foreach ($irigations as $key => $irigation)
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $irigation['daerah'] }}</td>
                                <td>{{ $irigation['luas_potensial'] }}</td>
                                <td>{{ $irigation['luas_fungsional'] }}</td>
                                <td>{{ $irigation['panjang_saluran'] }}</td>
                                <td>{{ $irigation['keterangan'] }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-panel.panel-body>
    </x-panel.panel>
    {{-- MODAL --}}
    <div id="import-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ __('Impor Data Irigasi') }}
                    </h3>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" method="POST" action="{{ route('admin.infrastruktur.irigasi.import') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">

                        <div class="col-span-2">
                            <label for="file"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('File') }}</label>
                            <input name="file" id="file"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="file_input" type="file">

                            @error('file')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">{{ $message }}</p>
                            @enderror <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">
                                PDF (MAX.
                                5Mb).
                            </p>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 3a1 1 0 0 1 .78.375l4 5a1 1 0 1 1-1.56 1.25L13 6.85V14a1 1 0 1 1-2 0V6.85L8.78 9.626a1 1 0 1 1-1.56-1.25l4-5A1 1 0 0 1 12 3ZM9 14v-1H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-4v1a3 3 0 1 1-6 0Zm8 2a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                clip-rule="evenodd" />
                        </svg>

                        {{ __('Impor') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
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
    </script>
@endpush
