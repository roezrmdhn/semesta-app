<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
    <!-- Include library chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Data Transaksi</h1>
    <canvas id="transaksiChart" width="400" height="200"></canvas>

    <script>
        // Ambil data dari PHP dan konversi ke JavaScript
        var data = @json($data);

        // Siapkan data untuk chart
        var labels = data.labels;
        var dataSet = data.dataSet;

        // Buat chart
        var ctx = document.getElementById('transaksiChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line', // Atur jenis chart yang sesuai
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Pemasukan',
                    data: dataSet,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
