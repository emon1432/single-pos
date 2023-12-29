<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BankTransaction;
use App\Models\Category;
use App\Models\Customer;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\SellingInfo;
use App\Models\SellingItem;
use App\Models\SellingPrice;
use App\Models\SellLog;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::with('unit.related_unit')->orderBy('name', 'ASC')
            ->get();
        $categories = Category::orderBy('name', 'ASC')
            ->get();
        $customers = Customer::orderBy('name', 'ASC')
            ->get();
        $payment_methods = PaymentMethod::where('status', 1)
            ->get();
        return view('backend.pages.pos.index', compact('products', 'categories', 'customers', 'payment_methods'));
    }

    public function searchProduct(Request $request)
    {
        $search_text = $request->text;
        $category_id = '';
        if ($request->category_id) {
            $category_id = $request->category_id;
        }

        $products = Product::where('name', 'LIKE', '%' . $search_text . '%')
            ->where('category_id', 'LIKE', '%' . $category_id . '%')
            ->orderBy('name', 'ASC')
            ->get();
        return view('backend.pages.pos.search-products', compact('products'));
    }

    public function checkout(Request $request)
    {
        // return response()->json($request->all());
        //get active_store last sellingInfo
        $last_invoice_id = SellingInfo::orderBy('invoice_id', 'DESC')
            ->select('invoice_id')
            ->first();

        if ($last_invoice_id == null) {
            $invoice_id = "A0000001";
        } else {
            $invoice_id = $last_invoice_id->invoice_id;
            $invoice_id++;
        }

        $sellingInfo = new SellingInfo();
        $sellingInfo->invoice_id = $invoice_id;
        $sellingInfo->customer_id = $request->customer_id;
        $sellingInfo->customer_phone = $request->customer_phone;
        $sellingInfo->note = $request->note;
        $sellingInfo->total_items = sizeof($request->product_id);
        $sellingInfo->payment_method_id = $request->payment_method_id;
        $sellingInfo->payment_status = $request->due_amount > 0 ? 'due' : 'paid';
        $sellingInfo->created_by = auth()->user()->id;
        $sellingInfo->save();

        //save to sellingItem
        $total_purchase_price = 0;
        for ($i = 0; $i < sizeof($request->product_id); $i++) {
            $sellingItem = new SellingItem();
            $sellingItem->selling_info_id = $sellingInfo->id;
            $sellingItem->invoice_id = $invoice_id;
            //get product info
            $product = Product::find($request->product_id[$i]);

            $sellingItem->category_id = $product->category_id;
            $sellingItem->brand_id = $product->brand_id;
            $sellingItem->supplier_id = $product->supplier_id;
            $sellingItem->product_id = $request->product_id[$i];
            $sellingItem->product_name = $product->name;
            $sellingItem->unit_purchase_price = $product->unit_purchase_price;
            $sellingItem->unit_sale_price = $request->unit_sale_price[$i];
            $sellingItem->unit_quantity = $request->unit_quantity[$i];
            $sellingItem->subunit_purchase_price = $product->subunit_purchase_price;
            $sellingItem->subunit_sale_price = $request->subunit_sale_price[$i];
            $sellingItem->subunit_quantity = $request->subunit_quantity[$i];
            $total_purchase_price += ($request->unit_quantity[$i] * $product->unit_purchase_price) + ($request->subunit_quantity[$i] * $product->subunit_purchase_price);
            $sellingItem->total_price = ($request->unit_quantity[$i] * $request->unit_sale_price[$i]) + ($request->subunit_quantity[$i] * $request->subunit_sale_price[$i]);
            $sellingItem->save();
        }

        //save to SellingPrice
        $sellingPrice = new SellingPrice();
        $sellingPrice->selling_info_id = $sellingInfo->id;
        $sellingPrice->invoice_id = $invoice_id;
        $sellingPrice->subtotal = $request->sub_total;
        $sellingPrice->discount_type = $request->discount_type;
        $sellingPrice->discount_amount = $request->discount_amount;
        $sellingPrice->order_tax = ($request->sub_total) * ($request->order_tax / 100);
        $sellingPrice->total_purchase_price = $total_purchase_price;
        $sellingPrice->shipping_type = $request->shipping_type;
        $sellingPrice->shipping_amount = $request->shipping_charge;
        $sellingPrice->others_charge = $request->others_charge;
        $sellingPrice->payable_amount = $request->payable_amount;
        $sellingPrice->paid_amount = $request->paid_amount;
        $sellingPrice->due_amount = $request->due_amount;
        $sellingPrice->profit = $request->sub_total - $total_purchase_price;
        $sellingPrice->save();

        //update product quantity
        for ($i = 0; $i < sizeof($request->product_id); $i++) {
            $product = Product::find($request->product_id[$i]);
            $product->unit_quantity_in_stock -= $request->unit_quantity[$i];
            $product->subunit_quantity_in_stock -= $request->subunit_quantity[$i];
            $product->save();
        }

        //create purchase log call createPurchaseLog function
        $request->sellInfo_id = $sellingInfo->id;
        $request->invoice_id = $invoice_id;
        $request->type = 'Sell';
        $this->createSellLog($request);

        notify()->success('Invoice Created Successfully');
        return redirect('/sell-details/' . $sellingInfo->id);
    }

    public function createSellLog(Request $request)
    {
        // return response()->json($request->all());

        //create sell log
        $sellLog = new SellLog();
        $sellLog->selling_info_id = $request->sellInfo_id;
        $sellLog->invoice_id = $request->invoice_id;
        $sellLog->customer_id = $request->customer_id;
        $sellLog->type = $request->type;
        $sellLog->payment_method_id = $request->payment_method_id;
        $sellLog->payment_reference = $request->payment_reference;
        $sellLog->paid_amount = $request->paid_amount;
        $sellLog->due_amount = $request->due_amount;
        $sellLog->note = $request->note;
        $sellLog->created_by = auth()->user()->id;
        $sellLog->save();


        //added paid_amount and due_amount in sellingPrice table
        $sellingPrice = SellingPrice::where('selling_info_id', $request->sellInfo_id)->first();
        if ($request->type == 'Due Paid') {
            $sellingPrice->paid_amount += $request->paid_amount;
            $sellingPrice->due_amount -= $request->paid_amount;
        } else {
            $sellingPrice->paid_amount = $request->paid_amount;
            $sellingPrice->due_amount = $request->due_amount;
        }
        $sellingPrice->save();
        //change sellingInfo status to 1 if paid amount is equal to total amount
        $sellingInfo = SellingInfo::find($request->sellInfo_id);
        if ($request->due_amount == 0) {
            $sellingInfo->status = 1;
        }
        $sellingInfo->save();


        //create bank transaction
        if ($request->paid_amount > 0) {
            //create bank transaction
            $bank_transaction = new BankTransaction();
            $bank_transaction->transaction_type = 'deposit';
            $bank_transaction->amount = $request->paid_amount;
            $bank_transaction->to_bank_account_id = '1';
            if ($request->type == 'Due Paid') {
                $bank_transaction->income_source_id = '2';
            } else {
                $bank_transaction->income_source_id = '1';
            }
            $bank_transaction->sell_info_id = $request->sellInfo_id;
            $bank_transaction->invoice_id = $request->invoice_id;
            $bank_transaction->reference_no = $request->payment_reference;

            $bank_transaction->details = $request->note;
            $bank_transaction->payment_method_id = $request->payment_method_id;
            $bank_transaction->created_by = auth()->user()->id;
            $bank_transaction->save();

            //call helper function to update bank account balance for withdraw
            bank_account_balance_update_for_deposit('1', $request->paid_amount);
        }


        if ($request->type == 'Due Paid') {
            notify()->success('Due Paid successfully');
            return redirect('/sell/log');
        }
    }
}
