@extends('admin.admin_master')
@section('admin')


<div class="page-content">
<div class="container-fluid">

<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Dashboard</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">IMS</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>

</div>
</div>
</div>
<!-- end page title -->

<div class="row">
<div class="col-xl-3 col-md-6">
<div class="card">
    <div class="card-body">
        <div class="d-flex">
            <div class="flex-grow-1">
                <p class="text-truncate font-size-14 mb-2">Total Suppliers</p>
                <h4 class="mb-2">{{ $suppliers->count() }}</h4>
                {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p> --}}
            </div>
            <div class="avatar-sm">
                <span class="avatar-title bg-light text-primary rounded-3">
                    <i class="ri-truck-line font-size-24"></i>
                    {{-- <i class="ri-shopping-cart-2-line font-size-24"></i> --}}
                </span>
            </div>
        </div>
    </div><!-- end cardbody -->
</div><!-- end card -->
</div><!-- end col -->
<div class="col-xl-3 col-md-6">
<div class="card">
    <div class="card-body">
        <div class="d-flex">
            <div class="flex-grow-1">
                <p class="text-truncate font-size-14 mb-2">Total Customers</p>
                <h4 class="mb-2">{{ $customers->count() }}</h4>
                {{-- <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ri-arrow-right-down-line me-1 align-middle"></i>1.09%</span>from previous period</p> --}}
            </div>
            <div class="avatar-sm">
                <span class="avatar-title bg-light text-success rounded-3">
                    <i class="ri-user-star-line font-size-24"></i>
                    {{-- <i class="mdi mdi-currency-usd font-size-24"></i> --}}
                </span>
            </div>
        </div>
    </div><!-- end cardbody -->
</div><!-- end card -->
</div><!-- end col -->
<div class="col-xl-3 col-md-6">
<div class="card">
    <div class="card-body">
        <div class="d-flex">
            <div class="flex-grow-1">
                <p class="text-truncate font-size-14 mb-2">Total Products</p>
                <h4 class="mb-2">{{ $products->count() }}</h4>
                {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from previous period</p> --}}
            </div>
            <div class="avatar-sm">
                <span class="avatar-title bg-light text-primary rounded-3">
                    <i class="ri-store-line font-size-24"></i>
                    {{-- <i class="ri-user-3-line font-size-24"></i> --}}
                </span>
            </div>
        </div>
    </div><!-- end cardbody -->
</div><!-- end card -->
</div><!-- end col -->
<div class="col-xl-3 col-md-6">
<div class="card">
    <div class="card-body">
        <div class="d-flex">
            <div class="flex-grow-1">
                <p class="text-truncate font-size-14 mb-2">Total Product Categories</p>
                <h4 class="mb-2">{{ $categories->count() }}</h4>
                {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>11.7%</span>from previous period</p> --}}
            </div>
            <div class="avatar-sm">
                <span class="avatar-title bg-light text-success rounded-3">
                    <i class="ri-pages-line font-size-24"></i>
                    {{-- <i class="mdi mdi-currency-btc font-size-24"></i> --}}
                </span>
            </div>
        </div>
    </div><!-- end cardbody -->
</div><!-- end card -->
</div><!-- end col -->
</div><!-- end row -->

{{-- <div class="row">
<div class="row">
<div class="col-xl-12">
<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4">Inventory Status</h4>
    </div><!-- end card -->
</div><!-- end card -->
</div> --}}
<!-- end col -->


</div>
<!-- end row -->
</div>

</div>

@endsection