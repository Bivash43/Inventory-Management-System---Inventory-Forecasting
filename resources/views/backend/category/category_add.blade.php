@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">{{ isset($category) ? 'Update Category Details' : 'Add New Category'}}</h4><br><br>

            <form method="POST" action="{{ isset($category) ? route('category.update' , $category->id) : route('category.store') }}" id="myForm" enctype="multipart/form-data">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Category Name</label>
                <div class="form-group col-sm-10">
                    <input name="name" class="form-control" type="text" value="{{ isset($category) ? $category->name : old('name') }}">
                </div>
            </div>

                <input type="submit" class="btn btn-info waves-effect waves-light" value="{{ isset($category) ? 'Update Category' : 'Add Category'}}">
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
            },
            messages :{
                name: {
                    required : 'Please Enter category Name',
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
