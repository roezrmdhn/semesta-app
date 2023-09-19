@extends('layouts.user_type.auth')

@section('content')
    <style>
        #bulanSelect {
            width: 140px;
            /* Sesuaikan lebar sesuai kebutuhan Anda */
        }

        #tahunSelect {
            width: 140px;
            /* Sesuaikan lebar sesuai kebutuhan Anda */
        }
    </style>
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Transaksi</p>
                                <h5 class="font-weight-bolder mb-0">
                                    IDR0
                                    <span class="text-success text-sm font-weight-bolder">+0%</span>
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
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Penjualan</p>
                                <h5 class="font-weight-bolder mb-0">
                                    IDR0
                                    <span class="text-success text-sm font-weight-bolder">+0%</span>
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
        <div class="col-lg-11">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Sales overview</h6>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="outletSelect">Pilih Outlet:</label>
                                <select id="outletSelect" class="form-control">
                                    <option value="semua">Semua Outlet</option>
                                    <!-- Pilihan outlet -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tahunSelect">Pilih Tahun:</label>
                                <select id="tahunSelect" class="form-control">
                                    <option value="2023">2023</option>
                                    <!-- Tambahkan tahun lainnya di sini -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="bulanSelect">Pilih Bulan:</label>
                                <select id="bulanSelect" class="form-control md-2">
                                    {{-- <option value="01">Januari</option>
              <option value="02">Februari</option>
              <option value="03">Maret</option>
              <option value="04">April</option>
              <option value="05">Mei</option>
              <option value="06">Juni</option> --}}
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09" selected>September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">

                            <button id="filterButton" class="btn bg-gradient-primary mt-2"><i class="fa fa-filter"
                                    aria-hidden="true"></i> Filter</button>
                        </div>
                        <div class="col-md-2 mt-4 d-flex justify-content-end">
                            <button id="updateButton" class="btn bg-gradient-success mt-2"><i class="fa fa-refresh"
                                    aria-hidden="true"></i> Update</button>
                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                            <p id="countdown" class="text-small text-muted" style="font-size: 11px;"></p>
                        </div>
                    </div>
                    <p class="text-sm">
                        {{-- <i class="fa fa-arrow-up text-success"></i> --}}
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
        // Fungsi untuk menginisialisasi countdown
        function startCountdown() {
            let countdown = 5 * 60; // 5 menit dalam detik

            // Fungsi untuk memperbarui teks countdown
            function updateCountdown() {
                const minutes = Math.floor(countdown / 60);
                const seconds = countdown % 60;
                document.getElementById('countdown').textContent =
                    `Refresh data dalam ${minutes}:${seconds < 10 ? '0' : ''}${seconds}  `;

                if (countdown === 0) {
                    // Jalankan logika pembaruan data di sini
                    fetchDataAndUpdateChart();

                    // Mulai countdown lagi setelah pembaruan data
                    countdown = 5 * 60;
                } else {
                    countdown--;
                }
            }

            // Jalankan fungsi updateCountdown setiap 1 detik
            const countdownInterval = setInterval(updateCountdown, 1000);

            // Inisialisasi countdown awal
            updateCountdown();

            // Event listener untuk tombol "Update Data"
            document.getElementById('updateButton').addEventListener('click', () => {
                fetchDataAndUpdateChart();
                countdown = 5 * 60; // Mulai countdown dari awal setelah pembaruan manual
            });

            // Fungsi ini akan memanggil logika untuk mengambil data dan memperbarui chart
            function fetchDataAndUpdateChart() {
                // Gantilah ini dengan logika pengambilan data dan pembaruan chart sesuai kebutuhan Anda
                // Contoh:
                console.log('Mengambil data dan memperbarui chart...');
            }
        }

        // Panggil fungsi untuk memulai countdown
        startCountdown();
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const bulanSelect = document.getElementById("bulanSelect");
            const filterButton = document.getElementById("filterButton");

            filterButton.addEventListener("click", function() {
                // Ambil nilai bulan yang dipilih
                const selectedMonth = bulanSelect.value;

                // Kirim permintaan HTTP ke server dengan parameter bulan
                // Anda perlu menyesuaikan URL dan endpoint sesuai dengan backend Anda
                const url = `http://localhost:3000/transactions/charts?bulan=${selectedMonth}`;

                // Lakukan permintaan HTTP untuk mengambil data baru
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        // Perbarui grafik dengan data baru
                        chart.data.labels = data.labels.map(label => `Tanggal ${label}`);
                        chart.data.datasets[0].data = data.dataSet;
                        chart.update();
                    })
                    .catch(error => {
                        console.error("Terjadi kesalahan saat mengambil data:", error);
                    });
            });
        });
    </script>
    <script>
        window.onload = function() {
            var ctx2 = document.getElementById("chart-line").getContext("2d");
            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

            var responseData = {!! json_encode($data) !!}; // Menghapus tanda kurung {}

            var allOutletData = responseData.dataset.map(outlet => outlet.data);

            var totalTransaksi = allOutletData.reduce(function(acc, current) {
                return current.map(function(value, index) {
                    return (acc[index] || 0) + value;
                });
            }, []);

            new Chart(ctx2, {
                type: "line",
                data: {
                    labels: responseData.labels.map(label => `Tanggal ${label}`),
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
@endpush
