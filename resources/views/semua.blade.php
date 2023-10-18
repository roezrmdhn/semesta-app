@extends('layouts.user_type.auth')
@section('content')
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Sales overview</h6>
                    <div class="row">
                        <form action="" method="get" id="bulanForm">
                            <div class="col-md-2 mt-2">
                                <div class="form-group">
                                    <label for="dateStart">Start</label>
                                    <input type="date" name="dateStart" id="dateStart" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 mt-2">
                                <div class="form-group">
                                    <label for="dateEnd">End</label>
                                    <input type="date" name="dateEnd" id="dateEnd" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 mt-2">
                                <div class="form-group">
                                    <label for="outletSelect">Pilih Outlet:</label>
                                    <select id="outletSelect" class="outletSelect" name="outletSelect[]"
                                        multiple="multiple">
                                        <option value="Pilih Outlet" disabled>Pilih Outlet</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <button type="submit" id="filterButton"
                                    class="btn bg-gradient-primary mt-2">Filter</button>
                            </div>
                        </form>
                        <div class="col-md-2 mt-2">
                            <button id="resetButton" class="btn bg-gradient-danger"><i class="fa fa-undo"
                                    aria-hidden="true"></i>
                                </i> Reset</button>
                        </div>
                    </div>
                    <p class="text-sm">
                        {{-- <span class="font-weight-bold"></span> September 2023 --}}
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
        // Data outlet
        var outlets = [{
                "name": "0011 Outlet Cilacap",
                "id": 953202
            },
            {
                "name": "0012 Outlet Metro Lampung",
                "id": 950389
            },
            {
                "name": "0013 Outlet Tegal",
                "id": 895233
            },
            {
                "name": "0014 Outlet Ungaran, Semarang",
                "id": 955300
            },
            {
                "name": "0015 Outlet Nologaten Jogja",
                "id": 904921
            },
            {
                "name": "004 Outlet Bogor Sentraland Paradise",
                "id": 896099
            },
            {
                "name": "005 Outlet Lubuklinggau",
                "id": 925214
            },
            {
                "name": "006 Cianjur",
                "id": 929763
            },
            {
                "name": "006 Outlet Cianjur",
                "id": 929766
            },
            {
                "name": "006 Outlet Solokpandan, Cianjur",
                "id": 924793
            },
            {
                "name": "009 Outlet Gramapuri Persada Cikarang",
                "id": 923456
            },
            {
                "name": "018 Outlet Cileungsi",
                "id": 959714
            },
            {
                "name": "019 Outlet Tanah Merdeka",
                "id": 957601
            },
            {
                "name": "Outlet Kandis, Riau",
                "id": 927583
            },
            {
                "name": "Outlet Sumba Barat",
                "id": 928201
            },
            {
                "name": "percobaan",
                "id": 897750
            },
            {
                "name": "Pusat",
                "id": 926797
            },
            {
                "name": "Pusat",
                "id": 886963
            },
            {
                "name": "training",
                "id": 895565
            }
        ];

        // Ambil elemen select
        var outletSelect = document.getElementById('outletSelect');

        // Loop melalui data outlet dan tambahkan opsi ke elemen select
        outlets.forEach(function(outlet) {
            var option = document.createElement('option');
            option.value = outlet.id; // Gunakan ID sebagai nilai
            option.text = outlet.name;
            outletSelect.appendChild(option);
        });
    </script>

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
        var bulanForm = document.getElementById('bulanForm');
        var dateStart = document.getElementById('dateStart');
        var dateEnd = document.getElementById('dateEnd');
        var outletSelect = document.getElementById('outletSelect');
        var filterButton = document.getElementById('filterButton');

        // Fungsi untuk memperbarui URL
        function updateURL() {
            var selectedDateStart = dateStart.value;
            var selectedDateEnd = dateEnd.value;
            var selectedOutlets = Array.from(outletSelect.selectedOptions).map(option => option.value);

            // Bangun URL dengan parameter yang sesuai
            var baseUrl = window.location.origin + window.location.pathname;
            var url = baseUrl + '?dateStart=' + selectedDateStart + '&dateEnd=' + selectedDateEnd;
            if (selectedOutlets.length > 0) {
                url += '&outletSelect[]=' + selectedOutlets.join('&outletSelect[]=');
            }

            // Setel URL
            window.history.replaceState(null, null, url);
        }

        // Tambahkan event listener untuk pembaruan URL saat filter diterapkan
        filterButton.addEventListener('click', function(e) {
            e.preventDefault(); // Hentikan perilaku bawaan form

            // Perbarui URL
            updateURL();

            // Sekarang Anda dapat mengirim formulir jika diperlukan
            document.getElementById('bulanForm').submit();
        });

        // Tambahkan event listener untuk memantau perubahan pada elemen-elemen
        dateStart.addEventListener('change', updateURL);
        dateEnd.addEventListener('change', updateURL);
        outletSelect.addEventListener('change', updateURL);

        // Fungsi untuk memeriksa parameter dalam URL dan memperbarui elemen sesuai dengan itu
        function updateFormFromURL() {
            var params = new URLSearchParams(window.location.search);
            dateStart.value = params.get('dateStart') || '';
            dateEnd.value = params.get('dateEnd') || [];
            var selectedOutlets = params.getAll('outletSelect[]');
            for (var i = 0; i < outletSelect.options.length; i++) {
                outletSelect.options[i].selected = selectedOutlets.includes(outletSelect.options[i].value);
            }
        }

        // Panggil fungsi ini untuk memperbarui elemen dari URL saat halaman dimuat
        updateFormFromURL();
    </script>
    <script>
        window.onload = function() {
            var ctx2 = document.getElementById("chart-line").getContext("2d");
            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');

            var responseData = {!! json_encode($data) !!};
            var dateStart = document.getElementById('dateStart');
            var dateEnd = document.getElementById('dateEnd');
            var outletSelect = document.getElementById('outletSelect');

            function getSelectedOutlets() {
                return Array.from(outletSelect.selectedOptions).map(function(option) {
                    return 'outlets=' + option.value;
                });
            }

            dateStart.addEventListener('change', function() {
                var selectedStart = dateStart.value;
                var selectedEnd = dateEnd.value;
                var selectedOutlets = getSelectedOutlets().join('&');
                var apiUrl = 'http://8.219.80.74:3000/transactions/charts?start=' + selectedStart + '&end=' +
                    selectedEnd + '&' + selectedOutlets;
                fetch(apiUrl)
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        updateChart(data);
                    })
                    .catch(function(error) {
                        console.error('Error:', error);
                    });
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
                                },
                            }
                        },
                    },
                },
            });
        }
    </script>
    <script>
        function startCountdown() {
            function updateCountdown() {
                const now = new Date();
                const minutes = now.getMinutes();
                const seconds = now.getSeconds();
                const minutesToNextInterval = (4 - (minutes % 5)) % 5;
                const secondsToNextInterval = 60 - seconds;
                const totalSecondsToNextInterval = minutesToNextInterval * 60 + secondsToNextInterval;
                const displayMinutes = Math.floor(totalSecondsToNextInterval / 60);
                const displaySeconds = totalSecondsToNextInterval % 60;
                document.getElementById('countdown').textContent =
                    `Memperbarui dalam ${displayMinutes}:${displaySeconds < 10 ? '0' : ''}${displaySeconds}`;
                if (totalSecondsToNextInterval === 0) {
                    fetchDataAndUpdateChart();
                    location.reload();
                }
            }
            const countdownInterval = setInterval(updateCountdown, 1000);
            updateCountdown();

            function fetchDataAndUpdateChart() {
                location.reload();
            }
        }
        startCountdown();
        document.getElementById('updateButton').addEventListener('click', () => {
            fetchDataAndUpdateChart();
        });

        function fetchDataAndUpdateChart() {
            location.reload();
        }
    </script>
    <script>
        var resetButton = document.getElementById("resetButton");
        resetButton.addEventListener("click", function() {
            document.getElementById("dateStart").selectedIndex = 2023 - 10 - 01;
            document.getElementById("dateEnd").selectedIndex = 2023 - 10 - 31;
            document.getElementById("outletSelect").selectedIndex = 904921;
            var outletSelect = document.getElementById("outletSelect");
            for (var i = 0; i < outletSelect.options.length; i++) {
                outletSelect.options[i].selected = false;
            }
            document.getElementById("bulanForm").submit();
        });
    </script>
@endpush
