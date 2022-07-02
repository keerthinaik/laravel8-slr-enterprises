<?php

namespace App\Http\Controllers\slr;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    function index() {
        $customers = Customer::all();
        $areas = Area::all();
        return view('slr.customer.index', compact('customers', 'areas'));
    }

    function add(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:items|max:100',
            'address' => 'required',
            'gst_no' => 'required',
            'area_id' => 'required|exists:areas,id',
        ], [
            'area_id.required' => 'Please Select Area',
            'area_id.exists' => 'Invalid Area',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->gst_no = $request->gst_no;
        $customer->area_id = $request->area_id;
        $customer->phone_no = $request->phone_no;
        $customer->save();

        return Redirect::back()->with('success', $customer->name . ' Inserted Successfully');
    }
}
