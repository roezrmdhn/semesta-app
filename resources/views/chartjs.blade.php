@extends('layouts.user_type.auth')
@section('content')
    <style>
        #outletSelect {
            width: 570px;
            height: 100%;
            border: 1px solid #ccc;
        }
    </style>
    <div class="container-fluid py-4">
        <div class="row mt-4">
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
                            <div class="col-md-2 mt-4">
                                <button id="filterButton" class="btn bg-gradient-primary"><i class="fa fa-filter"
                                        aria-hidden="true"></i> Filter</button>
                            </div>
                            <div class="col-md-2 mt-4"></div>
                            <div class="col-md-2 mt-4 justify-content-end">
                                <button onClick="window.location.reload();" class="btn bg-gradient-danger"><i
                                        class="fa fa-undo" aria-hidden="true"></i> Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <p class="text-sm">
                            <span class="font-weight-bold">Transactions</span>
                        </p>
                        <p class="text-sm">
                            <span class="font-weight-bold">MONTHLY</span>
                        </p>
                        <div>
                            <div class="chart">
                                <canvas id="chart-line-monthly" class="chart-canvas" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-lg-0 mb-4">

                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <p class="text-sm">
                            <span class="font-weight-bold">Sales</span>
                        </p>
                        <p class="text-sm">
                            <span class="font-weight-bold">MONTHLY</span>
                        </p>
                        <div class="chart">
                            <canvas id="chart-line-monthly-sales" class="chart-canvas" height="400"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <p class="text-sm">
                            <span class="font-weight-bold">Transactions</span>
                        </p>
                        <p class="text-sm">
                            <span class="font-weight-bold">DATE</span>
                        </p>
                        <div>
                            <div class="chart">
                                <canvas id="chart-line-date" class="chart-canvas" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-lg-0 mb-4">
                {{-- <div class="card-header pb-0"> --}}
                {{-- <h6>Sales overview</h6> --}}
                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <p class="text-sm">
                            <span class="font-weight-bold">Sales</span>
                        </p>
                        <p class="text-sm">
                            <span class="font-weight-bold">DATE</span>
                        </p>
                        <div class="chart">
                            <canvas id="chart-line-date-sales" class="chart-canvas" height="400"></canvas>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <p class="text-sm">
                            <span class="font-weight-bold">Transactions</span>
                        </p>
                        <p class="text-sm">
                            <span class="font-weight-bold">AVG DATE</span>
                        </p>
                        <div>
                            <div class="chart">
                                <canvas id="chart-line-monthly-avg" class="chart-canvas" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-lg-0 mb-4">

                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <p class="text-sm">
                            <span class="font-weight-bold">Sales</span>
                        </p>
                        <p class="text-sm">
                            <span class="font-weight-bold">AVG DATE</span>
                        </p>
                        <div class="chart">
                            <canvas id="chart-line-monthly-sales-avg" class="chart-canvas" height="400"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <p class="text-sm">
                            <span class="font-weight-bold">Transactions</span>
                        </p>
                        <p class="text-sm">
                            <span class="font-weight-bold">AVG DAILY</span>
                        </p>
                        <div>
                            <div class="chart">
                                <canvas id="chart-line-daily" class="chart-canvas" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-lg-0 mb-4">
                {{-- <div class="card-header pb-0"> --}}
                {{-- <h6>Sales overview</h6> --}}
                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <p class="text-sm">
                            <span class="font-weight-bold">Sales</span>
                        </p>
                        <p class="text-sm">
                            <span class="font-weight-bold">AVG DAILY</span>
                        </p>
                        <div class="chart">
                            <canvas id="chart-line-daily-sales" class="chart-canvas" height="400"></canvas>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <p class="text-sm">
                            <span class="font-weight-bold">Transactions</span>
                        </p>
                        <p class="text-sm">
                            <span class="font-weight-bold">AVG HOUR</span>
                        </p>
                        <div>
                            <div class="chart">
                                <canvas id="chart-line-hourly" class="chart-canvas" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-lg-0 mb-4">
                {{-- <div class="card-header pb-0"> --}}
                {{-- <h6>Sales overview</h6> --}}
                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <p class="text-sm">
                            <span class="font-weight-bold">Sales</span>
                        </p>
                        <p class="text-sm">
                            <span class="font-weight-bold">AVG HOUR</span>
                        </p>
                        <div class="chart">
                            <canvas id="chart-line-hourly-sales" class="chart-canvas" height="400"></canvas>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
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
        var responseDataMonthly = {!! json_encode($dataMonthly) !!};
        var responseDataMonthlySales = {!! json_encode($dataMonthlySales) !!};
        var responseDataMonthlyAvg = {!! json_encode($dataMonthlyAvg) !!};
        var responseDataMonthlySalesAvg = {!! json_encode($dataMonthlySalesAvg) !!};
        var responseDataDate = {!! json_encode($dataDate) !!};
        var responseDataDateSales = {!! json_encode($dataDateSales) !!};
        var responseDataDaily = {!! json_encode($dataDaily) !!};
        var responseDataHourly = {!! json_encode($dataHourly) !!};
        var responseDataHourlySales = {!! json_encode($dataHourlySales) !!};
        var responseDataDailySales = {!! json_encode($dataDailySales) !!};
        var allSalesDataMonthly = responseDataMonthly.dataset.map(outlet => outlet.data);
        var allSalesDataMonthlySales = responseDataMonthlySales.dataset.map(outlet => outlet.data);

        // Rata Rata
        var allSalesDataMonthlySalesAvg = responseDataMonthlySalesAvg.dataset.map(outlet => outlet.data);
        var allSalesDataMonthlyAvg = responseDataMonthlyAvg.dataset.map(outlet => outlet.data);
        var allSalesDataDate = responseDataDate.dataset.map(outlet => outlet.data);
        var allSalesDataDateSales = responseDataDateSales.dataset.map(outlet => outlet.data);
        var allSalesDataDaily = responseDataDaily.dataset.map(outlet => outlet.data);
        var allSalesDataHourly = responseDataHourly.dataset.map(outlet => outlet.data);
        var allSalesDataDailySales = responseDataDailySales.dataset.map(outlet => outlet.data);
        var totalPenjualanMonthly = allSalesDataMonthly.reduce(function(acc, current) {
            return current.map(function(value, index) {
                return (acc[index] || 0) + value;
            });
        }, []);
        var totalTransaksiMonthly = totalPenjualanMonthly.reduce(function(acc, value) {
            return acc + value;
        }, 0);
        var totalPenjualanMonthlySales = allSalesDataMonthlySales.reduce(function(acc, current) {
            return current.map(function(value, index) {
                return (acc[index] || 0) + value;
            });
        }, []);
        var totalTransaksiMonthlyAvg = totalPenjualanMonthlyAvg.reduce(function(acc, value) {
            return acc + value;
        }, 0);
        var totalPenjualanMonthlyAvg = allSalesDataMonthlyAvg.reduce(function(acc, current) {
            return current.map(function(value, index) {
                return (acc[index] || 0) + value;
            });
        }, []);
        var totalTransaksiMonthlySalesAvg = totalPenjualanMonthlySalesAvg.reduce(function(acc, value) {
            return acc + value;
        }, 0);
        var totalPenjualanMonthlySalesAvg = allSalesDataMonthlySalesAvg.reduce(function(acc, current) {
            return current.map(function(value, index) {
                return (acc[index] || 0) + value;
            });
        }, []);
        var totalTransaksiMonthlySales = totalPenjualanMonthlySales.reduce(function(acc, value) {
            return acc + value;
        }, 0);
        var totalPenjualanDate = allSalesDataDate.reduce(function(acc, current) {
            return current.map(function(value, index) {
                return (acc[index] || 0) + value;
            });
        }, []);
        var totalTransaksiDate = totalPenjualanDate.reduce(function(acc, value) {
            return acc + value;
        }, 0);
        var totalPenjualanDateSales = allSalesDataDateSales.reduce(function(acc, current) {
            return current.map(function(value, index) {
                return (acc[index] || 0) + value;
            });
        }, []);
        var totalTransaksiDateSales = totalPenjualanDateSales.reduce(function(acc, value) {
            return acc + value;
        }, 0);
        var totalPenjualanDaily = allSalesDataDaily.reduce(function(acc, current) {
            return current.map(function(value, index) {
                return (acc[index] || 0) + value;
            });
        }, []);
        var totalTransaksiDaily = totalPenjualanDaily.reduce(function(acc, value) {
            return acc + value;
        }, 0);
        var totalPenjualanDailySales = allSalesDataDailySales.reduce(function(acc, current) {
            return current.map(function(value, index) {
                return (acc[index] || 0) + value;
            });
        }, []);
        var totalTransaksiDailySales = totalPenjualanDailySales.reduce(function(acc, value) {
            return acc + value;
        }, 0);
        var totalPenjualanHourly = allSalesDataHourly.reduce(function(acc, current) {
            return current.map(function(value, index) {
                return (acc[index] || 0) + value;
            });
        }, []);
        var totalTransaksiHourly = totalPenjualanHourly.reduce(function(acc, value) {
            return acc + value;
        }, 0);
        var totalPenjualanHourlySales = allSalesDataHourlySales.reduce(function(acc, current) {
            return current.map(function(value, index) {
                return (acc[index] || 0) + value;
            });
        }, []);
        var totalTransaksiHourlySales = totalPenjualanHourlySales.reduce(function(acc, value) {
            return acc + value;
        }, 0);
    </script>
    <script>
        window.onload = function() {
            var ctx2 = document.getElementById("chart-line-monthly").getContext("2d");
            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');
            var outletSelect = document.getElementById('outletSelect');
            // Inisialisasi sebuah Set untuk melacak nama-nama outlet yang sudah ada
            var outletNamesSet = new Set();
            // Loop melalui data outlet
            responseDataMonthly.dataset.forEach(function(outlet) {
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

            var allOutletData = responseDataMonthly.dataset.map(outlet => outlet.data);
            var totalPenjualanMonthly = allOutletData.reduce(function(acc, current) {
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
                    filteredData = totalPenjualanMonthly;
                } else {
                    filteredData = selectedOutlets.map(selectedOutlet => {
                        var selectedOutletData = responseDataMonthly.dataset.find(outlet => outlet
                            .label ===
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
                    labels: responseDataMonthly.labels.map(label => {
                        const date = new Date(label);
                        return date.toLocaleString('default', {
                            month: 'short'
                        });
                    }),
                    datasets: [{
                        label: "Penjualan",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: totalPenjualanMonthly,
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
                                // stepSize:    50000000,
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
                                // sampleSize: 10,
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
            var ctx3 = document.getElementById("chart-line-date").getContext("2d");
            var gradientStroke1 = ctx3.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');
            var outletSelect = document.getElementById('outletSelect');
            // Inisialisasi sebuah Set untuk melacak nama-nama outlet yang sudah ada
            var outletNamesSet = new Set();

            // Loop melalui data outlet
            responseDataDate.dataset.forEach(function(outlet) {
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

            var allOutletData = responseDataDate.dataset.map(outlet => outlet.data);
            var totalPenjualanDate = allOutletData.reduce(function(acc, current) {
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
                    filteredData = totalPenjualanDate;
                } else {
                    filteredData = selectedOutlets.map(selectedOutlet => {
                        var selectedOutletData = responseDataDate.dataset.find(outlet => outlet
                            .label ===
                            selectedOutlet);
                        return selectedOutletData ? selectedOutletData.data : [];
                    });
                }
                updateChart(filteredData);
            });

            function updateChart(filteredData) {
                while (myChart3.data.datasets.length > 0) {
                    myChart3.data.datasets.pop();
                }
                selectedOutlets.forEach((selectedOutlet, index) => {
                    myChart3.data.datasets.push({
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
                myChart3.update();
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

            var myChart3;

            myChart3 = new Chart(ctx3, {
                type: "line",
                data: {
                    labels: responseDataDate.labels.map(label => `${label}`),
                    datasets: [{
                        label: "Penjualan",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: totalPenjualanDate,
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
                                // stepSize:    50000000,
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
                                // sampleSize: 10,
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

            // Monthly Sales
            var ctx4 = document.getElementById("chart-line-monthly-sales").getContext("2d");
            var gradientStroke1 = ctx4.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');
            var outletSelect = document.getElementById('outletSelect');
            // Inisialisasi sebuah Set untuk melacak nama-nama outlet yang sudah ada
            var outletNamesSet = new Set();

            // Loop melalui data outlet
            responseDataMonthlySales.dataset.forEach(function(outlet) {
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

            var allOutletDataMonthlySales = responseDataMonthlySales.dataset.map(outlet => outlet.data);
            var totalPenjualanMonthlySales = allOutletDataMonthlySales.reduce(function(acc, current) {
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
                    filteredData = totalPenjualanMonthlySales;
                } else {
                    filteredData = selectedOutlets.map(selectedOutlet => {
                        var selectedOutletData = responseDataMonthlySales.dataset.find(outlet => outlet
                            .label ===
                            selectedOutlet);
                        return selectedOutletData ? selectedOutletData.data : [];
                    });
                }
                updateChart(filteredData);
            });

            function updateChart(filteredData) {
                while (myChart4.data.datasets.length > 0) {
                    myChart4.data.datasets.pop();
                }
                selectedOutlets.forEach((selectedOutlet, index) => {
                    myChart4.data.datasets.push({
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
                myChart4.update();
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

            var myChart4;

            myChart4 = new Chart(ctx4, {
                type: "line",
                data: {
                    labels: responseDataMonthly.labels.map(label => {
                        const date = new Date(label);
                        return date.toLocaleString('default', {
                            month: 'short'
                        });
                    }),
                    datasets: [{
                        label: "Penjualan",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: totalPenjualanMonthlySales,
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
                                // stepSize:    50000000,
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
                                // sampleSize: 10,
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

            // Date Transaction
            var ctx5 = document.getElementById("chart-line-date-sales").getContext("2d");
            var gradientStroke1 = ctx5.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');
            var outletSelect = document.getElementById('outletSelect');
            // Inisialisasi sebuah Set untuk melacak nama-nama outlet yang sudah ada
            var outletNamesSet = new Set();

            // Loop melalui data outlet
            responseDataDateSales.dataset.forEach(function(outlet) {
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

            var allOutletDataMonthlySales = responseDataDateSales.dataset.map(outlet => outlet.data);
            var totalPenjualanMonthlySales = allOutletDataMonthlySales.reduce(function(acc, current) {
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
                    filteredData = totalPenjualanMonthlySales;
                } else {
                    filteredData = selectedOutlets.map(selectedOutlet => {
                        var selectedOutletData = responseDataDateSales.dataset.find(outlet => outlet
                            .label ===
                            selectedOutlet);
                        return selectedOutletData ? selectedOutletData.data : [];
                    });
                }
                updateChart(filteredData);
            });

            function updateChart(filteredData) {
                while (myChart5.data.datasets.length > 0) {
                    myChart5.data.datasets.pop();
                }
                selectedOutlets.forEach((selectedOutlet, index) => {
                    myChart5.data.datasets.push({
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
                myChart5.update();
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

            var myChart5;

            myChart5 = new Chart(ctx5, {
                type: "line",
                data: {
                    labels: responseDataDateSales.labels.map(label => `${label}`),
                    datasets: [{
                        label: "Penjualan",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: totalPenjualanMonthlySales,
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
                                // stepSize:    50000000,
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
                                // sampleSize: 10,
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

            // Chart Daily
            var ctx6 = document.getElementById("chart-line-daily").getContext("2d");
            var gradientStroke1 = ctx6.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');

            var allOutletDataDaily = responseDataDaily.dataset.map(outlet => outlet.data);
            var totalPenjualanDaily = allOutletDataDaily[0];

            var myChart6 = new Chart(ctx6, {
                type: "line",
                data: {
                    labels: responseDataDaily.labels,
                    datasets: [{
                        label: "Average Daily Transactions",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: totalPenjualanDaily.map(value => parseFloat(
                            value)), // Konversi data string ke float
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

            // Chart Daily Sales
            var ctxDailySales = document.getElementById("chart-line-daily-sales").getContext("2d");
            var gradientStroke1 = ctxDailySales.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');

            var allOutletDataDailySales = responseDataDailySales.dataset.map(outlet => outlet.data);
            var totalPenjualanDaily = allOutletDataDailySales[0];

            var myChartDailySales = new Chart(ctxDailySales, {
                type: "line",
                data: {
                    labels: responseDataDailySales.labels,
                    datasets: [{
                        label: "Average Daily Transactions",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: totalPenjualanDaily.map(value => parseFloat(
                            value)), // Konversi data string ke float
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

            // Chart Hourly
            var ctx7 = document.getElementById("chart-line-hourly").getContext("2d");
            var gradientStroke1 = ctx7.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');

            var allOutletDataHourly = responseDataHourly.dataset.map(outlet => outlet.data);
            var totalPenjualanHourly = allOutletDataHourly[0];

            var myChart7 = new Chart(ctx7, {
                type: "line",
                data: {
                    labels: responseDataHourly.labels,
                    datasets: [{
                        label: "Average Hourly Transactions",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: totalPenjualanHourly.map(value => parseFloat(
                            value)), // Konversi data string ke float
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

            // Chart Hourly Sales
            var ctxHourlySales = document.getElementById("chart-line-hourly-sales").getContext("2d");
            var gradientStroke1 = ctxHourlySales.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');

            var allOutletDataHourlySales = responseDataHourlySales.dataset.map(outlet => outlet.data);
            var totalPenjualanHourly = allOutletDataHourlySales[0];

            var myChart7 = new Chart(ctxHourlySales, {
                type: "line",
                data: {
                    labels: responseDataHourlySales.labels,
                    datasets: [{
                        label: "Average Hourly Transactions",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: totalPenjualanHourly.map(value => parseFloat(
                            value)), // Konversi data string ke float
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

            // Chart MonthlyAvg
            var ctx8 = document.getElementById("chart-line-monthly-avg").getContext("2d");
            var gradientStroke1 = ctx8.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');

            var allOutletDataMonthlyAvg = responseDataMonthlyAvg.dataset.map(outlet => outlet.data);
            var totalPenjualanMonthlyAvg = allOutletDataMonthlyAvg[0];

            var myChart8 = new Chart(ctx8, {
                type: "line",
                data: {
                    labels: responseDataMonthlyAvg.labels,
                    datasets: [{
                        label: "Average MonthlyAvg Transactions",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: totalPenjualanMonthlyAvg.map(value => parseFloat(
                            value)), // Konversi data string ke float
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
            // Chart MonthlySalesAvg
            var ctxMonhtlySalesAvg = document.getElementById("chart-line-monthly-sales-avg").getContext("2d");
            var gradientStroke1 = ctxMonhtlySalesAvg.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');

            var allOutletDataMonthlySalesAvg = responseDataMonthlySalesAvg.dataset.map(outlet => outlet.data);
            var totalPenjualanMonthlySalesAvg = allOutletDataMonthlySalesAvg[0];

            var myChartMonthlySalesAvg = new Chart(ctxMonhtlySalesAvg, {
                type: "line",
                data: {
                    labels: responseDataMonthlySalesAvg.labels,
                    datasets: [{
                        label: "Average MonthlySalesAvg Transactions",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: totalPenjualanMonthlySalesAvg.map(value => parseFloat(
                            value)), // Konversi data string ke float
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
