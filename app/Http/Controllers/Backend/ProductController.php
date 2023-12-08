<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('backend.pages.product.index', compact('products'));
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $units = Unit::all();
        $suppliers = Supplier::all();
        return view('backend.pages.product.create', compact('brands', 'categories', 'units', 'suppliers'));
    }

    public function store(Request $request)
    {
        //
        // return response()->json($request->all());
        $product = new Product();
        $product->name = $request->name;
        $product->slug = slugify($request->name);
        $product->sku = $request->sku;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->unit_id = $request->unit_id;
        $product->supplier_id = $request->supplier_id;
        $product->selling_price = $request->selling_price;
        $product->alert_quantity = $request->alert_quantity;
        $product->description = $request->description;
        $product->save();

        notify()->success('Product created successfully!');
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
    }

    public function destroy(string $id)
    {
        //
    }
}
