<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function index()
    {
        $bank_accounts = BankAccount::all();
        return view('backend.pages.accounting.bank_account.index', compact('bank_accounts'));
    }

    public function create()
    {
        return view('backend.pages.accounting.bank_account.create');
    }

    public function store(Request $request)
    {
        $bank_account = new BankAccount();
        $bank_account->name = $request->name;
        $bank_account->slug = slugify($request->name);
        $bank_account->account_number = $request->account_number;
        $bank_account->bank_name = $request->bank_name;
        $bank_account->branch_name = $request->branch_name;
        $bank_account->branch_address = $request->branch_address;
        $bank_account->details = $request->details;
        $bank_account->contact_person = $request->contact_person;
        $bank_account->contact_number = $request->contact_number;
        $bank_account->email = $request->email;
        $bank_account->url = $request->url;
        $bank_account->created_by = auth()->user()->id;
        $bank_account->save();

        notify()->success('Bank Account created successfully');
        return redirect('bank-accounts');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $bank_account = BankAccount::findOrFail($id);
        return view('backend.pages.accounting.bank_account.edit', compact('bank_account'));
    }

    public function update(Request $request, string $id)
    {
        $bank_account = BankAccount::findOrFail($id);
        $bank_account->name = $request->name;
        $bank_account->slug = slugify($request->name);
        $bank_account->account_number = $request->account_number;
        $bank_account->bank_name = $request->bank_name;
        $bank_account->branch_name = $request->branch_name;
        $bank_account->branch_address = $request->branch_address;
        $bank_account->details = $request->details;
        $bank_account->contact_person = $request->contact_person;
        $bank_account->contact_number = $request->contact_number;
        $bank_account->email = $request->email;
        $bank_account->url = $request->url;
        $bank_account->save();

        notify()->success('Bank Account updated successfully');
        return redirect('bank-accounts');
    }

    public function destroy(string $id)
    {
        //
    }
}
