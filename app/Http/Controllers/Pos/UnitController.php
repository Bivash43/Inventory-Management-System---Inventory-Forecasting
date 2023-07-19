<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('backend.unit.unit_all', compact('units'));
    }
    public function create()
    {
        return view('backend.unit.unit_add');
    }

    public function store(Request $request)
    {
        Unit::insert([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Unit Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('unit.index')->with($notification);
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('backend.unit.unit_add', compact('unit'));
    }

    public function update(Request $request, $id)
    {

        Unit::findOrFail($id)->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Unit Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('unit.index')->with($notification);
    }

    // public function show($id)
    // {
    //     dd($id);
    // }

    public function destroy($id)
    {
        Unit::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Unit Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
