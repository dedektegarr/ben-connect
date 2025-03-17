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

            <!-- Table Section -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden dark:bg-gray-800">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="table-header">Kelas Kamar</th>
                                <th class="table-header">Kapasitas</th>
                                <th class="table-header">Terisi</th>
                                <th class="table-header">Tersedia</th>
                                <th class="table-header">Utilisasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($ketersediaan_kamar as $kamar)
                                @php
                                    $available = $kamar['Kapasitas'] - $kamar['Terisi'];
                                    if ($kamar['Kapasitas'] == 0) {
                                        $percentage = 0;
                                    } else {
                                        $percentage = round(($kamar['Terisi'] / $kamar['Kapasitas']) * 100, 2);
                                    }
                                @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="table-data font-medium">{{ $kamar['Kelas_kamar'] }}</td>
                                    <td class="table-data">{{ $kamar['Kapasitas'] }}</td>
                                    <td class="table-data text-red-600 dark:text-red-400">{{ $kamar['Terisi'] }}</td>
                                    <td class="table-data text-green-600 dark:text-green-400">{{ $available }}</td>
                                    <td class="table-data">
                                        <div class="flex items-center">
                                            {{-- <span class="mr-2">{{ $percentage }}%</span> --}}
                                            <div class="relative w-24">
                                                <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                                    <div style="width:{{ $percentage }}%"
                                                        class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
