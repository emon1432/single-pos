<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->paginate(10);
        return view('backend.pages.category.index', compact('categories'));
    }

 
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        notify()->success('Category created successfully');
        return back();
    }

    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        notify()->success('Category updated successfully');
        return back();
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        notify()->success('Category deleted successfully');
        return back();
    }
}
