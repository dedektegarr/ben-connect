@extends('admin.layouts.app')

@section('title', 'Kunjungan Pasien RSMY')
@section('content')
    <x-panel.panel>
        <x-panel.panel-header title="Kunjungan Pasien">
            <form method="POST" action="{{ route('admin.kesehatan.rsud.synchronize') }}">
                @csrf
                <button type="submit"
                    class="md:inline-flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span class="hidden lg:block lg:ms-2">{{ __('Perbarui Data') }}</span>
                </button>
            </form>
        </x-panel.panel-header>
        <x-panel.panel-body>
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div
                    class="p-6 rounded-xl text-white transition-all duration-300 transform hover:scale-[1.02] bg-gradient-to-br from-blue-500 to-blue-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium">Total Kunjungan</p>
                            <p class="text-3xl font-bold">{{ number_format($total_kunjungan) }}</p>
                        </div>
                        <div class="p-3 bg-white/10 rounded-full">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="p-6 rounded-xl text-white transition-all duration-300 transform hover:scale-[1.02] bg-gradient-to-br from-green-500 to-green-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium">Pasien Baru</p>
                            <p class="text-3xl font-bold">{{ number_format($total_pasien_baru) }}</p>
                        </div>
                        <div class="p-3 bg-white/10 rounded-full">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="p-6 rounded-xl text-white transition-all duration-300 transform hover:scale-[1.02] bg-gradient-to-br from-purple-500 to-purple-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium">Pasien Lama</p>
                            <p class="text-3xl font-bold">{{ number_format($total_pasien_lama) }}</p>
                        </div>
                        <div class="p-3 bg-white/10 rounded-full">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
                    data-tabs-toggle="#default-styled-tab-content"
                    data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
                    data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                    role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="harian-styled-tab"
                            data-tabs-target="#styled-harian" type="button" role="tab" aria-controls="harian"
                            aria-selected="false">Harian</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="bulanan-styled-tab" data-tabs-target="#styled-bulanan" type="button" role="tab"
                            aria-controls="bulanan" aria-selected="false">Bulanan</button>
                    </li>
                </ul>
            </div>
            <div id="default-styled-tab-content">
                <div class="hidden" id="styled-harian" role="tabpanel" aria-labelledby="harian-tab">
                    <div class="grid grid-cols-12 gap-4 md:gap-6">
                        <div class="col-span-12 space-y-6 xl:col-span-6">
                            <!-- Table -->
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden dark:bg-gray-800">
                                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Kunjungan 7 Hari Terakhir</h3>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th class="table-header">Tanggal</th>
                                                <th class="table-header">Baru</th>
                                                <th class="table-header">Lama</th>
                                                <th class="table-header">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach ($kunjungan_harian as $harian)
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                                    <td class="table-data">{{ $harian['tanggal'] }}</td>
                                                    <td class="table-data text-blue-600 dark:text-blue-400">
                                                        {{ $harian['pasien_baru'] }}</td>
                                                    <td class="table-data text-green-600 dark:text-green-400">
                                                        {{ $harian['pasien_lama'] }}</td>
                                                    <td class="table-data font-semibold">
                                                        {{ $harian['pasien_baru'] + $harian['pasien_lama'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-6">
                            <div class="bg-white rounded-xl shadow-lg p-6 dark:bg-gray-800">
                                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Trend Harian</h3>
                                <div id="daily-chart" class="z-10"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden" id="styled-bulanan" role="tabpanel" aria-labelledby="bulanan-tab">
                    <div class="grid grid-cols-12 gap-4 md:gap-6">
                        <div class="col-span-12 space-y-6 xl:col-span-6">
                            <!-- Table -->
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden dark:bg-gray-800">
                                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Kunjungan 6 Bulan Terakhir</h3>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th class="table-header">Bulan</th>
                                                <th class="table-header">Tahun</th>
                                                <th class="table-header">Baru</th>
                                                <th class="table-header">Lama</th>
                                                <th class="table-header">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach ($kunjungan_bulanan->reverse() as $bulanan)
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                                    <td class="table-data">{{ $bulanan['bulan'] }}</td>
                                                    <td class="table-data">{{ $bulanan['tahun'] }}</td>
                                                    <td class="table-data text-blue-600 dark:text-blue-400">
                                                        {{ $bulanan['pasien_baru'] }}</td>
                                                    <td class="table-data text-green-600 dark:text-green-400">
                                                        {{ $bulanan['pasien_lama'] }}</td>
                                                    <td class="table-data font-semibold">
                                                        {{ $bulanan['pasien_baru'] + $bulanan['pasien_lama'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-6">
                            <div class="bg-white rounded-xl shadow-lg p-6 dark:bg-gray-800">
                                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Trend Bulanan</h3>
                                <div id="monthly-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-panel.panel-body>
    </x-panel.panel>
@endsection
@push('scripts')
    <script>
        function renderDailyChart() {
            const dailyChart = new ApexCharts(document.getElementById("daily-chart"), {
                chart: {
                    height: "300px",
                    maxWidth: "100%",
                    type: "line",
                    fontFamily: "Inter, sans-serif",
                    dropShadow: {
                        enabled: false,
                    },
                    toolbar: {
                        show: false,
                    },
                },
                tooltip: {
                    enabled: true,
                    x: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 6,
                },
                grid: {
                    show: true,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: -26
                    },
                },
                series: [{
                        name: "Pasien Baru",
                        data: @json($kunjungan_harian->map(fn($item) => $item['pasien_baru'])).reverse(),
                        color: "#1A56DB",
                    },
                    {
                        name: "Pasien Lama",
                        data: @json($kunjungan_harian->map(fn($item) => $item['pasien_lama'])).reverse(),
                        color: "#7E3AF2",
                    },
                ],
                legend: {
                    show: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: @json($kunjungan_harian->map(fn($item) => $item['tanggal_short'])).reverse(),
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        }
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                    show: false,
                },
            });
            dailyChart.render();
        }

        function renderMonthlyChart() {
            const monthlyChart = new ApexCharts(document.getElementById("monthly-chart"), {
                colors: ["#1A56DB", "#FDBA8C"],
                series: [{
                        name: "Pasien Baru",
                        color: "#1A56DB",
                        data: @json(
                            $kunjungan_bulanan->map(function ($item) {
                                return [
                                    'x' => $item['bulan'],
                                    'y' => $item['pasien_baru'],
                                ];
                            })),
                    },
                    {
                        name: "Pasien Lama",
                        color: "#FDBA8C",
                        data: @json(
                            $kunjungan_bulanan->map(function ($item) {
                                return [
                                    'x' => $item['bulan'],
                                    'y' => $item['pasien_lama'],
                                ];
                            })),
                    },
                ],
                chart: {
                    type: "bar",
                    height: "320px",
                    fontFamily: "Inter, sans-serif",
                    toolbar: {
                        show: false,
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "70%",
                        borderRadiusApplication: "end",
                        borderRadius: 8,
                    },
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    style: {
                        fontFamily: "Inter, sans-serif",
                    },
                },
                states: {
                    hover: {
                        filter: {
                            type: "darken",
                            value: 1,
                        },
                    },
                },
                stroke: {
                    show: true,
                    width: 0,
                    colors: ["transparent"],
                },
                grid: {
                    show: false,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: -14
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    show: false,
                },
                xaxis: {
                    floating: false,
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        }
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                    show: false,
                },
                fill: {
                    opacity: 1,
                },
            });
            monthlyChart.render();
        }

        document.addEventListener("DOMContentLoaded", function() {
            renderDailyChart();
            renderMonthlyChart()
        });
    </script>
@endpush
