<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('id', 'asc')->get();
        return view('backend.pages.unit.index', compact('units'));
    }

    public function store(Request $request)
    {
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->related_unit_id = $request->related_unit_id;
        $unit->related_sign = $request->related_sign;
        $unit->related_value = $request->related_value;
        $unit->save();
        if ($unit) {
            notify()->success('Unit added successfully');
            return back();
        } else {
            notify()->error('Unit could not be added');
            return back();
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
        $unit = Unit::findOrFail($id);
        $unit->name = $request->name;
        $unit->related_unit_id = $request->related_unit_id;
        $unit->related_sign = $request->related_sign;
        $unit->related_value = $request->related_value;
        $unit->save();

        notify()->success('Unit updated successfully');
        return back();
    }

    public function destroy(string $id)
    {
        //
        $unit = Unit::findOrFail($id);
        $unit->delete();
        notify()->success('Unit deleted successfully');
        return back();
    }
}
