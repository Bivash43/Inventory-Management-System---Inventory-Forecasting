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
                            <option selected value="">Select Supplier</option>
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
                            <i class="btn btn-success btn-rounded waves-effect waves-light fas fa-plus-circle addeventmore"> Add More</i>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- end row --}}

                <div class="card-body">
                    <form action="" method="">
                        @csrf

                        <table class="table-sm table-bordered" width="100%" style="border-color: #ddd">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Product Name</th>
                                <th>Unit</th>
                                <th>Unit Price</th>
                                <th>Description</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="addRow" id="addRow">

                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="5"></td>

                                <td>
                                    <input type="text" name="estimated_amount" class="form-control estimated_amount" id="estimated_amount" value="0" readonly style="background-color: #ddd">
                                </td>

                            </tr>
                        </tbody>
                        </table>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info" id="storeButton" style="margin-top: 20px">Purchase</button>
                        </div>
                    </form>
                </div>

        </div>
    </div>
</div> <!-- end col -->
</div>



</div>
</div>

<script id="document-template" type="text/x-handlebars-template">

    <tr class="delete_add_more_item" id="delete_add_more_item">
    <input type="hidden" name="date[]" value="@{{ date }}">
    <input type="hidden" name="purchase_no[]" value="@{{ purchase_no }}">
    <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">

    <td>
        <input type="hidden" name="category_id[]" value="@{{ category_id }}"> @{{ category_name }}
    </td>
    <td>
        <input type="hidden" name="product_id[]" value="@{{ product_id }}"> @{{ product_name }}
    </td>
    <td>
        <input type="number" min="1" name="buying_qty[]" class="form-control buying_qty text-right">
    </td>
    <td>
        <input type="number" name="unit_price[]" class="form-control unit_price text-right">
    </td>
    <td>
        <input type="text" name="description[]" class="form-control">
    </td>
    <td>
        <input type="number" min="1" name="buying_price[]" class="form-control buying_price text-right" value="0" readonly>
    </td>

    <td>
    <i class="btn btn-danger btn-sm fas fa-window-close removeeventmore"></i>
    </td>

</tr>

</script>

<script type="text/javascript">

$(document).ready(function(){
    $(document).on('click' , '.addeventmore' , function(){
        var date = $('#date').val();
        var purchase_no = $('#purchase_no').val();
        var supplier_id = $('#supplier_id').val();
        var category_id = $('#category_id').val();
        var category_name = $('#category_id').find('option:selected').text();
        var product_id = $('#product_id').val();
        var product_name = $('#product_id').find('option:selected').text();

        if(date==''){
            $.notify("Date is Required" , {globalPosition:'top right' , className:'error'});
            return false;
        }
        if(purchase_no==''){
            $.notify("Purchase Number is Required" , {globalPosition:'top right' , className:'error'});
            return false;
        }
        if(supplier_id==''){
            $.notify("Supplier is Required" , {globalPosition:'top right' , className:'error'});
            return false;
        }
        if(category_id==''){
            $.notify("Category is Required" , {globalPosition:'top right' , className:'error'});
            return false;
        }
        if(product_id==''){
            $.notify("Product is Required" , {globalPosition:'top right' , className:'error'});
            return false;
        }

        var source = $("#document-template").html();
        var template = Handlebars.compile(source);
        var data = {
            date:date,
            purchase_no:purchase_no,
            supplier_id:supplier_id,
            category_id:category_id,
            category_name:category_name,
            product_id:product_id,
            product_name:product_name
        };
        var html = template(data);
        $("#addRow").append(html);
    });


    //remove product from table
    $(document).on('click' , '.removeeventmore' , function(){
        $(this).closest(".delete_add_more_item").remove();
        totalAmountPrice();
    });

    //calculate buying price
    $(document).on('keyup click' , '.unit_price , .buying_qty' , function(){
        var unit_price = $(this).closest('tr').find('input.unit_price').val();
        var qty = $(this).closest('tr').find('input.buying_qty').val();
        var total = unit_price*qty;

        $(this).closest('tr').find('input.buying_price').val(total);
        totalAmountPrice();
    });

    //calculate total price
    function totalAmountPrice(){
        var sum =0 ;
        $('.buying_price').each(function(){
            var value = $(this).val();
            if(!isNaN(value) && value.length != 0){
                sum+=parseFloat(value);
            }
        });
        $('#estimated_amount').val(sum);
    }


});

</script>

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
