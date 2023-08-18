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
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-body">
                                  <h1 class="card-title mb-3">Predict For Products</h1>
                                  <form method="POST" action="{{ route('saleinfo.predictProduct') }}">
                                      @csrf
                                  <div class="row" style="margin-bottom: 20px">
                                    <label>Select Product</label>
                                      <select name="product_id" id="product_id" class="form-select select2">
                                      <option value="">Select Product</option>
                                      @foreach ($products as $data )
                                      <option value="{{ $data->id }}">{{ $data->name }}</option>
                                      @endforeach
                                      </select>
                                      </div>
                                      <button type="submit"  class="btn btn-info waves-effect waves-light">Predict</button>
                                  </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                  <h1 class="card-title mb-3">Predict For Category</h1>
                                  <form method="POST" action="{{ route('saleinfo.predictCategory' , 1) }}">
                                      @csrf
                                  <div class="row" style="margin-bottom: 20px">
                                    <label>Select Product</label>
                                      <select name="category_id" id="category_id" class="form-select select2">
                                      <option value="">Select Category</option>
                                      @foreach ($category as $data )
                                      <option value="{{ $data->id }}">{{ $data->name }}</option>
                                      @endforeach
                                      </select>
                                      </div>
                                      <button type="submit"  class="btn btn-info waves-effect waves-light">Predict</button>
                                  </form>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-7">
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="card-title mb-4">Revenue Per Month</h1>
                                    <canvas id="lineChart" height="200"></canvas>
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
    type: 'bar',
    data: {
      //labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: JSON.parse('{!! $detail !!}'),
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