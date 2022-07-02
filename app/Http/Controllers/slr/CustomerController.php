<?php

namespace App\Http\Controllers\slr\slr;

use App\Http\Controllers\slr\Controller;
use App\Models\Customer;

class CustomerController extends Controller
{
    function index() {
        $customers = Customer::all();
        return view('slr.customer.index', compact('customers'));
    }
}
