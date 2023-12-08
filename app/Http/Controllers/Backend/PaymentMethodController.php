<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        // get all payment methods
        $paymentMethods = PaymentMethod::orderBy('id', 'asc')->paginate(10);
        return view('backend.pages.payment-method.index', compact('paymentMethods'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
        // return response()->json($request->all());
        $paymentMethod = new PaymentMethod();
        $paymentMethod->name = $request->name;
        $paymentMethod->slug = slugify($request->name);
        $paymentMethod->details = $request->details;
        $paymentMethod->status = 1;
        $paymentMethod->save();

        notify()->success('Payment method created successfully');
        return back();
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
        // return response()->json([$request->all(), $id]);

        $paymentMethod = PaymentMethod::find($id);
        $paymentMethod->name = $request->name;
        $paymentMethod->slug = slugify($request->name);
        $paymentMethod->details = $request->details;
        $paymentMethod->save();

        notify()->success('Payment method updated successfully');
        return back();
    }

    public function destroy(string $id)
    {
        //
        $paymentMethod = PaymentMethod::find($id);
        $paymentMethod->delete();

        notify()->success('Payment method deleted successfully');
        return back();
    }
}
