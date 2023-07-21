<?php

namespace App\Http\Controllers\Pos;

use App\Models\Purchase;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    public function store(Request $request)
    {
        if ($request->product_id == null) {
            $notification = array(
                'message' => 'Sorry You have not selected any Prooduct',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            $count = count($request->product_id);

            for ($i = 0; $i < $count; $i++) {
                Purchase::create([
                    'supplier_id' => $request->supplier_id[$i],
                    'category_id' => $request->category_id[$i],
                    'product_id' => $request->product_id[$i],
                    'purchase_no' => $request->purchase_no[$i],
                    'date' => date('Y-m-d', strtotime($request->date[$i])),
                    'description' => $request->description[$i],
                    'buying_qty' => $request->buying_qty[$i],
                    'unit_price' => $request->unit_price[$i],
                    'buying_price' => $request->buying_price[$i],
                    'status' => 0,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        $notification = array(
            'message' => 'Purchase Process Have Been Initiated',
            'alert-type' => 'success'
        );

        return redirect()->route('purchase.index')->with($notification);
    }

    public function destroy($id)
    {
        Purchase::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Data Has Been Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('purchase.index')->with($notification);
    }

    public function approve()
    {
        $allData = Purchase::orderBy('date', 'desc')->where('status', 0)->orderBy('id', 'desc')->get();
        $approve = 1;
        return view('backend.purchase.purchse_all', compact('allData', 'approve'));
    }

    public function approveStatus($id)
    {
        // dd('here');
        Purchase::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Purchase Approved Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
