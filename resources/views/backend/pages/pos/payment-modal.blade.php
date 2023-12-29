<div class="modal fade modal-fullscreen" id="payment_modal" tabindex="-1" aria-labelledby="paymentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment > <span id="customer_name"></span>
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('pos/checkout') }}" method="post" id="payment_form">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="customer_id" value="">
                        {{-- payment method --}}
                        <div class="col-md-3">
                            <div class="payment_method">
                                <div class="payment_method_header">
                                    <h4>Payment Method</h4>
                                </div>
                                <div class="payment_method_body">
                                    @foreach ($payment_methods as $payment_method)
                                        <div class="mt-2 fw-bold">
                                            <input type="radio" name="payment_method"
                                                data-id="{{ $payment_method->id }}" value="{{ $payment_method->slug }}"
                                                id="{{ $payment_method->slug }}"
                                                {{ $payment_method->slug == 'cash' ? 'checked' : '' }}>
                                            <label
                                                for="{{ $payment_method->slug }}">{{ $payment_method->name }}</label><br>
                                        </div>
                                    @endforeach
                                    <input type="hidden" name="payment_method_id" value="1">
                                </div>
                            </div>
                        </div>
                        {{-- payment option --}}
                        <div class="col-md-4">
                            <h4 class="text-center">Payment Option</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <a class="btn btn-primary full_pay_btn text-white">
                                        <i class="fa-solid fa-circle-plus"></i>
                                        Full Payment</a>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-danger full_due_btn text-white">
                                        <i class="fa-solid fa-circle-minus"></i>
                                        Full Due</a>
                                </div>
                            </div>

                            <div class="input-group input-group-lg mt-3">
                                <span class="input-group-text">Pay Amount</span>
                                <input type="number" class="form-control pay_amount"
                                    aria-describedby="inputGroup-sizing-lg" name="pay_amount" min="0" required
                                    value="0.00">
                            </div>
                            <div class="input-group input-group-md mt-3 payment_reference d-none">
                                <span class="input-group-text">Payment Refrence</span>
                                <input type="text" class="form-control" name="payment_reference">
                            </div>
                            <div class="input-group input-group-md mt-3">
                                <span class="input-group-text">Customer Phone</span>
                                <input type="text" class="form-control" name="customer_phone" required
                                    value="">
                            </div>
                            <div class="input-group input-group-md mt-3">
                                <span class="input-group-text">Note</span>
                                <input type="text" class="form-control" name="note">
                            </div>
                        </div>
                        <div class="col-md-5">
                            {{-- order details --}}
                            <h4 class="text-center">Order Details</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody id="order_list">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-end w-60" colspan="2">
                                                Subtotal </th>
                                            <input type="hidden" name="sub_total" value=""
                                                autocomplete="off">
                                            <td class="text-end w-40 sub_total"></td>
                                        </tr>
                                        <tr>
                                            <th class="text-end w-60" colspan="2">
                                                Order Tax </th>
                                            <input type="hidden" name="order_tax" value="0"
                                                autocomplete="off">
                                            <td class="text-end w-40 order_tax">0.00</td>
                                        </tr>
                                        <tr>
                                            <th class="text-end w-60" colspan="2">
                                                Discount
                                            </th>
                                            <input type="hidden" name="discount_type" value="plain"
                                                autocomplete="off">
                                            <input type="hidden" name="discount_amount" value="0"
                                                autocomplete="off">
                                            <td class="text-end w-40 discount_amount">0.00</td>
                                        </tr>
                                        <tr>
                                            <th class="text-end w-60" colspan="2">
                                                Shipping Charge
                                            </th>
                                            <input type="hidden" name="shipping_type" value="plain"
                                                autocomplete="off">
                                            <input type="hidden" name="shipping_charge" value="0"
                                                autocomplete="off">
                                            <td class="text-end w-40 shipping_charge">0.00</td>
                                        </tr>
                                        <tr>
                                            <th class="text-end w-60" colspan="2">
                                                Other Charge </th>
                                            <input type="hidden" name="others_charge" value="0"
                                                autocomplete="off">
                                            <td class="text-end w-40 others_charge">0.00</td>
                                        </tr>
                                        <tr class="interest_amount d-none">
                                            <th class="text-end w-60" colspan="2">
                                                Interest Amount </th>
                                            <td class="text-end w-40">0.00</td>
                                        </tr>
                                        <tr>
                                            <th class="text-end w-60" colspan="2">
                                                Payable Amount <small>(<span class="total_item"></span> items)</small>
                                            </th>
                                            <input type="hidden" name="payable_amount" value=""
                                                autocomplete="off">
                                            <td class="text-end w-40 payable_amount">0.00</td>
                                        </tr>
                                        <tr>
                                            <th class="text-end w-60" colspan="2">
                                                Paid Amount </th>
                                            <input type="hidden" name="paid_amount" value="0.00"
                                                autocomplete="off">
                                            <td class="text-end w-40 paid_amount">0.00</td>
                                        </tr>
                                        <tr>
                                            <th class="text-end w-60" colspan="2">
                                                Due Amount </th>
                                            <input type="hidden" name="due_amount" value=""
                                                autocomplete="off">
                                            <td class="text-end w-40 due_amount">0.00</td>
                                        </tr>
                                        <tr>
                                            <th class="text-end w-60" colspan="2">
                                                Balance </th>
                                            <input type="hidden" name="balance" value="0.00" autocomplete="off">
                                            <td class="text-end w-40 balance">0.00</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="checkout">Checkout</button>
            </div>
        </div>
    </div>
</div>
