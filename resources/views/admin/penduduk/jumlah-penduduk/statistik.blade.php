@extends('admin.layouts.app')

@section('title', 'Statistik Penduduk')
@section('content')
    <x-panel.panel>
        <x-panel.panel-header title="Statistik Penduduk Provinsi Bengkulu" />
        <x-panel.panel-body>
            <div class="flex flex-col w-full gap-4 xl:gap-6">
                <form method="GET" action="" class="flex items-center gap-4 w-full">
                    <div class="w-full">
                        <label for="region" class="sr-only">Rentang Usia</label>
                        <select id="region" name="region" wire:model.change="selectedRegion"
                            class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option value="">Semua Kabupaten/Kota</option>
                            @foreach ($regions as $item)
                                <option value="{{ $item['region_name'] }}"
                                    {{ request('region') == $item['region_name'] ? 'selected' : '' }}>
                                    {{ $item['region_name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M5.05 3C3.291 3 2.352 5.024 3.51 6.317l5.422 6.059v4.874c0 .472.227.917.613 1.2l3.069 2.25c1.01.742 2.454.036 2.454-1.2v-7.124l5.422-6.059C21.647 5.024 20.708 3 18.95 3H5.05Z" />
                        </svg>
                        Cari
                    </button>
                </form>

                <div class="grid grid-cols-12 gap-4 md:gap-6">
                    <div class="col-span-12 space-y-6 xl:col-span-8">
                        @if (!empty($ageRange))
                            <x-chart.penduduk.bar-chart :data="$ageRange" />
                        @endif
                    </div>
                    <div class="col-span-12 xl:col-span-4">
                        @if (!empty($genderPercentage) && !empty($populationCount))
                            <x-chart.penduduk.pie-chart :data="$genderPercentage" :dataFooter="$populationCount" />
                        @endif
                    </div>
                </div>
            </div>
        </x-panel.panel-body>
    </x-panel.panel>
@endsection
