@props(['data'])

<div
    class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
            Rentang Usia
        </h3>
    </div>

    <div class="max-w-full">
        <div id="barChart"></div>
    </div>
</div>
@push('scripts')
    <script>
        const renderBarChart = (categories, series) => {
            const options = {
                series,
                chart: {
                    sparkline: {
                        enabled: false,
                    },
                    type: "bar",
                    width: "100%",
                    height: 800,
                    toolbar: {
                        show: false,
                    }
                },
                fill: {
                    opacity: 1,
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        columnWidth: "100%",
                        borderRadiusApplication: "end",
                        borderRadius: 6,
                        dataLabels: {
                            position: "top",
                        },
                    },
                },
                legend: {
                    show: true,
                    position: "bottom",
                },
                dataLabels: {
                    enabled: false,
                },
                tooltip: {
                    shared: true,
                    intersect: false,

                },
                xaxis: {
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        },
                    },
                    categories,
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: true,
                    },
                },
                yaxis: {
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        }
                    }
                },
                grid: {
                    show: true,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: -20
                    },
                },
                fill: {
                    opacity: 1,
                }
            }

            if (document.getElementById("barChart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("barChart"), options);
                chart.render();
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const categories = @json($data)["categories"];
            const series = @json($data)["series"];

            renderBarChart(categories, series);
        });

        window.addEventListener("data-changed", function(e) {
            const updatedData = e.detail[1];
            renderBarChart(updatedData.categories, updatedData.series);
        });
    </script>
@endpush
