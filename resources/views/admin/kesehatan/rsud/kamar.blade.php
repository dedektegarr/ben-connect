@extends('admin.layouts.app')

@section('title', 'Ketersediaan Kamar RSMY')
@section('content')
    <x-panel.panel>
        <x-panel.panel-header title="Ketersediaan Kamar"></x-panel.panel-header>

        <x-panel.panel-body>
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="stats-card bg-gradient-to-br from-blue-500 to-blue-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium">Total Kelas Kamar</p>
                            <p class="text-3xl font-bold">{{ count($ketersediaan_kamar) }}</p>
                        </div>
                        <div class="p-3 bg-white/10 rounded-full">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stats-card bg-gradient-to-br from-green-500 to-green-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium">Total Kapasitas</p>
                            <p class="text-3xl font-bold">{{ array_sum(array_column($ketersediaan_kamar, 'Kapasitas')) }}
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

                <div class="stats-card bg-gradient-to-br from-purple-500 to-purple-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium">Total Tersedia</p>
                            <p class="text-3xl font-bold">
                                {{ array_sum(array_column($ketersediaan_kamar, 'Kapasitas')) - array_sum(array_column($ketersediaan_kamar, 'Terisi')) }}
                            </p>
                        </div>
                        <div class="p-3 bg-white/10 rounded-full">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                @foreach (collect($ketersediaan_kamar)->groupBy('name_of_clinic') as $clinic => $classes)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-200">
                        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $clinic }}
                                </h2>
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <span class="text-gray-600 dark:text-gray-300">
                                            Total Kamar: {{ $classes->sum('cap') }}
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span class="text-gray-600 dark:text-gray-300">
                                            Terisi: {{ $classes->sum('ISI') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 space-y-4">
                            @foreach ($classes as $class)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="font-semibold text-gray-800 dark:text-gray-200">
                                            {{ $class['NAME_OF_CLASS'] }}
                                        </h3>
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-medium 
                                    @if ($class['cap'] == 0) bg-red-100 dark:bg-red-800 text-red-800 dark:text-red-200
                                    @elseif($class['ISI'] >= $class['cap']) bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200
                                    @else bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 @endif">
                                            @if ($class['cap'] == 0)
                                                Tidak Tersedia
                                            @elseif($class['ISI'] >= $class['cap'])
                                                Penuh
                                            @else
                                                Tersedia
                                            @endif
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 6h16M4 12h16m-7 6h7" />
                                            </svg>
                                            <span class="text-gray-600 dark:text-gray-300">Kapasitas:</span>
                                            <span class="font-semibold dark:text-gray-200">{{ $class['cap'] }}</span>
                                        </div>

                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <span class="text-gray-600 dark:text-gray-300">Terisi:</span>
                                            <span class="font-semibold dark:text-gray-200">{{ $class['ISI'] }}</span>
                                        </div>

                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-gray-600 dark:text-gray-300">Tarif:</span>
                                            <span class="font-semibold dark:text-gray-200">
                                                @php
                                                    echo number_format((float) $class['TARIF'], 0, ',', '.');
                                                @endphp
                                            </span>
                                        </div>

                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                            <span class="text-gray-600 dark:text-gray-300">Persentase:</span>
                                            <span class="font-semibold dark:text-gray-200">
                                                @php
                                                    $percentage =
                                                        $class['cap'] > 0 ? ($class['ISI'] / $class['cap']) * 100 : 0;
                                                    echo number_format($percentage, 1) . '%';
                                                @endphp
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mt-3 w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-600">
                                        <div class="h-2.5 rounded-full 
                                    @if ($percentage >= 90) bg-red-500
                                    @elseif($percentage >= 50) bg-yellow-500
                                    @else bg-green-500 @endif"
                                            style="width: {{ $percentage }}%">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </x-panel.panel-body>
    </x-panel.panel>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Room Utilization Chart
        const ctx = document.getElementById('roomUtilizationChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json(array_column($ketersediaan_kamar, 'Kelas_kamar')),
                datasets: [{
                        label: 'Kapasitas',
                        data: @json(array_column($ketersediaan_kamar, 'Kapasitas')),
                        backgroundColor: 'rgba(99, 102, 241, 0.6)',
                        borderColor: 'rgb(99, 102, 241)',
                        borderWidth: 1
                    },
                    {
                        label: 'Terisi',
                        data: @json(array_column($ketersediaan_kamar, 'Terisi')),
                        backgroundColor: 'rgba(239, 68, 68, 0.6)',
                        borderColor: 'rgb(239, 68, 68)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    x: {
                        stacked: false,
                    },
                    y: {
                        stacked: false,
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
