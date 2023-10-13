@extends('layouts.user_type.auth')
@section('content')
    <div class="row mt-4">
        <div class="col-lg-5 mb-lg-0 mb-4" hidden>
            <div class="card z-index-2">
                <div class="card-body p-3">
                    <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                        <div class="chart">
                            <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Sales overview</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="outletSelect">Pilih Outlet:</label>
                                <select id="outletSelect" class="form-control outletSelect" name="outlet[]"
                                    multiple="multiple">
                                    <option value="Pilih Outlet" disabled>Pilih Outlet</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mt-4">
                            <button id="filterButton" class="btn bg-gradient-primary mt-2"><i class="fa fa-filter"
                                    aria-hidden="true"></i> Filter</button>
                            <button id="resetButton" class="btn bg-gradient-danger"><i class="fa fa-undo"
                                    aria-hidden="true"></i>
                                </i> Reset</button>
                        </div>
                        <div class="col-md-2 mt-4"></div>
                    </div>
                    <p class="text-sm">
                        <span class="font-weight-bold"></span> September 2023
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('dashboard')
    <script>
        $(document).ready(function() {
            $('.outletSelect').select2();
        });

        var outletSelect = document.getElementById('outletSelect');
        var responseData = {!! json_encode($data) !!};
        var outlets = responseData.dataset;
        outlets.forEach(function(outlet) {
            var option = document.createElement('option');
            option.value = outlet.label;
            option.text = outlet.label;
            outletSelect.appendChild(option);
        });

        function updateChart(selectedOutletData) {
            var ctx2 = document.getElementById("chart-line").getContext("2d");
            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');
            var totalTransaksi = selectedOutletData.data;

            var labels = responseData.labels.map(function(label) {
                return `Tanggal ${label}`;
            });

            var myChart = new Chart(ctx2, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Transaksi",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: totalTransaksi,
                        maxBarThickness: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#b2b9bf',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                }
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#b2b9bf',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                }
                            }
                        }
                    }
                }
            });
        }

        outletSelect.addEventListener('change', function() {
            var selectedOutletData = outlets.find(function(outlet) {
                return outlet.label === outletSelect.value;
            });
            updateChart(selectedOutletData);
        });

        var allOutletData = [...outlets]; // Inisialisasi data awal

        var filterButton = document.getElementById('filterButton');
        filterButton.addEventListener('click', function() {
            var selectedOutletLabels = Array.from(outletSelect.selectedOptions).map(function(option) {
                return option.value;
            });

            // Filter data outlet berdasarkan label yang dipilih
            allOutletData = outlets.filter(function(outlet) {
                return selectedOutletLabels.includes(outlet.label);
            });

            // Gabungkan data transaksi dari outlet yang dipilih
            var totalTransaksi = allOutletData[0].data.map(function(_, index) {
                return allOutletData.reduce(function(total, outlet) {
                    return total + outlet.data[index];
                }, 0);
            });

            // Perbarui grafik
            updateChart({
                label: "Filtered Data",
                data: totalTransaksi
            });
        });

        var resetButton = document.getElementById('resetButton');
        resetButton.addEventListener('click', function() {
            allOutletData = [...outlets];
            updateChart(allOutletData);
        });

        updateChart(allOutletData);
    </script>
@endpush
