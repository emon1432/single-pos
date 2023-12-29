<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BankTransaction;
use App\Models\Category;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\PurchaseLog;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        //get all purchase with supplier and user
        $purchases = Purchase::with('supplier', 'user')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        // return response()->json($purchases);
        return view('backend.pages.purchase.index', compact('purchases'));
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
        $paymentMethods = PaymentMethod::orderBy('id', 'asc')->get();

        // get last purchase no
        $purchase = Purchase::orderBy('id', 'desc')->select('purchase_no')->first();

        if ($purchase == null) {
            $purchase_no = "A0000001";
        } else {
            $purchase_no = $purchase->purchase_no;
            $purchase_no++;
        }

        return view('backend.pages.purchase.create', compact('suppliers', 'categories', 'products', 'paymentMethods', 'purchase_no'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        //store purchase data
        $purchase = new Purchase();
        $purchase->purchase_no = $request->purchase_no;
        $purchase->purchase_date = $request->purchase_date;
        $purchase->supplier_id = $request->supplier_id;
        $purchase->estimated_amount = $request->estimated_amount;
        $purchase->order_tax = $request->order_tax;
        $purchase->shipping_charge = $request->shipping_charge;
        $purchase->others_charge = $request->others_charge;
        $purchase->discount = $request->discount_amount;
        $purchase->total_amount = $request->total_amount;
        $purchase->note = $request->note;
        $purchase->created_by = auth()->user()->id;
        $purchase->save();

        //save product_id and category_id in purchase_items table where $request->product_id is array of product_id
        foreach ($request->product_id as $key => $product_id) {
            $purchase_item = new PurchaseItem();
            $purchase_item->purchase_id = $purchase->id;
            $purchase_item->purchase_no = $request->purchase_no;
            $purchase_item->product_id = $product_id;
            $purchase_item->product_name = $request->product_name[$key];
            $purchase_item->unit_id = $request->unit_id[$key];
            $purchase_item->unit_quantity = $request->unit_quantity[$key];
            $purchase_item->subunit_quantity = $request->subunit_quantity[$key];
            $purchase_item->unit_price = $request->unit_price[$key];
            $purchase_item->subunit_price = $request->subunit_price[$key];
            $purchase_item->total = $request->total_price[$key];
            $purchase_item->save();

            //update product stock and price
            $product = Product::find($product_id);
            $product->unit_purchase_price = $request->unit_price[$key];
            $product->subunit_purchase_price = $request->subunit_price[$key];
            $product->unit_quantity_in_stock = $product->unit_quantity_in_stock + $request->unit_quantity[$key];
            $product->subunit_quantity_in_stock = $product->subunit_quantity_in_stock + $request->subunit_quantity[$key];
            $product->save();
        }

        //create purchase log call createPurchaseLog function
        $request->purchase_id = $purchase->id;
        $request->type = 'Purchase';
        $this->createPurchaseLog($request);

        notify()->success('Product Purchase successfully');
        return redirect('purchase/' . $purchase->id);
    }

    public function show(string $id)
    {
        //get purchase with supplier and user by id join with purchase_items
        $purchase = Purchase::with('supplier', 'user', 'purchaseItems')->where('id', $id)->first();

        notify()->success('Product Purchase successfully');
        return redirect()->route('dashboard');

        // return view('backend.pages.purchase.show', compact('purchase'));
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

    public function purchaseLog()
    {
        //get all purchase logs with supplier and user
        $purchase_logs = PurchaseLog::with('supplier', 'user', 'payment_method')->orderBy('created_at', 'DESC')->get();
        // return response()->json($purchase_logs);

        return view('backend.pages.purchase.log', compact('purchase_logs'));
    }

    public function createPurchaseLog(Request $request)
    {
        //create purchase log
        $purchase_log = new PurchaseLog();
        $purchase_log->purchase_id = $request->purchase_id;
        $purchase_log->purchase_no = $request->purchase_no;
        $purchase_log->type = $request->type;
        $purchase_log->supplier_id = $request->supplier_id;
        $purchase_log->created_by = auth()->user()->id;
        $purchase_log->payment_method_id = $request->payment_method_id;
        $purchase_log->payment_reference = $request->payment_reference;
        $purchase_log->paid_amount = $request->paid_amount;
        $purchase_log->due_amount = $request->due_amount;
        $purchase_log->note = $request->note;
        $purchase_log->save();

        //added total_paid and total_due in purchase table
        $purchase = Purchase::find($request->purchase_id);
        if ($request->type == 'Due Paid') {
            $purchase->total_paid = $purchase->total_paid + $request->paid_amount;
            $purchase->total_due = $purchase->total_due - $request->paid_amount;
        } else {
            $purchase->total_paid = $request->paid_amount;
            $purchase->total_due = $request->due_amount;
        }
        //change purchase status to 1 if paid amount is equal to total amount
        if ($request->due_amount == 0) {
            $purchase->status = 1;
        }
        $purchase->save();

        //create bank transaction
        if ($request->paid_amount > 0) {
            //create bank transaction
            $bank_transaction = new BankTransaction();
            $bank_transaction->transaction_type = 'withdraw';
            $bank_transaction->amount = $request->paid_amount;
            $bank_transaction->to_bank_account_id = '1';
            if ($request->type == 'Due Paid') {
                $bank_transaction->expense_category_id = '2';
            } else {
                $bank_transaction->expense_category_id = '1';
            }
            $bank_transaction->purchase_id = $request->purchase_id;
            $bank_transaction->invoice_id = $request->purchase_no;

            $bank_transaction->reference_no = $request->payment_reference;

            $bank_transaction->details = $request->note;
            $bank_transaction->payment_method_id = $request->payment_method_id;
            $bank_transaction->created_by = auth()->user()->id;
            $bank_transaction->save();

            //call helper function to update bank account balance for withdraw
            bank_account_balance_update_for_withdraw('1', $request->paid_amount);
        }

        if ($request->type == 'Due Paid') {
            notify()->success('Due Paid successfully');
            //get prefix from auth user role_slug
            return redirect('purchase/log');
        }
    }

    public function purchasePay($id)
    {
        //get purchase with supplier and user by id
        $purchase = Purchase::with('supplier', 'user', 'purchaseItems', 'purchaseLogs')
            ->where('id', $id)->first();

        if ($purchase->total_due <= 0) {
            return redirect()->back();
        }
        // return response()->json($purchase);
        //get all payment methods
        $payment_methods = PaymentMethod::where('status', 1)
            ->get();
        // return response()->json($payment_methods);

        return view('backend.pages.purchase.pay', compact('purchase', 'payment_methods'));
    }
}
