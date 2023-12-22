<?php

namespace App\Http\Controllers\Backend\Accounting;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $expenseCategories = ExpenseCategory::with('user')->get();
        return view('backend.pages.accounting.expense_categories.index', compact('expenseCategories'));
    }

    public function create()
    {
        return view('backend.pages.accounting.expense_categories.create');
    }

    public function store(Request $request)
    {
        $expenseCategory = new ExpenseCategory();
        $expenseCategory->name = $request->name;
        //create slug from name field by using slugify function from Helper.php
        $expenseCategory->slug = slugify($request->name);
        $expenseCategory->details = $request->details;
        $expenseCategory->status = $request->status;
        $expenseCategory->created_by = auth()->user()->id;
        $expenseCategory->save();

        notify()->success('Expense Category Created Successfully');
        return redirect('expense-categories');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        if ($expenseCategory->is_default == true) {
            notify()->error('Default Expense Category Can Not Be Edited');
            return redirect('expense-categories');
        }
        return view('backend.pages.accounting.expense_categories.edit', compact('expenseCategory'));
    }

    public function update(Request $request, string $id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expenseCategory->name = $request->name;
        //create slug from name field by using slugify function from Helper.php
        $expenseCategory->slug = slugify($request->name);
        $expenseCategory->details = $request->details;
        $expenseCategory->status = $request->status;
        $expenseCategory->save();

        notify()->success('Expense Category Updated Successfully');
        return redirect('expense-categories');
    }

    public function destroy(string $id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        if ($expenseCategory->is_default == true) {
            notify()->error('Default Expense Category Can Not Be Deleted');
            return redirect('expense-categories');
        }
        $expenseCategory->delete();
        notify()->success('Expense Category Deleted Successfully');
        return redirect('expense-categories');
    }
}
