<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id', 'desc')->paginate(10);
        return view('backend.pages.brand.index', compact('brands'));
    }

    public function store(Request $request)
    {
        $brand = new Brand();
        $brand->name = $request->name;
        //slug
        $brand->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $brand->save();
        notify()->success('Brand created successfully');
        return back();
    }

    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);
        $brand->name = $request->name;
        //slug
        $brand->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $brand->save();
        notify()->success('Brand updated successfully');
        return back();
    }

    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        notify()->success('Brand deleted successfully');
        return back();
    }

}
