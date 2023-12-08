<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        // get all purchase with supplier and user
        $purchases = Purchase::with('supplier', 'user')->orderBy('id', 'desc')->get();
        return response()->json([
            'purchases' => $purchases
        ]);
    }

    public function create()
    {
        // get all supplier
        $suppliers = Supplier::orderBy('name', 'asc')->get();

        // get all categories
        $categories = Category::orderBy('name', 'asc')->get();

        // get all products
        $products = Product::orderBy('name', 'asc')->get();

        // get all payment methods
        $paymentMethods = PaymentMethod::orderBy('name', 'asc')->get();

        // get last purchase no
        $purchase = Purchase::orderBy('id', 'desc')->select('purchase_no')->first();

        if ($purchase) {
            $purchase_no = $purchase->purchase_no + 1;
        } else {
            $purchase_no = "A0000001";
        }

        // return response()->json([
        //     'suppliers' => $suppliers,
        //     'categories' => $categories,
        //     'products' => $products,
        //     'paymentMethods' => $paymentMethods,
        //     'purchase_no' => $purchase_no
        // ]);

        return view('backend.pages.purchase.create', compact('suppliers', 'categories', 'products', 'paymentMethods', 'purchase_no'));
    }

    public function store(Request $request)
    {
        //
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
    }

    public function destroy(string $id)
    {
        //
    }
}
