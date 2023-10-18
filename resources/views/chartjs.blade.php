@extends('layouts.user_type.auth')
@section('content')
    <style>
        #outletSelect {
            width: 700px;
            height: 100%;
            border: 1px solid #ccc;
        }
    </style>
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
        <div class="col-lg-16">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Sales overview</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="outletSelect">Pilih Outlet:</label>
                                <select id="outletSelect" class="outletSelect" name="outlet[]" multiple="multiple">
                                    <option value="Pilih Outlet" disabled>Pilih Outlet</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-1 mt-4"></div>
                        <div class="col-md-1 mt-4"></div>
                        <div class="col-md-1 mt-4"></div>
                        <div class="col-md-1 mt-4"></div>
                        {{-- <div class="col-md-1 mt-4"></div> --}}
                        <div class="col-md-2 mt-4">
                            <button id="resetButton" name="resetButton" class="btn bg-gradient-danger"><i class="fa fa-undo"
                                    aria-hidden="true"></i> Reset</button>
                        </div>
                        <div class="col-md-2 mt-4">
                            <button id="filterButton" class="btn bg-gradient-primary"><i class="fa fa-filter"
                                    aria-hidden="true"></i> Filter</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <div class="chart">
                    <canvas id="chart-line" class="chart-canvas" height="500"></canvas>
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
    </script>
    <script>
        var responseData = {!! json_encode($data) !!};
        var allSalesData = responseData.dataset.map(outlet => outlet.data);
        var totalPenjualan = allSalesData.reduce(function(acc, current) {
            return current.map(function(value, index) {
                return (acc[index] || 0) + value;
            });
        }, []);
        var totalTransaksi = totalPenjualan.reduce(function(acc, value) {
            return acc + value;
        }, 0);
    </script>
    <script>
        window.onload = function() {
            var ctx2 = document.getElementById("chart-line").getContext("2d");
            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');
            var responseData = {!! json_encode($data) !!};
            var outletSelect = document.getElementById('outletSelect');
            // Inisialisasi sebuah Set untuk melacak nama-nama outlet yang sudah ada
            var outletNamesSet = new Set();

            // Loop melalui data outlet
            responseData.dataset.forEach(function(outlet) {
                var outletName = outlet.label;

                // Periksa apakah nama outlet sudah ada di Set
                if (!outletNamesSet.has(outletName)) {
                    // Jika tidak, tambahkan nama outlet ke Set dan ke elemen <select>
                    outletNamesSet.add(outletName);
                    var option = document.createElement('option');
                    option.value = outletName;
                    option.text = outletName;
                    outletSelect.appendChild(option);
                }
            });

            var allOutletData = responseData.dataset.map(outlet => outlet.data);
            var totalPenjualan = allOutletData.reduce(function(acc, current) {
                return current.map(function(value, index) {
                    return (acc[index] || 0) + value;
                });
            }, []);
            var selectedOutlets = [];
            var filterButton = document.getElementById('filterButton');
            filterButton.addEventListener('click', function() {
                var selectedOptions = Array.from(outletSelect.selectedOptions);
                selectedOutlets = selectedOptions.map(option => option.value);
                var filteredData;
                if (selectedOutlets.includes('semua')) {
                    filteredData = totalPenjualan;
                } else {
                    filteredData = selectedOutlets.map(selectedOutlet => {
                        var selectedOutletData = responseData.dataset.find(outlet => outlet.label ===
                            selectedOutlet);
                        return selectedOutletData ? selectedOutletData.data : [];
                    });
                }
                updateChart(filteredData);
            });

            function updateChart(filteredData) {
                while (myChart.data.datasets.length > 0) {
                    myChart.data.datasets.pop();
                }
                selectedOutlets.forEach((selectedOutlet, index) => {
                    myChart.data.datasets.push({
                        label: selectedOutlet,
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: getLineColor(
                            index
                        ),
                        borderWidth: 3,
                        backgroundColor: getBackgroundColor(
                            index
                        ),
                        fill: true,
                        data: filteredData[index],
                        maxBarThickness: 6
                    });
                });
                myChart.update();
            }

            function getLineColor(index) {
                var colors = [
                    "#cb0c9f",
                    "#3A416F",
                    "#FF5733",
                    "#00A86B",
                    "#FFC300",

                ];
                return colors[index % colors.length];
            }

            function getBackgroundColor(index) {
                var colors = [
                    "rgba(0, 0, 0, 0)",
                    "rgba(0, 0, 0, 0)",
                    "rgba(0, 0, 0, 0)",
                    "rgba(0, 0, 0, 0)",
                    "rgba(0, 0, 0, 0)",

                ];
                return colors[index % colors.length];
            }

            var myChart;

            myChart = new Chart(ctx2, {
                type: "line",
                data: {
                    labels: responseData.labels.map(label => `${label}`),
                    datasets: [{
                        label: "Penjualan",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: totalPenjualan,
                        maxBarThickness: 6
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
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
                                // stepSize: 50000000,
                                padding: 10,
                                color: '#b2b9bf',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                            },
                            ticks: {
                                // maxTicksLimit: 10,
                                sampleSize: 10,
                                display: true,
                                padding: 10,
                                color: '#b2b9bf',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2,
                                },
                            },
                        },

                    },
                },
            });
        }
    </script>
@endpush
