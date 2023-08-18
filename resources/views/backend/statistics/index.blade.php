@extends('admin.admin_master')
@section('admin')


 <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">All Invoice</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title mb-4">Line Chart</h4>

                                        <div class="row text-center">
                                            <div class="col-4">
                                                <h5 class="mb-0">86541</h5>
                                                <p class="text-muted text-truncate">Activated</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0">2541</h5>
                                                <p class="text-muted text-truncate">Pending</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0">102030</h5>
                                                <p class="text-muted text-truncate">Deactivated</p>
                                            </div>
                                        </div>

                                        <canvas id="lineChart" height="200"></canvas>

                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title mb-4">Bar Chart</h4>

                                        <div class="row text-center">
                                            <div class="col-4">
                                                <h5 class="mb-0">2541</h5>
                                                <p class="text-muted text-truncate">Activated</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0">84845</h5>
                                                <p class="text-muted text-truncate">Pending</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0">12001</h5>
                                                <p class="text-muted text-truncate">Deactivated</p>
                                            </div>
                                        </div>

                                        <canvas id="bar" height="200"></canvas>

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
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
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
<script>
  const app = document.getElementById('bar');

  new Chart(app, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
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
@endsection