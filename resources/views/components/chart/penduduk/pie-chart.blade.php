@props(['data', 'dataFooter'])

<div class="rounded-2xl border border-gray-200 bg-gray-100 dark:border-gray-800 dark:bg-white/[0.03]">
    <div class="shadow-default rounded-2xl bg-white px-5 pb-11 pt-5 dark:bg-gray-900 sm:px-6 sm:pt-6">
        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                    Jenis Kelamin
                </h3>
                <p class="mt-1 text-theme-sm text-gray-500 dark:text-gray-400">
                    Persentase Jenis Kelamin Penduduk Provinsi Bengkulu
                </p>
            </div>
        </div>
        <div class="relative mt-6">
            <div id="pieChart" class="h-full"></div>
        </div>
    </div>

    <div class="flex items-center justify-center gap-5 px-6 py-3.5 sm:gap-8 sm:py-5">
        @foreach ($dataFooter as $key => $item)
            <div>
                <p class="mb-1 text-center text-theme-xs text-gray-500 dark:text-gray-400 sm:text-sm">
                    {{ $key }}
                </p>
                <p
                    class="flex items-center justify-center gap-1 text-base font-semibold text-gray-800 dark:text-white/90 sm:text-lg">
                    {{ number_format($item) }}
                </p>
            </div>
        @endforeach


    </div>
</div>
@push('scripts')
    <script>
        const pieChartData = @json($data);
        let pieChart;

        const renderPieChart = (values, labels) => {
            if (pieChart) {
                pieChart.destroy()
            }

            pieChart = new ApexCharts(document.getElementById("pieChart"), {
                series: values,
                colors: ["#1C64F2", "#16BDCA"],
                chart: {
                    width: "100%",
                    height: 300,
                    type: "pie",
                },
                stroke: {
                    colors: ["white"],
                    lineCap: "",
                },
                plotOptions: {
                    pie: {
                        labels: {
                            show: true,
                        },
                        size: "100%",
                        dataLabels: {
                            offset: -25
                        }
                    },
                },
                labels: labels,
                dataLabels: {
                    enabled: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                    },
                },
                legend: {
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return value + "%"
                        },
                    },
                },
                xaxis: {
                    labels: {
                        formatter: function(value) {
                            return value + "%"
                        },
                    },
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                },
            });
            pieChart.render();
        }

        document.addEventListener("DOMContentLoaded", function() {
            renderPieChart(pieChartData.values, pieChartData.labels);
        });

        document.addEventListener('livewire:init', () => {
            Livewire.on('data-changed', (event) => {
                const {
                    values,
                    labels
                } = event[0];

                renderPieChart(values, labels)
            });
        });
    </script>
@endpush
