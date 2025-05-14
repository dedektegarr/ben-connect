@extends('admin.layouts.app')

@section('title', 'Pelayanan Poli RSMY')
@section('content')
    <x-panel.panel>
        <x-panel.panel-header title="Pelayanan Poli"></x-panel.panel-header>
        <x-panel.panel-body>
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="stats-card bg-gradient-to-br from-blue-500 to-blue-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium">Total Pengunjung</p>
                            <p class="text-3xl font-bold">{{ $totalPengunjung }}</p>
                        </div>
                        <div class="p-3 bg-white/10 rounded-full">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stats-card bg-gradient-to-br from-green-500 to-green-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium">Total Terlayani</p>
                            <p class="text-3xl font-bold">{{ $totalTerlayani }}
                            </p>
                        </div>
                        <div class="p-3 bg-white/10 rounded-full">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ====== DataTable One Start -->
            <div
                class="overflow-hidden rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($pelayanan_poli as $poli)
                        <div
                            class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-200 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $poli['poli'] }}
                                </h2>
                                <div class="flex items-center space-x-2">
                                    <span
                                        class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-sm px-3 py-1 rounded-full">
                                        Poli
                                    </span>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span class="text-gray-600 dark:text-gray-400">Pengunjung</span>
                                    </div>
                                    <span class="font-semibold text-gray-800 dark:text-gray-200">
                                        {{ $poli['pengunjung'] }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-gray-600 dark:text-gray-400">Terlayani</span>
                                    </div>
                                    <span class="font-semibold text-gray-800 dark:text-gray-200">
                                        {{ $poli['terlayani'] }}
                                    </span>
                                </div>
                            </div>

                            @php
                                $total = (int) $poli['pengunjung'];
                                $served = (int) $poli['terlayani'];
                                $percentage = $total > 0 ? ($served / $total) * 100 : 0;
                            @endphp

                            <div class="mt-4">
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Progress
                                        Layanan</span>
                                    <span
                                        class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ number_format($percentage, 1) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-panel.panel-body>
    </x-panel.panel>
@endsection
