<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Symfony\Component\Finder\Iterator\CustomFilterIterator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('backend.customer.customer_all', compact('customers'));
    }

    public function create()
    {
        return view('backend.Customer.customer_add');
    }

    public function store(Request $request)
    {
        $image = $request->customer_image;
        $name =  hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $save_url = ('upload/customer/' . $name);
        Image::make($image)->resize(200, 200)->save($save_url);
        Customer::insert([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'customer_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Customer Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.index')->with($notification);
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.customer.customer_add', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        if ($request->file('customer_image')) {
            $image = $request->customer_image;
            $name =  hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = ('upload/customer/' . $name);
            Image::make($image)->resize(200, 200)->save($save_url);
            Customer::findOrFail($id)->update(['customer_image' => $save_url]);
        }

        Customer::findOrFail($id)->update([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Customer Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.index')->with($notification);
    }

    // public function show($id)
    // {
    //     dd($id);
    // }

    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();
        $notification = array(
            'message' => 'CustomerDeleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
