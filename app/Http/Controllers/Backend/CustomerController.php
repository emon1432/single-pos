<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers=Customer::orderBy('id','asc')->paginate(10);
        return view('backend.pages.customer.index',compact('customers'));
    }

    public function store(Request $request)
    {
        $customer=Customer::create([
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
        $customer=Customer::find($id);
        $customer->update([
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer=Customer::find($id);
        $customer->delete();
        notify()->success('Customer deleted successfully');
        return back();
    }
}
