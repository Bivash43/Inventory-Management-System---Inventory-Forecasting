@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">{{ isset($product) ? 'Update Product Details' : 'Add New Product'}}</h4><br><br>

            <form method="POST" action="{{ isset($product) ? route('product.update' , $product->id) : route('product.store') }}" id="myForm" enctype="multipart/form-data">
                @csrf
                @if(isset($product))
                    @method('PUT')
                @endif

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Product Name</label>
                <div class="form-group col-sm-10">
                    <input name="name" class="form-control" type="text" value="{{ isset($product) ? $product->name : old('name') }}">
                </div>
            </div>
            <!-- end row -->

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Select Supplier</label>
                <div class="col-sm-10">
                    <select name="supplier_id" class="form-select" aria-label="Default select example">
                        <option value="{{ isset($product) ? $product->supplier_id : old('supplier_id') }}">Select Supplier</option>
                        @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ isset($product) ? ($supplier->id==$product->supplier_id ? 'selected' : '') : '' }}>{{ $supplier->name }}</option>
                        @endforeach
                        </select>
                </div>
            </div>
            <!-- end row -->

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Select Unit</label>
                <div class="col-sm-10">
                    <select name="unit_id" class="form-select" aria-label="Default select example">
                        <option value="{{ isset($product) ? $product->unit_id : old('unit_id') }}">Select Unit</option>
                        @foreach ($units as $unit)
                        <option value="{{ $unit->id }}" {{ isset($product) ? ($unit->id==$product->unit_id ? 'selected' : ''): '' }}>{{ $unit->name }}</option>
                        @endforeach
                        </select>
                </div>
            </div>
            <!-- end row -->

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Select Category</label>
                <div class="col-sm-10">
                    <select name="category_id" class="form-select" aria-label="Default select example">
                        <option value="{{ isset($product) ? $product->category_id : old('category_id') }}">Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ isset($product) ? ($unit->id==$product->unit_id ? 'selected' : '') :'' }}>{{ $category->name }}</option>
                        @endforeach
                        </select>
                </div>
            </div>
            <!-- end row -->

                <input type="submit" class="btn btn-info waves-effect waves-light" value="{{ isset($product) ? 'Update product' : 'Add product'}}">
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
                supplier_id: {
                    required : true,
                },
                unit_id: {
                    required : true,
                },
                category_id: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'Please Enter product Name',
                },
                supplier_id: {
                    required : 'Please Select Supplier',
                },
                unit_id: {
                    required : 'Please Select Unit',
                },
                category_id: {
                    required : 'Please Select Category',
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
