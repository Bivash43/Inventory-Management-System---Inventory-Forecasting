<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Category;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $allData = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        return view('backend.invoice.index', compact('allData'));
    }

    public function create()
    {
        $categories = Category::all();
        $invoice_data = Invoice::orderBy('id', 'desc')->first();
        if ($invoice_data == null) {
            $firstReg = '0';
            $invoice_no = $firstReg + 1;
        } else {
            $firstReg = Invoice::orderBy('id', 'desc')->first()->invoice_no;
            $invoice_no = $firstReg + 1;
        }
        $date = date('Y-m-d');
        return view('backend.invoice.create', compact('categories', 'invoice_no', 'date'));
    }
}
