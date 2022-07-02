<?php


namespace App\Http\Controllers\slr;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ItemController extends Controller
{
    function index()
    {
        $items = Item::all();
        $itemCategories = ItemCategory::all();
        return view('slr.item.index', compact('items', 'itemCategories'));
    }

    function add(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:items|max:40',
            'hsn_code' => 'required|max:8',
            'mrp' => 'required',
            'sgst' => 'required',
            'cgst' => 'required',
            'igst' => 'required',
            'item_category_id' => 'required|exists:item_categories,id',
        ], [
            'item_category_id.required' => 'Please Select Category',
            'item_category_id.exists' => 'Invalid Category',
        ]);

        $item = new Item();
        $item->name = $request->name;
        $item->hsn_code = $request->hsn_code;
        $item->mrp = $request->mrp;
        $item->sgst = $request->sgst;
        $item->cgst = $request->cgst;
        $item->igst = $request->igst;
        $item->item_category_id = $request->item_category_id;
        $item->save();

        return Redirect::back()->with('success', $item->name . ' Inserted Successfully With Id ' . $item->id);
    }
}
