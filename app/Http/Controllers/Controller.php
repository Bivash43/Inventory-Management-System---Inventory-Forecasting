<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function getCategory(Request $request)
    {

        $supplier_id = $request->supplier_id;
        $allCategory = Product::with(['category'])->select('category_id')->where('supplier_id', $supplier_id)->groupBy('category_id')->get();
        return response()->json($allCategory);
    }

    public function getProduct(Request $request)
    {
        $category_id = $request->category_id;
        $supplier_id = $request->supplier_id;
        $allProduct = Product::where(['category_id' => $category_id, 'supplier_id' => $supplier_id])->get();
        return response()->json($allProduct);
    }
}
