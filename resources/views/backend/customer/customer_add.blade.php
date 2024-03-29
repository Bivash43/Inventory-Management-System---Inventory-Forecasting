@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">{{ isset($customer) ? 'Update customer Details' : 'Add New customer'}}</h4><br><br>

            <form method="POST" action="{{ isset($customer) ? route('customer.update' , $customer->id) : route('customer.store') }}" id="myForm" enctype="multipart/form-data">
                @csrf
                @if(isset($customer))
                    @method('PUT')
                @endif

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Customer Name</label>
                <div class="form-group col-sm-10">
                    <input name="name" class="form-control" type="text" value="{{ isset($customer) ? $customer->name : old('name') }}">
                </div>
            </div>
            <!-- end row -->
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Customer Mobile Number</label>
                <div class="form-group col-sm-10">
                    <input name="mobile_no" class="form-control" type="text" value="{{ isset($customer) ? $customer->mobile_no : old('mobile_no') }}">
                </div>
            </div>
            <!-- end row -->
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Customer Email</label>
                <div class="form-group col-sm-10">
                    <input name="email" class="form-control" type="email" value="{{ isset($customer) ? $customer->email : old('email') }}">
                </div>
            </div>
            <!-- end row -->
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Customer Address</label>
                <div class="form-group col-sm-10">
                    <input name="address" class="form-control" type="text" value="{{ isset($customer) ? $customer->address : old('address') }}">
                </div>
            </div>
            <!-- end row -->
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Customer Image </label>
                <div class="form-group col-sm-10">
                <input name="customer_image" class="form-control" type="file"  id="image" @empty($customer) required @endempty>
                </div>
            </div>
            <!-- end row -->

              <div class="row mb-3">
                 <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                <div class="col-sm-10">
                    <img id="showImage" class="rounded avatar-lg" src="{{((!empty($customer))? url($customer->customer_image):url('upload/no_image.jpg')) }}" alt="Card image cap">
                </div>
            </div>

                <input type="submit" class="btn btn-info waves-effect waves-light" value="{{ isset($customer) ? 'Update customer' : 'Add customer'}}">
                <button type="reset" class="btn btn-danger waves-effect waves-light">Reset</button>
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
                    required : 'Please Enter Customer Name',
                },
                mobile_no: {
                    required : 'Please Enter Customer Mobile Number',
                },
                email: {
                    required : 'Please Enter Customer Email',
                },
                address: {
                    required : 'Please Enter Customer Address',
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

<script type="text/javascript">

    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

@endsection
