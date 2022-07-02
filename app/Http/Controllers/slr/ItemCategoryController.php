<?php

namespace App\Http\Controllers\slr;

use App\Http\Controllers\Controller;
use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ItemCategoryController extends Controller
{
    function index() {
        $itemCategories = ItemCategory::all();
        return view('slr.item_category.index', compact('itemCategories'));
    }

    function add(Request $request) {
        $validateData = $request->validate([
            'name' => 'required|unique:item_categories|max:20',
        ],[
            'name.required' => 'category name should not be empty',
        ]);

        $itemCategory = new ItemCategory();
        $itemCategory->name = $request->name;
        $itemCategory->save();

        return Redirect::back()->with('success',$itemCategory->name.' Inserted Successfully');
    }
}
