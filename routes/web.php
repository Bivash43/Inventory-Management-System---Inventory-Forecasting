<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Demo\DemoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\Pos\SupplierController;
use App\Http\Controllers\Pos\UnitController;
use App\Http\Controllers\Pos\PurchaseController;
use App\Http\Controllers\Pos\ProductController;
use App\Http\Controllers\SaleInfoController;
use App\Models\Category;
use App\Models\Customer;
use App\Models\LinearRegression;
use App\Models\Product;
use App\Models\Supplier;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::controller(DemoController::class)->group(function () {
    Route::get('/about', 'Index')->name('about.page')->middleware('check');
    Route::get('/contact', 'ContactMethod')->name('cotact.page');
});


// Admin All Route
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');

    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');
});


Route::controller(SupplierController::class)->group(function () {
    Route::get('/supplier/all', 'SupplierAll')->name('supplier.all');
    Route::get('/supplier/add', 'SupplierAdd')->name('supplier.add');
    Route::post('/supplier/store', 'SupplierStore')->name('supplier.store');
    Route::get('/supplier/edit/{id}', 'SupplierEdit')->name('supplier.edit');
    Route::put('/supplier/update/{id}', 'SupplierUpdate')->name('supplier.update');
    Route::get('/supplier/destroy/{id}', 'SupplierDestroy')->name('supplier.destroy');
});

Route::controller(CustomerController::class)->group(function () {
    Route::get('/customer', 'index')->name('customer.index');
    Route::get('/customer/add', 'create')->name('customer.create');
    Route::post('/customer/store', 'store')->name('customer.store');
    Route::get('/customer/edit/{id}', 'edit')->name('customer.edit');
    Route::put('/customer/update/{id}', 'update')->name('customer.update');
    Route::get('/customer/destroy/{id}', 'destroy')->name('customer.destroy');
});

Route::controller(UnitController::class)->group(function () {
    Route::get('/unit', 'index')->name('unit.index');
    Route::get('/unit/add', 'create')->name('unit.create');
    Route::post('/unit/store', 'store')->name('unit.store');
    Route::get('/unit/edit/{id}', 'edit')->name('unit.edit');
    Route::put('/unit/update/{id}', 'update')->name('unit.update');
    Route::get('/unit/destroy/{id}', 'destroy')->name('unit.destroy');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'index')->name('category.index');
    Route::get('/category/add', 'create')->name('category.create');
    Route::post('/category/store', 'store')->name('category.store');
    Route::get('/category/edit/{id}', 'edit')->name('category.edit');
    Route::put('/category/update/{id}', 'update')->name('category.update');
    Route::get('/category/destroy/{id}', 'destroy')->name('category.destroy');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/product', 'index')->name('product.index');
    Route::get('/product/add', 'create')->name('product.create');
    Route::post('/product/store', 'store')->name('product.store');
    Route::get('/product/edit/{id}', 'edit')->name('product.edit');
    Route::put('/product/update/{id}', 'update')->name('product.update');
    Route::get('/product/destroy/{id}', 'destroy')->name('product.destroy');
});

Route::controller(PurchaseController::class)->group(function () {
    Route::get('/purchase', 'index')->name('purchase.index');
    Route::get('/purchase/add', 'create')->name('purchase.create');
    Route::post('/purchase/store', 'store')->name('purchase.store');
    Route::get('/purchase/edit/{id}', 'edit')->name('purchase.edit');
    Route::get('/purchase/destroy/{id}', 'destroy')->name('purchase.destroy');
    Route::get('/purchase/approve', 'approve')->name('purchase.approve');
    Route::get('/purchase/approve/{id}', 'approveStatus')->name('purchase.status');
});

Route::controller(Controller::class)->group(function () {
    Route::get('/get-category', 'getCategory')->name('get-category');
    Route::get('/get-product', 'getProduct')->name('get-product');
    Route::get('/check-product-stock', 'checkStock')->name('check-product-stock');
});

Route::controller(InvoiceController::class)->group(function () {
    Route::get('/invoice', 'index')->name('invoice.index');
    Route::get('/invoice/add', 'create')->name('invoice.create');
    Route::post('/invoice/store', 'store')->name('invoice.store');
    Route::get('/invoice/edit/{id}', 'edit')->name('invoice.edit');
    Route::put('/invoice/update/{id}', 'update')->name('invoice.update');
    Route::get('/invoice/destroy/{id}', 'destroy')->name('invoice.destroy');
    Route::get('/invoice/pending/list', 'PendingList')->name('invoice.pending');
    Route::get('/invoice/approve/{id}', 'approveStatus')->name('invoice.status');
    Route::post('/invoice/approve/action/{id}', 'invoiceApprove')->name('invoice.approve');
    Route::get('/print/invoice/list', 'PrintInvoiceList')->name('print.invoice.list');
    Route::get('/invoice/print/{id}', 'PrintInvoice')->name('print.invoice');
});

Route::get('/dashboard', function () {
    $suppliers = Supplier::all();
    $customers = Customer::all();
    $products = Product::all();
    $categories = Category::all();
    return view('admin.index', compact('suppliers', 'customers', 'products', 'categories'));
})->middleware(['auth'])->name('dashboard');

Route::resource('saleinfo', SaleInfoController::class);
Route::post('saleinfo/predictProduct', [SaleInfoController::class, 'predictProduct'])->name('saleinfo.predictProduct');
Route::post('saleinfo/predictCategory', [SaleInfoController::class, 'predictCategory'])->name('saleinfo.predictCategory');

require __DIR__ . '/auth.php';


// Route::get('/contact', function () {
//     return view('contact');
// });
