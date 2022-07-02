<?php

namespace App\Http\Controllers\slr;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InvoiceController extends Controller
{
    function index() {
        $invoices = Invoice::all();
        return view('slr.invoice.index', compact('invoices'));
    }

    function create(Request $request) {
        $validateData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
        ], [
            'customer_id.required' => 'Please Select Area',
            'customer_id.exists' => 'Invalid Customer',
        ]);

        $invoice = new Invoice();
        $invoice->customer_id = $request->customer_id;
        $invoice->creation_time = now();
        $invoice->save();
        return Redirect::route('invoice',['id' => $invoice->id]);
    }

    function invoice(Request $request) {
        $invoice = Invoice::find($request->id);
        $items = Item::all();
        return view('slr.invoice.invoice', compact('invoice', 'items'));
    }

    function addItem(Request $request) {
        $validateData = $request->validate([
            'item_id' => 'required|exists:items,id',
            'rate' => 'required',
            'quantity' => 'required',
        ], [
            'item_id.required' => 'Please Select Item',
            'item_id.exists' => 'Invalid Item',
        ]);

        $invoiceItem = new InvoiceItem();
        $invoiceItem->invoice_id = $request->id;
        $invoiceItem->item_id = $request->item_id;
        $invoiceItem->rate = $request->rate;
        $invoiceItem->quantity = $request->quantity;
        $invoiceItem->save();

        return Redirect::back()->with('success','Added Successfully');
    }

    function deleteItem(Request $request) {
        $invoiceItem = InvoiceItem::find($request->invoiceItemId);
        $invoiceItem->delete();

        return Redirect::back()->with('success','Deleted Successfully');
    }

    function print(Request $request) {
        $invoice = Invoice::find($request->id);
    }
}
