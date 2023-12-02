<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers=Supplier::orderBy('id','desc')->paginate(20);
        return view('backend.pages.supplier.index',compact('suppliers'));
    }

    public function store(Request $request)
    {
        $supplier=Supplier::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'payable'=>$request->payable,
            'receivable'=>$request->receivable,
        ]);

        notify()->success('Customer created successfully');
        return back();
    }

    public function update(Request $request, string $id)
    {
        $supplier=Supplier::find($id);
        $supplier->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'payable'=>$request->payable,
            'receivable'=>$request->receivable,
        ]);

        notify()->success('Customer updated successfully');
        return back();
    }

    public function destroy(string $id)
    {
        $supplier=Supplier::find($id);
        $supplier->delete();

        notify()->success('Customer deleted successfully');
        return back();
    }
}
