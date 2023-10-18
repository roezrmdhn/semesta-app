@extends('layouts.user_type.auth')
@section('content')
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Riwayat Penjualan</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart" style="position:relative">
                        <div id="div_g" style="width:100%; height:500px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('dashboard')
        <style>
            #darkbg .dygraph-axis-label {
                color: white;
            }

            .dygraph-legend {
                text-align: right;
            }

            #darkbg .dygraph-legend {
                background-color: #101015;
            }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="https://unpkg.com/dygraphs@2.2.1/dist/dygraph.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/dygraphs@2.2.1/dist/dygraph.min.css" />
        <script>
            // Fungsi untuk mengambil data CSV dari URL
            function fetchDataAndCreateGraph() {
                fetch('http://8.219.80.74:3000/transactions/charts?start=2023-10-17&format=dygraph')
                    .then(response => response.text())
                    .then(data => {
                        // Parse data CSV ke dalam format yang dapat digunakan oleh Dygraph
                        const lines = data.split('\n');
                        const dataRows = [];
                        for (let i = 1; i < lines.length; i++) {
                            const parts = lines[i].split(',');
                            if (parts.length > 1) {
                                const date = new Date(parts[0]);
                                const values = parts.slice(1).map(value => parseInt(value));
                                dataRows.push([date].concat(values));
                            }
                        }

                        // Membuat grafik Dygraph
                        new Dygraph(document.getElementById('div_g'), dataRows, {
                            labels: ['Date', 'Cilacap', 'Metro Lampung', 'Tegal', 'Ungaran, Semarang',
                                'Nologaten Jogja', 'Lubuk Linggau', 'Solokpandan, Cianjur',
                                'Gramapuri Persada Cikarang', 'Cileungsi', 'Tanah Merdeka', 'Kandis, Riau',
                                'Sumba Barat'
                            ],
                            title: 'Grafik Jumlah Transaksi Outlet per Hari',
                            showRangeSelector: true,
                            legend: 'always'
                        });
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }

            fetchDataAndCreateGraph();
        </script>
    @endpush
