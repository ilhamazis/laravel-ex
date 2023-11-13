@php
    $paths = [
        ['title' => 'Beranda'],
    ];
@endphp

<x-app-layout>
    <div class="container">
        <div class="main__header">
            <div class="main__location">
                <x-quantum.breadcrumb :paths="$paths"/>
            </div>
        </div>

        <div class="grid">
            <div class="col-12 col-sm-6">
                <div class="card">
                    <div class="card__body">
                        <div class="statistic__item blue">
                            <div class="statistic__header">
                                <h5 class="statistic__title">Lowongan Pekerjaan yang Aktif</h5>

                                <span data-tooltip="Jumlah lowongan pekerjaan dengan status aktif">
                                    <span class="statistic__tooltip icon icon-information-circle-solid"></span>
                                </span>
                            </div>
                            <span class="statistic__count">{{ $activeJobsCount }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="card">
                    <div class="card__body">
                        <div class="statistic__item orange">
                            <div class="statistic__header">
                                <h5 class="statistic__title">Lowongan Pekerjaan Tanpa Pelamar</h5>

                                <span data-tooltip="Lowongan pekerjaan aktif yang belum mempunyai pelamar">
                                    <span class="statistic__tooltip icon icon-information-circle-solid"></span>
                                </span>
                            </div>
                            <span class="statistic__count">{{ $jobsThatDoesntHaveApplications }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card__body">
                        <h2 style="padding-bottom: 2rem">Jumlah Pelamar Per Lowongan Pekerjaan</h2>

                        <div class="chart-line-area" style="width: 100%;">
                            <canvas id="chart-performance"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script
            src="{{ asset('/quantum-v2.0.0-202307280002/assets/js/vendors/chart.js-4.3.0/dist/chart.umd.js') }}"></script>
        <script
            src="{{ asset('/quantum-v2.0.0-202307280002/assets/js/vendors/chartjs-plugin-datalabels-2.2.0/dist/chartjs-plugin-datalabels.min.js') }}"></script>

    @endpush
    @push('custom-scripts')
        <script src="{{ asset('quantum-v2.0.0-202307280002/assets/js/utils/chart-settings.js') }}"></script>

        <script>
            const chart = document.getElementById("chart-performance");
            let chartHeight = "400px";

            chart.style.height = chartHeight;
            chart.style.maxHeight = chartHeight;

            new Chart(chart, {
                type: "line",
                data: {
                    labels: @js($chartApplicationsByJob['labels']),
                    datasets: [
                        {
                            label: "Jumlah Pelamar",
                            data: @js($chartApplicationsByJob['data']),
                            backgroundColor: "#2486FF",
                            borderColor: "#2486FF",
                        },
                    ],
                },
                options: {
                    // Harus menyisipkan interaction untuk membuat plugins qnChartPluginTooltipLineTopToBottom() bekerja maksimal
                    interaction: {
                        intersect: false,
                        mode: "index",
                    },
                    // Scales Line default dari quantum
                    scales: qnChartConfigLineScales,
                },
                plugins: [qnPluginChartAddMarginBottomLegend(), qnChartPluginTooltipLineTopToBottom()],
            });
        </script>
    @endpush
</x-app-layout>
