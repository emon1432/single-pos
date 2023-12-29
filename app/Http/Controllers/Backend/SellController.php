<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\SellingInfo;
use App\Models\SellLog;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function index()
    {
        $sellInfos = SellingInfo::join('customers', 'selling_infos.customer_id', '=', 'customers.id')
            ->join('selling_prices', 'selling_infos.id', '=', 'selling_prices.selling_info_id')
            ->select('selling_infos.*', 'customers.name as customer_name', 'customers.phone', 'selling_prices.payable_amount as total_amount', 'selling_prices.paid_amount', 'selling_prices.due_amount')
            ->get();
        // return response()->json($sellInfos);
        return view('backend.pages.sell.index', compact('sellInfos'));
    }

    public function sellDetails($id)
    {
        $sellInfo = SellingInfo::with('sellingItems', 'sellingItems.category', 'sellingPrice', 'customer', 'createdBy',)
            ->where('id', $id)
            ->first();
        return response()->json($sellInfo);
        return view('backend.pages.sell.show', compact('sellInfo'));
    }

    public function sellDuePay($id)
    {
        $sellInfo = SellingInfo::with('sellingItems', 'sellingItems.category', 'sellingPrice', 'customer', 'createdBy')
            ->where('id', $id)
            ->first();

        if ($sellInfo->sellingPrice->due_amount <= 0) {
            return redirect()->back();
        }

        $paymentMethods = PaymentMethod::where('status', 1)
            ->get();

        // return response()->json($sellInfo);

        return view('backend.pages.sell.due-pay', compact('sellInfo', 'paymentMethods'));
    }

    public function sellLog()
    {
        $sellLogs = SellLog::with('sellingInfo')
            ->join('payment_methods', 'sell_logs.payment_method_id', '=', 'payment_methods.id')
            ->join('customers', 'sell_logs.customer_id', '=', 'customers.id')
            ->join('users', 'users.id', 'sell_logs.created_by')
            ->select('sell_logs.*', 'payment_methods.name as payment_method_name', 'users.name as created_by_name', 'customers.name as customer_name')
            ->get();
        return response()->json($sellLogs);
        return view('backend.pages.sell.log', compact('sellLogs'));
    }
}
