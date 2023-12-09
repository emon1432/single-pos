@extends('backend.layouts.master')
@section('section-title', 'Purchase')
@section('page-title', 'Create')
@section('action-button')
    <a href="{{ route('purchase.index') }}" class="btn btn-primary-rgba">
        <i class="mr-2 feather icon-list"></i>
        Purchase List
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h4 class="card-title font-weight-bold">New Product Purchase</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate id="purchaseForm" action="{{ url('/purchase') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            {{-- Purchase Date --}}
                            <div class="mb-3 col-md-4">
                                <label for="validationCustom01" class="form-label font-weight-bold">
                                    Purchase Date
                                </label>
                                <input type="date" class="form-control" id="validationCustom01"
                                    value="{{ date('Y-m-d') }}" name="purchase_date" required>
                            </div>
                            {{-- Purchase No --}}
                            <div class="mb-3 col-md-4">
                                <label for="validationCustom02" class="form-label font-weight-bold">
                                    Purchase No</label>
                                <input type="text" class="form-control" id="validationCustom02"
                                    value="{{ $purchase_no }}" name="purchase_no" required readonly>
                            </div>
                            {{-- Note --}}
                            <div class="mb-3 col-md-4">
                                <label for="validationCustom03" class="form-label font-weight-bold">
                                    Note</label>
                                <input type="text" class="form-control" id="validationCustom03" placeholder="Enter Note"
                                    name="note">
                            </div>
                        </div>
                        <hr class="my-5">
                        <div class="form-row">
                            {{-- Supplier --}}
                            <div class="mb-3 col-md-6">
                                <label for="validationCustom04" class="form-label font-weight-bold">
                                    Supplier</label>
                                <select class="form-control" id="validationCustom04" name="supplier_id" required>
                                    <option selected disabled value="">Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Product --}}
                            <div class="mb-3 col-md-6">
                                <label for="validationCustom05" class="form-label font-weight-bold">
                                    Product</label>
                                <select class="form-control" id="validationCustom05" name="product_id" required>
                                    <option selected disabled value="">Select Product</option>
                                </select>
                            </div>
                            {{-- Add Button --}}
                            <div class="mt-5 text-center col-md-12">
                                <button type="submit" class="btn btn-primary-rgba addRow">
                                    <i class="mr-2 feather icon-plus"></i>
                                    Add Product
                                </button>
                            </div>
                        </div>
                        <hr class="my-5">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="purchaseTable">
                                    <thead>
                                        <tr>
                                            <th width="20%">Product Name</th>
                                            <th width="10%">Current Unit Stock</th>
                                            <th width="10%">Current Subunit Stock</th>
                                            <th width="10%">Unit Quantity</th>
                                            <th width="10%">Subunit Quantity</th>
                                            <th width="10%">Unit Price</th>
                                            <th width="10%">Subunit Price</th>
                                            <th width="10%">Total Price</th>
                                            <th width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot style="display: none;">
                                        <tr class="bg-light-primary">
                                            <td colspan="7" class="text-right fw-bold text-end">Sub Total</td>
                                            <td colspan="2">
                                                <input type="number" step="any" name="estimated_amount" value="0"
                                                    class="form-control" readonly>
                                            </td>
                                        </tr>
                                        {{-- Order tax --}}
                                        <tr class="bg-light-primary">
                                            <td colspan="7" class="text-right fw-bold text-end">Order Tax(%)</td>
                                            <td colspan="2">
                                                <input type="number" step="any" name="order_tax" value="0"
                                                    min="0" class="form-control">
                                            </td>
                                        </tr>
                                        {{-- Shipping Charge --}}
                                        <tr class="bg-light-primary">
                                            <td colspan="7" class="text-right fw-bold text-end">Shipping Charge
                                            </td>
                                            <td colspan="2">
                                                <input type="number" step="any" name="shipping_charge" min="0"
                                                    value="0" class="form-control">
                                            </td>
                                        </tr>
                                        {{-- Others Charge --}}
                                        <tr class="bg-light-primary">
                                            <td colspan="7" class="text-right fw-bold text-end">Others Charge</td>
                                            <td colspan="2">
                                                <input type="number" step="any" name="others_charge" min="0"
                                                    value="0" class="form-control">
                                            </td>
                                        </tr>
                                        {{-- Discount --}}
                                        <tr class="bg-light-primary">
                                            <td colspan="7" class="text-right fw-bold text-end">Discount</td>
                                            <td colspan="2">
                                                <input type="number" step="any" name="discount_amount"
                                                    min="0" value="0" class="form-control discount_amount"
                                                    required>
                                            </td>
                                        </tr>
                                        {{-- Total Amount --}}
                                        <tr class="bg-warning">
                                            <td colspan="7" class="text-right fw-bold text-end ">Payable
                                                Amount</td>
                                            <td colspan="2">
                                                <input type="number" step="any" name="total_amount" min="0"
                                                    value="0" class="form-control total_amount" readonly>
                                            </td>
                                        </tr>
                                        {{-- Payment Method --}}
                                        <tr class="bg-primary">
                                            <td colspan="7" class="text-right fw-bold text-end text-light">Payment
                                                Method</td>
                                            <td colspan="2">
                                                <select class="form-control" name="payment_method_id" required>
                                                    @foreach ($paymentMethods as $payment_method)
                                                        <option value="{{ $payment_method->id }}">
                                                            {{ $payment_method->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        {{-- Payment Reference --}}
                                        <tr class="bg-primary payment_reference" style="display: none;">
                                            <td colspan="7" class="text-right fw-bold text-end text-light">Payment
                                                Reference</td>
                                            <td colspan="2">
                                                <input type="text" name="payment_reference" class="form-control">
                                            </td>
                                        </tr>
                                        {{-- Paid Amount --}}
                                        <tr class="bg-primary">
                                            <td colspan="7" class="text-right fw-bold text-end text-light">Paid
                                                Amount</td>
                                            <td colspan="2">
                                                <input type="number" step="any" name="paid_amount" min="0"
                                                    value="0" class="form-control paid_amount" required>
                                            </td>
                                        </tr>
                                        {{-- Due Amount in --}}
                                        <tr class="bg-light-danger due_amount">
                                            <td colspan="7" class="text-right fw-bold text-end">Due
                                                Amount</td>
                                            <td colspan="2">
                                                <input type="number" step="any" name="due_amount" min="0"
                                                    value="0" class="form-control due_amount" readonly>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                {{-- Submit & Reset Button --}}
                                <div class="row submitAndReset" style="display: none;">
                                    <div class="text-center col-md-12">
                                        <button class="btn btn-primary col-sm-6 submit_button">Submit</button>
                                        <button type="reset" class="btn btn-danger col-sm-4 reset_button">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('backend') }}/js/purchase.js"></script>
@endpush
