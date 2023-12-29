<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OthersController extends Controller
{
    public function statusUpdate(Request $request)
    {
        // validation
        // dd($request->all());
        $validated = $request->validate([
            'id' => 'required',
            'status' => 'required',
            'model' => 'required',
        ]);

        if ($validated) {
            $model = "\App\Models\\" . $request->model;
            $data = $model::find($request->id);
            $data->status = $request->status;
            $data->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Status updated successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ]);
        }
    }

    public function getProductBySupplier($supplier_id)
    {
        $products = Product::where('supplier_id', $supplier_id)
            ->with('unit.related_unit')
            ->where('status', 1)
            ->orderBy('name', 'asc')
            ->get();
        return response()->json($products);
    }
}
