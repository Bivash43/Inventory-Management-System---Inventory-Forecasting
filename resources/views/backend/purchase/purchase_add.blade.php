@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Add Purchase</h4><br><br>

                <div class="row">
                    <div class="col-md-4">
                        <div class="md-3">
                            <label for="example-text-input" class="form-label">
                                Date
                            </label>
                            <input type="date" class="form-control example-date-input" name="date" id="date">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="md-3">
                            <label for="example-text-input" class="form-label">
                                Purchase No.
                            </label>
                            <input type="text" class="form-control example-date-input" name="purchase_no" id="purchase_no">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="md-3">
                            <label for="example-text-input" class="form-label">
                                Supplier Name
                            </label>
                            <select name="supplier_id" id="supplier_id" class="form-select" aria-label="Default select example">
                            <option selected>Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="md-3">
                            <label for="example-text-input" class="form-label">
                                Category Name
                            </label>
                            <select name="category_id" id="category_id" class="form-select" aria-label="Default select example">
                            <option selected>Select Category</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="md-3">
                            <label for="example-text-input" class="form-label">
                                Product Name
                            </label>
                            <select name="product_id" id="product_id" class="form-select" aria-label="Default select example">
                            <option selected>Select Product</option>
                            </select>
                        </div>
                    </div>



                    <div class="col-md-4">
                        <div class="md-3">
                            <label for="example-text-input" class="form-label" style="margin-top: 43px"></label>
                            <input type="sumbit" class="btn btn-success btn-rounded waves-effect waves-light" value="Add More">
                            </select>
                        </div>
                    </div>
                </div>
                {{-- end row --}}

        </div>
    </div>
</div> <!-- end col -->
</div>



</div>
</div>

<script type="text/javascript">

$(function(){
    $(document).on('change' , '#supplier_id' , function () {
        var supplier_id = $(this).val();
        $.ajax({
            url:"{{ route('get-category') }}",
            type:"GET",
            data:{supplier_id:supplier_id},
            success:function(data){
                var html = '<option value="">Select Category</option>';
                $.each(data,function(key,v){
                    html+='<option value="'+v.category_id+'">'+v.category.name+'</option>';
                });
                $('#category_id').html(html);
                $('#product_id').html('<option value="">Select Product</option>');
            }
        });
    });
});

$(function(){
    $(document).on('change' , '#category_id' , function(){
        var category_id = $(this).val();
        var supplier_id = $('#supplier_id').val();
        $.ajax({
            url:"{{ route('get-product') }}",
            type:"GET",
            data:{category_id:category_id,
                supplier_id:supplier_id},
            success:function(data){
                var html = '<option value="">Select Product</option>';
                $.each(data,function(key,v){
                    html+='<option value="'+v.id+'">'+v.name+'</option>';
                });
                $('#product_id').html(html);
            }
        });
    });
});

</script>


@endsection
