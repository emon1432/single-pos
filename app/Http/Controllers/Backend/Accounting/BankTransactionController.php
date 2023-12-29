<?php

namespace App\Http\Controllers\Backend\Accounting;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\BankTransaction;
use App\Models\ExpenseCategory;
use App\Models\IncomeSource;
use Illuminate\Http\Request;

class BankTransactionController extends Controller
{
    public function transactionHistory()
    {
        $bank_transactions = BankTransaction::with('from_bank_account', 'to_bank_account', 'user')
            ->where('transaction_type', '!=', 'transfer')
            ->get();
        return view('backend.pages.accounting.bank_transaction.transaction_list', compact('bank_transactions'));
    }

    public function deposit()
    {
        //all active bank accounts
        $bank_accounts = BankAccount::where('status', 1)
            ->get();
        //all active income sources
        $income_sources = IncomeSource::where('status', 1)->get();
        return view('backend.pages.accounting.bank_transaction.deposit', compact('bank_accounts', 'income_sources'));
    }

    //deposit store
    public function depositStore(Request $request)
    {
        // return response()->json($request->all());
        //store to database bank_transactions table
        $bank_transaction = new BankTransaction();
        $bank_transaction->transaction_type = 'deposit';
        $bank_transaction->amount = $request->deposit_amount;
        $bank_transaction->to_bank_account_id = $request->to_account;
        $bank_transaction->income_source_id = $request->income_source_id;
        $bank_transaction->reference_no = $request->reference_no;
        $bank_transaction->details = $request->details;
        $bank_transaction->status = 1;
        $bank_transaction->created_by = auth()->user()->id;
        $bank_transaction->save();

        //call helper function for bank account balance update
        bank_account_balance_update_for_deposit($request->to_account, $request->deposit_amount);


        notify()->success('Deposit successfully created.');
        return redirect('transaction-history');
    }

    //withdraw
    public function withdraw()
    {
        //all active bank accounts
        $bank_accounts = BankAccount::where('status', 1)
            ->get();

        //all active expense categories
        $expense_categories = ExpenseCategory::where('status', 1)->get();
        return view('backend.pages.accounting.bank_transaction.withdraw', compact('bank_accounts', 'expense_categories'));
    }

    //withdraw store
    public function withdrawStore(Request $request)
    {
        $bank_transaction = new BankTransaction();
        $bank_transaction->transaction_type = 'withdraw';
        $bank_transaction->amount = $request->withdraw_amount;
        $bank_transaction->to_bank_account_id = $request->from_account;
        $bank_transaction->expense_category_id = $request->expense_category_id;
        $bank_transaction->reference_no = $request->reference_no;
        $bank_transaction->details = $request->details;
        $bank_transaction->status = 1;
        $bank_transaction->created_by = auth()->user()->id;
        $bank_transaction->save();

        //call helper function for bank account balance update
        bank_account_balance_update_for_withdraw($request->from_account, $request->withdraw_amount);

        notify()->success('Withdraw successfully created.');
        return redirect('transaction-history');
    }

    //bank transfer list
    public function bankTransferList()
    {
        //with bank account
        $bank_transfers = BankTransaction::with('from_bank_account', 'to_bank_account', 'user')
            ->where('transaction_type', 'transfer')
            ->get();
        // return response()->json($bank_transfers);

        return view('backend.pages.accounting.bank_transfer.index', compact('bank_transfers'));
    }

    //bank transfer
    public function bankTransfer()
    {
        $bank_accounts = BankAccount::where('status', 1)
            ->get();

        // return response()->json($bank_accounts);

        return view('backend.pages.accounting.bank_transfer.create', compact('bank_accounts'));
    }

    //bank transfer store
    public function bankTransferStore(Request $request)
    {
        //
        // return response()->json($request->all());

        //store to database bank_transactions table
        $bank_transaction = new BankTransaction();
        $bank_transaction->transaction_type = 'transfer';
        $bank_transaction->amount = $request->transfer_amount;
        $bank_transaction->to_bank_account_id = $request->to_account;
        $bank_transaction->from_bank_account_id = $request->from_account;
        $bank_transaction->reference_no = $request->reference_no;
        $bank_transaction->title = $request->title;
        $bank_transaction->details = $request->details;
        $bank_transaction->status = 1;
        $bank_transaction->created_by = auth()->user()->id;
        $bank_transaction->save();

        //call helper function for bank account balance update
        bank_account_balance_update_for_transfer($request->from_account, $request->to_account, $request->transfer_amount);


        notify()->success('Bank Transfer Created Successfully');
        return redirect('bank-transfer-list');
    }
}
