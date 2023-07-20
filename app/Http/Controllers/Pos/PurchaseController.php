<?php

namespace App\Http\Controllers\Pos;

use App\Models\Purchase;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $allData = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        return view('backend.purchase.purchse_all', compact('allData'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $units = Unit::all();
        $categories = Category::all();
        return view('backend.purchase.purchase_add', compact('suppliers', 'units', 'categories'));
    }
}
