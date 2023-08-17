<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Customer;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $allData = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '1')->get();
        return view('backend.invoice.index', compact('allData'));
    }

    public function create()
    {
        $categories = Category::all();
        $customers = Customer::all();
        $invoice_data = Invoice::orderBy('id', 'desc')->first();
        if ($invoice_data == null) {
            $firstReg = '0';
            $invoice_no = $firstReg + 1;
        } else {
            $firstReg = Invoice::orderBy('id', 'desc')->first()->invoice_no;
            $invoice_no = $firstReg + 1;
        }
        $date = date('Y-m-d');
        return view('backend.invoice.create', compact('categories', 'invoice_no', 'date', 'customers'));
    }

    public function store(Request $request)
    {
        if ($request->category_id == null) {
            $notification = array(
                'message' => 'Sorry You Do Not Select Any Item',
                'status' => 'error',
            );
            return redirect()->back()->with($notification);
        } else {
            if ($request->paid_amount == $request->estimated_amount) {
                $notification = array(
                    'message' => 'Sorry Paid Amount is greater than Total Amount',
                    'status' => 'error',
                );
                return redirect()->back()->with($notification);
            } else {
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d', strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = '0';
                $invoice->created_by = Auth::user()->id;

                DB::transaction(function () use ($request, $invoice) {
                    if ($invoice->save()) {
                        $count_category = count($request->category_id);
                        for ($i = 0; $i < $count_category; $i++) {
                            $invoice_details = new InvoiceDetail();
                            $invoice_details->date = date('Y-m-d', strtotime($request->date));
                            $invoice_details->invoice_id = $invoice->id;
                            $invoice_details->category_id = $request->category_id[$i];
                            $invoice_details->product_id = $request->product_id[$i];
                            $invoice_details->selling_qty = $request->selling_qty[$i];
                            $invoice_details->unit_price = $request->unit_price[$i];
                            $invoice_details->selling_price = $request->selling_price[$i];
                            $invoice_details->status = '1';
                            $invoice_details->save();
                        }
                        if ($request->customer_id == '1') {
                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->mobile_no = $request->mobile_no;
                            $customer->email = $request->email;
                            $customer->save();
                            $customer_id = $customer->id;
                        } else {
                            $customer_id = $request->customer_id;
                        }
                        $payment =  new Payment();
                        $payment_detail = new PaymentDetail();
                        $payment->invoice_id = $invoice->id;
                        $payment->customer_id = $customer_id;
                        $payment->paid_status = $request->paid_status;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;
                        if ($request->paid_status == 'full_paid') {
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $payment_detail->current_paid_amount = $request->estimated_amount;
                        } elseif ($request->paid_status == 'full_due') {
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $payment_detail->current_paid_amount = '0';
                        } elseif ($request->paid_status == 'partial_paid') {
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                            $payment_detail->current_paid_amount = $request->paid_amount;
                        }
                        $payment->save();

                        $payment_detail->invoice_id = $invoice->id;
                        $payment_detail->date =
                            date('Y-m-d', strtotime($request->date));
                        $payment_detail->save();
                    }
                });
            }
        }
        $notification = array(
            'message' => 'Invoice Data Inserted Successfully',
            'status' => 'success',
        );
        return redirect()->route('invoice.pending')->with($notification);
    }

    public function PendingList()
    {
        $allData = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();
        return view('backend.invoice.pending', compact('allData'));
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        InvoiceDetail::where('invoice_id', $invoice->id)->delete();
        Payment::where('invoice_id', $invoice->id)->delete();
        PaymentDetail::where('invoice_id', $invoice->id)->delete();
        $notification = array(
            'message' => 'Invoice Data Deleted Successfully',
            'status' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function approveStatus($id)
    {
        $invoice = Invoice::with('invoice_details')->findOrFail($id);
        return view('backend.invoice.approve', compact('invoice'));
    }

    public function invoiceApprove(Request $request, $id)
    {
        foreach ($request->selling_qty as $key => $val) {
            $invoice_details = InvoiceDetail::where('id', $key)->first();
            $product = Product::where('id', $invoice_details->product_id)->first();
            if ($product->quantity < $request->selling_qty[$key]) {
                $notification = array(
                    'message' => 'Sorry, ' . $product->name . ' Quantity Not Available',
                    'status' => 'error',
                );
                return redirect()->back()->with($notification);
            }
        }
        $invoice = Invoice::findOrFail($id);
        $invoice->status = '1';
        $invoice->updated_by = Auth::user()->id;
        DB::transaction(function () use ($invoice, $request, $id) {
            foreach ($request->selling_qty as $key => $val) {
                $invoice_details = InvoiceDetail::where('id', $key)->first();
                $product = Product::where('id', $invoice_details->product_id)->first();
                $product->quantity = ((float)$product->quantity) - ((float)$request->selling_qty[$key]);
                $product->save();
            }
            $invoice->save();
        });

        $notification = array(
            'message' => 'Invoice Approved Successfully',
            'status' => 'success',
        );
        return redirect()->route('invoice.pending')->with($notification);
    }
}
