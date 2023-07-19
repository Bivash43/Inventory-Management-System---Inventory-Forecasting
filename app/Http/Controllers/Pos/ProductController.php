<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $units = Unit::all();
        $categories = Category::all();
        return view('backend.product.product_add', compact('suppliers', 'units', 'categories'));
    }

    public function store(Request $request)
    {
        Product::create([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('product.index')->with($notification);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $suppliers = Supplier::all();
        $units = Unit::all();
        $categories = Category::all();
        return view('backend.product.product_add', compact('suppliers', 'units', 'categories', 'product'));
    }

    public function update(Request $request, $id)
    {
        Product::findOrFail($id)->update([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('product.index')->with($notification);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Customer Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.index')->with($notification);
    }
}
