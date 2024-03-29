@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">{{ isset($task) ? 'Update Supplier Details' : 'Add New Supplier'}}</h4><br><br>

            <form method="POST" action="{{ isset($supplier) ? route('supplier.update' , $supplier->id) : route('supplier.store') }}" id="myForm">
                @csrf
                @if(isset($supplier))
                    @method('PUT')
                @endif

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Name</label>
                <div class="form-group col-sm-10">
                    <input name="name" class="form-control" type="text" value="{{ isset($supplier) ? $supplier->name : old('name') }}">
                </div>
            </div>
            <!-- end row -->
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Mobile Number</label>
                <div class="form-group col-sm-10">
                    <input name="mobile_no" class="form-control" type="text" value="{{ isset($supplier) ? $supplier->mobile_no : old('mobile_no') }}">
                </div>
            </div>
            <!-- end row -->
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Email</label>
                <div class="form-group col-sm-10">
                    <input name="email" class="form-control" type="email" value="{{ isset($supplier) ? $supplier->email : old('email') }}">
                </div>
            </div>
            <!-- end row -->
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Address</label>
                <div class="form-group col-sm-10">
                    <input name="address" class="form-control" type="text" value="{{ isset($supplier) ? $supplier->address : old('address') }}">
                </div>
            </div>
            <!-- end row -->

            <input type="submit" class="btn btn-info waves-effect waves-light" value="{{ isset($supplier) ? 'Update Supplier' : 'Add Supplier'}}">
            </form>



        </div>
    </div>
</div> <!-- end col -->
</div>



</div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
                mobile_no: {
                    required : true,
                },
                email: {
                    required : true,
                },
                address: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'Please Enter Supplier Name',
                },
                mobile_no: {
                    required : 'Please Enter Supplier Mobile Number',
                },
                email: {
                    required : 'Please Enter Supplier Email',
                },
                address: {
                    required : 'Please Enter Supplier Address',
                },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>

@endsection
