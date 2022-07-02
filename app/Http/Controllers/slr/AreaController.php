<?php

namespace App\Http\Controllers\slr;

use App\Http\Controllers\Controller;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AreaController extends Controller
{
    function index() {
        $areas = Area::all();
        return view('slr.area.index', compact('areas'));
    }

    function add(Request $request) {
        $validateData = $request->validate([
            'name' => 'required|unique:areas|max:20',
        ]);

        $area = new Area();
        $area->name = Str::lower($request->name);
        $area->save();

        return Redirect::back()->with('success', $area->name.' Inserted Successfully');
    }
}
