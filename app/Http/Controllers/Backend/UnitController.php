<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units=Unit::orderBy('id','desc')->get();
        return view('backend.pages.unit.index',compact('units'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'name'=>'required',
        //     'related_unit_id'=>['nullable',function($attribute, $value, $fail)use($request) {
        //         if(!$request->related_unit_id||!$request->related_sign||!$request->related_by){
        //             return $fail("This Field has other related fields.");
        //         }
        //     }],
        //     'sign'=>['nullable',function($attribute, $value, $fail)use($request) {
        //         if(!$request->related_unit_id||!$request->sign||!$request->related_value){
        //             return $fail("This Field has other related fields.");
        //         }
        //     }],
        //     'related_value'=>['nullable',function($attribute, $value, $fail)use($request) {
        //         if(!$request->related_unit_id||!$request->related_sign||!$request->related_value){
        //             return $fail("This Field has other related fields.");
        //         }
        //     }]
        // ]);

        $unit= new Unit();
        $unit->name=$request->name;
        $unit->related_unit_id=$request->related_unit_id;
        $unit->related_sign=$request->related_sign;
        $unit->related_value=$request->related_value;
        $unit->save();
        if($unit){
            notify()->success('Unit added successfully');
            return back();
        }else{
            notify()->error('Unit could not be added');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
