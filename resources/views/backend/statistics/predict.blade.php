@extends('admin.admin_master')
@section('admin')


 <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Sales Data</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                            <div class="col-lg-7">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title mb-4">Revenue Per Month</h3>
                                        <canvas id="lineChart" height="200"></canvas>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-5">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title mb-4">Predection For Month</h4>

                                        <div class="row text-center">
                                            <div class="col-mb-4">
                                                <h5 class="mb-0">Prediction For {{ $nextMonth }}</h5>
                                                <p class="text-muted text-truncate"><p>For next month it is predicted to sell {{ $predection }} kgs of {{ $product->name }}</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('saleinfo.index') }}" class="btn btn-info waves-effect waves-light">Predict Another Data</a>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->


                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->



    </div> <!-- container-fluid -->
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('lineChart');

  new Chart(ctx, {
    type: 'line',
    data: {
      //labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: JSON.parse('{!! $productSold !!}'),
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
{{-- <script>
  const app = document.getElementById('bar');

  new Chart(app, {
    type: 'line',
    data: {
      //labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: JSON.parse('{!! $productSold !!}'),
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
</script> --}}
@endsection