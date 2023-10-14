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
    #darkbg .dygraph-axis-label { color: white; }
    .dygraph-legend { text-align: right; }
    #darkbg .dygraph-legend { background-color: #101015; }
  </style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://unpkg.com/dygraphs@2.2.1/dist/dygraph.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/dygraphs@2.2.1/dist/dygraph.min.css" />
<script>
     $(document).ready(function() {
      var data = [];
      var t = new Date();
      for (var i = 10; i >= 0; i--) {
        var x = new Date(t.getTime() - i * 1000);
        data.push([x, Math.random(), Math.random()]);
      }

      var g = new Dygraph(document.getElementById("div_g"), data,
                          {
                            drawPoints: true,
                            showRoller: true,
                            valueRange: [0.0, 1.2, 1.2],
                            labels: ['Time', 'Random 1', 'Random 2'],
                            title: 'Transaksi ',
                            legend: 'always',
                            ylabel: 'Total Transaksi'
                          });
      // It sucks that these things aren't objects, and we need to store state in window.
      window.intervalId = setInterval(function() {
        var x = new Date();  // current time
        var y = Math.random();
        var z = Math.random();
        data.push([x, y, z]);
        g.updateOptions( { 'file': data } );
      }, 1000);
    }
);
</script>
@endpush
