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
                    <a href="{{ route('invoice.create') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right">Add Invoice</a>
                    <br><br>

                    <h4 class="card-title">All Invoice Data </h4>


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Customer Name</th>
                            <th>Invoice No</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Amount</th>

                        </thead>


                        <tbody>

                        	@foreach($allData as $key => $item)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $item->payment->customer->name }} </td>
                            <td> #{{ $item->invoice_no}} </td>
                            <td> {{ date('Y-m-d', strtotime($item->date)) }} </td>
                            <td> {{ $item->description }} </td>
                            {{-- <td>
                                @if ($item->status==0)
                                <span class="btn btn-warning">Pending</span>
                                @endif
                                @if ($item->status==1)
                                <span class="btn btn-success">Approved</span>
                                @endif

                            </td> --}}
                            <td>
                                Rs.{{ $item->payment->total_amount }}
                                {{-- <a href="{{ route('purchase.edit' , $item->id) }}" class="btn btn-info sm" title="Edit Data">
                                    <i class="fas fa-edit"></i> </a> --}}

                                {{-- @if ($item->status==0 && isset($approve) )
                                    <a href="{{ route('purchase.status' , $item->id) }}" class="btn btn-danger sm" title="Approve Data" id="approve">
                                        <i class="fas fa-check-circle"></i> </a>
                                @elseif ($item->status==0)
                                    <a href="{{ route('purchase.destroy' , $item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">
                                        <i class="fas fa-trash-alt"></i> </a>
                                @endif --}}
                            </td>

                        </tr>
                        @endforeach

                        </tbody>
                    </table>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->



                    </div> <!-- container-fluid -->
                </div>


@endsection