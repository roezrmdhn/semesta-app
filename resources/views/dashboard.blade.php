@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Penjualan Bulan Ini
                                </p>
                                <h5 class="font-weight-bolder mb-2">Rp
                                    {{-- <h5 class="font-weight-bolder mb-0">IDR{{ $totalTransaksiHariIniFormatted }}</h5> --}}

                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Transaksi Bulan Ini
                                </p>
                                <h5 class="font-weight-bolder mb-0">
                                    0
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
    </div>
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
                        <div class="col-md-2">
                            {{-- <label for="daterange">Pilih Tanggal:</label> --}}
                            {{-- <input type="text" id="daterange" name="daterange" value="01/01/2018 - 01/15/2018" /> --}}
                            <div class="form-group">
                                <form action="" method="get" id="bulanForm">
                                    <label for="bulanSelect">Pilih Bulan:</label>
                                    <select id="bulanSelect" name="bulanSelect" class="form-control md-2">
                                        <option value="1" {{ $bulanSelect == 1 ? 'selected' : '' }}>Januari</option>
                                        <option value="2" {{ $bulanSelect == 2 ? 'selected' : '' }}>Februari</option>
                                        <option value="3" {{ $bulanSelect == 3 ? 'selected' : '' }}>Maret</option>
                                        <option value="4" {{ $bulanSelect == 4 ? 'selected' : '' }}>April</option>
                                        <option value="5" {{ $bulanSelect == 5 ? 'selected' : '' }}>Mei</option>
                                        <option value="6" {{ $bulanSelect == 6 ? 'selected' : '' }}>Juni</option>
                                        <option value="7" {{ $bulanSelect == 7 ? 'selected' : '' }}>Juli</option>
                                        <option value="8" {{ $bulanSelect == 8 ? 'selected' : '' }}>Agustus</option>
                                        <option value="9" {{ $bulanSelect == 9 ? 'selected' : '' }}>September</option>
                                        <option value="10" {{ $bulanSelect == 10 ? 'selected' : '' }}>Oktober</option>
                                        <option value="11" {{ $bulanSelect == 11 ? 'selected' : '' }}>November</option>
                                        <option value="12" {{ $bulanSelect == 12 ? 'selected' : '' }}>Desember</option>
                                    </select>
                                </form>
                            </div>

                        </div>
                        <div class="col-md-4">
                            {{-- <div class="form-group">
                                <label for="outletSelect">Pilih Outlet:</label>
                                <select id="outletSelect" class="form-control" multiple>
                                    <option value="semua" selected>Semua Outlet</option>
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label for="outletSelect">Pilih Outlet:</label>
                                <select id="outletSelect" class="outletSelect form-control md-2" name="outlet[]"
                                    multiple="multiple">
                                    <option value="Pilih Outlet" disabled>Pilih Outlet</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-2 mt-4">
                            <button id="filterButton" class="btn bg-gradient-primary"><i class="fa fa-filter"
                                    aria-hidden="true"></i> Filter</button>
                            <button id="resetButton" class="btn bg-gradient-danger"><i class="fa fa-undo"
                                    aria-hidden="true"></i>
                                </i> Reset</button>
                        </div>
                        {{-- <div class="col-md-2 mt-4"></div> --}}

                        <div class="col-md-2 mt-4 justify-content-end">
                            <button id="updateButton" class="btn bg-gradient-success"><i class="fa fa-refresh"
                                    aria-hidden="true"></i> Update</button>
                            <p id="countdown" class="text-small text-muted" style="font-size: 11px;"></p>
                        </div>
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
            $('.outletSelect').select2(
                //     {
                //     theme: 'bootstrap-5'
                // }
            );
        });
    </script>
    <script>
        // Ambil data respons
        var responseData = {!! json_encode($data) !!};

        // Dapatkan semua data penjualan dari dataset
        var allSalesData = responseData.dataset.map(outlet => outlet.data);

        // Hitung jumlah total penjualan dari semua dataset
        var totalPenjualan = allSalesData.reduce(function(acc, current) {
            return current.map(function(value, index) {
                return (acc[index] || 0) + value;
            });
        }, []);

        // Hitung jumlah total transaksi
        var totalTransaksi = totalPenjualan.reduce(function(acc, value) {
            return acc + value;
        }, 0);

        // Masukkan total transaksi ke dalam elemen HTML
        // document.querySelector('.font-weight-bolder.mb-2').textContent = totalTransaksi;
    </script>
    <script>
        // Ambil elemen form dan select
        var bulanForm = document.getElementById('bulanForm');
        var bulanSelect = document.getElementById('bulanSelect');

        // Tambahkan event listener ke select element
        bulanSelect.addEventListener('change', function() {
            // Submit formulir saat ada perubahan pada select element
            bulanForm.submit();
        });
    </script>
    <script>
        window.onload = function() {
            var ctx2 = document.getElementById("chart-line").getContext("2d");
            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');
            var responseData = {!! json_encode($data) !!};
            // Temukan elemen <select> dengan ID 'outletSelect'
            var outletSelect = document.getElementById('outletSelect');
            // Temukan elemen <select> dengan ID 'bulanSelect'
            var bulanSelect = document.getElementById('bulanSelect');

            // Tambahkan event listener untuk memantau perubahan pada elemen <select>
            bulanSelect.addEventListener('change', function() {
                // Ambil nilai bulan yang dipilih
                var selectedMonth = bulanSelect.value;

                // Kirim permintaan HTTP ke API dengan bulan yang dipilih
                var apiUrl = 'http://localhost:3000/transactions/charts?month=' + selectedMonth;

                // Lakukan permintaan HTTP dengan menggunakan fetch atau jQuery.ajax
                // Setelah menerima respons, Anda dapat memperbarui grafik dengan data baru
                // Contoh:
                fetch(apiUrl)
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        // Update grafik dengan data baru
                        updateChart(data);
                    })
                    .catch(function(error) {
                        console.error('Error:', error);
                    });
            });

            // Ambil data nama outlet dari respons
            var outletNames = responseData.dataset.map(outlet => outlet.label);
            // Loop melalui nama-nama outlet dan tambahkan mereka sebagai pilihan ke dalam elemen <select>
            outletNames.forEach(function(outletName) {
                var option = document.createElement('option');
                option.value = outletName; // Nilai yang akan dikirim saat dipilih
                option.text = outletName; // Teks yang akan ditampilkan dalam pilihan
                outletSelect.appendChild(option);
            });

            var allOutletData = responseData.dataset.map(outlet => outlet.data);
            var totalPenjualan = allOutletData.reduce(function(acc, current) {
                return current.map(function(value, index) {
                    return (acc[index] || 0) + value;
                });
            }, []);

            // Buat variabel untuk menyimpan outlet yang dipilih
            var selectedOutlets = [];

            // Temukan elemen tombol filter
            var filterButton = document.getElementById('filterButton');

            // Tambahkan event listener untuk tombol filter
            filterButton.addEventListener('click', function() {
                // Ambil semua outlet yang dipilih dari elemen <select> dengan ID 'outletSelect'
                var selectedOptions = Array.from(outletSelect.selectedOptions);
                selectedOutlets = selectedOptions.map(option => option.value);

                // Filter data berdasarkan outlet yang dipilih atau semua outlet
                var filteredData;
                if (selectedOutlets.includes('semua')) {
                    // Gunakan data dari semua outlet
                    filteredData = totalPenjualan;
                } else {
                    // Ambil data transaksi untuk outlet yang dipilih
                    filteredData = selectedOutlets.map(selectedOutlet => {
                        var selectedOutletData = responseData.dataset.find(outlet => outlet.label ===
                            selectedOutlet);
                        return selectedOutletData ? selectedOutletData.data : [];
                    });
                }

                // Update data grafik dengan data yang telah difilter
                updateChart(filteredData);
            });
            // Fungsi untuk mengupdate grafik dengan data yang difilter
            function updateChart(filteredData) {
                // Hapus dataset grafik yang ada
                while (myChart.data.datasets.length > 0) {
                    myChart.data.datasets.pop();
                }

                // Tambahkan dataset baru untuk setiap outlet yang dipilih
                selectedOutlets.forEach((selectedOutlet, index) => {
                    myChart.data.datasets.push({
                        label: selectedOutlet,
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: getLineColor(
                            index
                        ), // Fungsi ini akan menghasilkan warna garis yang berbeda untuk setiap outlet
                        borderWidth: 3,
                        backgroundColor: getBackgroundColor(
                            index
                        ), // Fungsi ini akan menghasilkan warna latar belakang yang berbeda untuk setiap outlet
                        fill: true,
                        data: filteredData[index],
                        maxBarThickness: 6
                    });
                });

                // Perbarui grafik
                myChart.update();
            }

            // Fungsi untuk menghasilkan warna garis yang berbeda
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
        // Countdown
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
        // Reset Button
        var resetButton = document.getElementById("resetButton");
        resetButton.addEventListener("click", function() {
            // Mengatur kembali nilai pilihan pada elemen select untuk bulan
            document.getElementById("bulanSelect").selectedIndex = 8; // Nilai 8 untuk bulan September
            // Mereset pilihan pada elemen select untuk outlet
            var outletSelect = document.getElementById("outletSelect");
            for (var i = 0; i < outletSelect.options.length; i++) {
                outletSelect.options[i].selected = false;
            }
            // Mengirim formulir untuk memulai ulang
            document.getElementById("bulanForm").submit();
        });
    </script>
@endpush
