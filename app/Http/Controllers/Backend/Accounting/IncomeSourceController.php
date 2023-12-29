<?php

namespace App\Http\Controllers\Backend\Accounting;

use App\Http\Controllers\Controller;
use App\Models\IncomeSource;
use Illuminate\Http\Request;

class IncomeSourceController extends Controller
{
    public function index()
    {
        $incomeSources = IncomeSource::with('user')->get();
        return view('backend.pages.accounting.income_sources.index', compact('incomeSources'));
    }

    public function create()
    {
        return view('backend.pages.accounting.income_sources.create');
    }

    public function store(Request $request)
    {
        $incomeSource = new IncomeSource();
        $incomeSource->name = $request->name;
        //create slug from name field by using slugify function from Helper.php
        $incomeSource->slug = slugify($request->name);
        $incomeSource->details = $request->details;
        $incomeSource->status = $request->status;
        $incomeSource->created_by = auth()->user()->id;
        $incomeSource->save();

        notify()->success('Income Source Created Successfully');
        return redirect('income-sources');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $incomeSource = IncomeSource::findOrFail($id);
        if ($incomeSource->is_default == true) {
            notify()->error('Default Income Source Can Not Be Edited');
            return redirect('income-sources');
        }
        return view('backend.pages.accounting.income_sources.edit', compact('incomeSource'));
    }

    public function update(Request $request, string $id)
    {
        $incomeSource = IncomeSource::findOrFail($id);
        $incomeSource->name = $request->name;
        //create slug from name field by using slugify function from Helper.php
        $incomeSource->slug = slugify($request->name);
        $incomeSource->details = $request->details;
        $incomeSource->status = $request->status;
        $incomeSource->save();

        notify()->success('Income Source Updated Successfully');
        return redirect('income-sources');
    }

    public function destroy(string $id)
    {
        $incomeSource = IncomeSource::findOrFail($id);
        if ($incomeSource->is_default == true) {
            notify()->error('Default Income Source Can Not Be Deleted');
            return redirect('income-sources');
        }
        $incomeSource->delete();
        notify()->success('Income Source Deleted Successfully');
        return redirect('income-sources');
    }
}
