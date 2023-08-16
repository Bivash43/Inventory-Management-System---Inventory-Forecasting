@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Add Invoice</h4><br><br>


                <div class="col-md-2">
                    <div class="md-2">
                        <label for="example-text-input" class="form-label">
                            Invoice No
                        </label>
                        <input type="text" class="form-control" name="invoice_no" id="invoice_no" readonly style="background-color: #ddd" value="{{ $invoice_no }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">
                        <div class="md-2">
                            <label for="example-text-input" class="form-label">
                                Date
                            </label>
                            <input type="date" class="form-control example-date-input" name="date" id="date" value="{{ $date }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="md-3">
                            <label for="example-text-input" class="form-label">
                                Category Name
                            </label>
                            <select name="category_id" id="category_id" class="form-select select2" aria-label="Default select example">
                            <option selected value="">Select Category</option>
                            @foreach ($categories as $item )
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="md-3">
                            <label for="example-text-input" class="form-label">
                                Product Name
                            </label>
                            <select name="product_id" id="product_id" class="form-select select2" aria-label="Default select example">
                            <option selected value="">Select Product</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                    <div class="md-2">
                        <label for="example-text-input" class="form-label">
                            Stock(KG /Pcs)
                        </label>
                        <input type="text" class="form-control" name="current_stock_qty" id="current_stock_qty" readonly style="background-color: #ddd">
                    </div>
                </div>

                    <div class="col-md-2">
                        <div class="md-2">
                            <label for="example-text-input" class="form-label" style="margin-top: 43px"></label>
                            <i class="btn btn-success btn-rounded waves-effect waves-light fas fa-plus-circle addeventmore"> Add More</i>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- end row --}}

                <div class="card-body">
                    <form action="{{ route('invoice.store') }}" method="POST">
                        @csrf

                        <table class="table-sm table-bordered" width="100%" style="border-color: #ddd">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Product Name</th>
                                <th width = "7%">Quantity (Kg /Pcs)</th>
                                <th width = "10%">Unit Price</th>
                                <th width = "15%">Total Price</th>
                                <th width = "7%">Action</th>
                            </tr>
                        </thead>

                        <tbody class="addRow" id="addRow">

                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="4">Discount</td>
                                <td>
                                    <input type="text" name="discount_amount" class="form-control estimated_amount" id="discount_amount" placeholder="Discount Amount">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">Grand Total</td>

                                <td>
                                    <input type="text" name="estimated_amount" class="form-control estimated_amount" id="estimated_amount" value="0" readonly style="background-color: #ddd">
                                </td>

                            </tr>
                        </tbody>
                        </table><br>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <textarea name="description" id="description" class="form-control" placeholder="Write Description Here"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Paid Status</label>
                                <select name="paid_status" id="paid_status" class="form-select">
                                    <option value="">Select Status</option>
                                    <option value="full_paid">Full Paid</option>
                                    <option value="partial_paid">Partial Paid</option>
                                    <option value="full_due">Full Due</option>
                                </select>
                                <input type="text" name="paid_amount" class="form-control paid_amount" placeholder="Enter Paid Amount" style="display: none; margin-top:10px;">
                            </div>

                            <div class="form-group col-md-9">
                                <label>Customer Name</label>
                                <select name="customer_id" id="customer_id" class="form-select">
                                    <option value="">Select Customer</option>
                                    <option value="1">New Customer</option>
                                    @foreach ($customers as $data )
                                    <option value="{{ $data->id }}">{{ $data->name }}-{{ $data->mobile_no }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <!--Add customer Details-->
                        <div class="row newCustomer" style="display: none; margin-top:20px;">
                            <div class="form-group col-md-4">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Customer Name">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" name="mobile_no" class="form-control" id="mobile_no" placeholder="Emter Customer Mobile">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" name="email" class="form-control" id="email" placeholder="Enter Customer Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-info" id="storeButton" style="margin-top: 20px">Add Invoice</button>
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
    <input type="hidden" name="date" value="@{{ date }}">
    <input type="hidden" name="invoice_no" value="@{{ invoice_no }}">
    <td>
        <input type="hidden" name="category_id[]" value="@{{ category_id }}"> @{{ category_name }}
    </td>
    <td>
        <input type="hidden" name="product_id[]" value="@{{ product_id }}"> @{{ product_name }}
    </td>
    <td>
        <input type="number" min="1" name="selling_qty[]" class="form-control selling_qty text-right">
    </td>
    <td>
        <input type="number" name="unit_price[]" class="form-control unit_price text-right">
    </td>
    <td>
        <input type="number" min="1" name="selling_price[]" class="form-control selling_price text-right" value="0" readonly>
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
        var invoice_no = $('#invoice_no').val();
        var category_id = $('#category_id').val();
        var category_name = $('#category_id').find('option:selected').text();
        var product_id = $('#product_id').val();
        var product_name = $('#product_id').find('option:selected').text();

        if(date==''){
            $.notify("Date is Required" , {globalPosition:'top right' , className:'error'});
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
        else{
        var source = $("#document-template").html();
        var template = Handlebars.compile(source);
        var data = {
            date:date,
            invoice_no:invoice_no,
            category_id:category_id,
            category_name:category_name,
            product_id:product_id,
            product_name:product_name
        };
        var html = template(data);
        $("#addRow").append(html);
    }
    });


    //remove product from table
    $(document).on('click' , '.removeeventmore' , function(){
        $(this).closest(".delete_add_more_item").remove();
        totalAmountPrice();
    });

    //calculate selling price
    $(document).on('keyup click' , '.unit_price , .selling_qty' , function(){
        var unit_price = $(this).closest('tr').find('input.unit_price').val();
        var qty = $(this).closest('tr').find('input.selling_qty').val();
        var total = unit_price*qty;

        $(this).closest('tr').find('input.selling_price').val(total);
        $('#discount_amount').trigger('keyup');
        //totalAmountPrice();
    });

    $(document).on('keyup', '#discount_amount' ,  function(){

        totalAmountPrice();
    });

    //calculate total price
    function totalAmountPrice(){
        var sum =0 ;

        $('.selling_price').each(function(){
            var value = $(this).val();
            if(!isNaN(value) && value.length != 0){
                sum+=parseFloat(value);

            }
        });
        var discount_amount = $('#discount_amount').val();
        if(!isNaN(discount_amount) && discount_amount.length != 0){

                sum-=parseFloat(discount_amount);
            }
            if(sum>=0){
                $('#estimated_amount').val(sum);
            }
    }


});

</script>

<script type="text/javascript">

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

<script type="text/javascript">

$(function(){
    $(document).on('change' , '#product_id' , function(){
        var product_id = $(this).val();
        $.ajax({
            url:"{{ route('check-product-stock') }}",
            type:"GET",
            data:{product_id:product_id},
            success:function(data){
                $('#current_stock_qty').val(data);
            }
        });
    });
});

</script>

<script type="text/javascript">
    $(document).on('change', '#paid_status', function(){
        var paid_status = $(this).val();
        if (paid_status == "partial_paid"){
            $('.paid_amount').show();
        }else{
            $('.paid_amount').hide();
        }
    });

    $(document).on('change', '#customer_id', function(){
        var paid_status = $(this).val();
        if (paid_status == "1"){
            $('.newCustomer').show();
        }else{
            $('.newCustomer').hide();
        }
    });
</script>
@endsection
