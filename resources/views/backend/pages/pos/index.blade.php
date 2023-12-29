@extends('backend.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/css/pos.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .modal.modal-fullscreen .modal-dialog {
            width: 100vw;
            height: 100vh;
            margin: 0;
            padding: 0;
            max-width: none;
        }

        .modal.modal-fullscreen .modal-content {
            height: auto;
            height: 100vh;
            border-radius: 0;
            border: none;
        }

        .modal.modal-fullscreen .modal-body {
            overflow-y: auto;
        }
    </style>
@endpush
@section('pos')
    <div class="main_container">
        <header class="header bg-dark header_section">
            <div class="header_left">
                <a class="custom_active" href="{{ url('dashboard') }}">
                    {{-- back icon --}}
                    <i class="fa fa-arrow-left"></i>
                    Dashboard</a>
                <span id="time" style="color: #F39C12"></span>
            </div>
            <div class="header_right">
                <ul>
                    <li>
                        <a href="{{ url('pos') }}" class="text-white">
                            {{-- pos icon --}}
                            <i class="fa fa-shopping-cart"></i>
                            pos
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('sell-list') }}" class="text-white">
                            <i class="fa fa-list"></i>
                            Invoice
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-white">
                            <i class="fa fa-bell"></i>

                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-white">
                            <i class="fa fa-envelope"></i>

                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-white">
                            <i class="fa fa-cog"></i>

                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            class="text-white">
                            <i class='fa fa-power-off'></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>

            </div>
        </header>
        <div class="product">
            <div class="product_search">
                <span>
                    <i class="fa fa-search"></i>
                    <input type="text" name="product_search" id="product_search"
                        placeholder="Search Product or Scan Barcode">
                </span>
            </div>
            <div class="product_list" id="product_search_result">
                @foreach ($products as $product)
                    <div class="card">
                        <div class="card-body">
                            <a href="javascript:void(0)" id="product_add_to_cart">
                                <div class="product_list_item">
                                    <img src="{{ asset('backend/images/product/' . $product->image) }}"
                                        alt="{{ $product->name }}">
                                    <h6>{{ $product->name }}</h6>
                                    <div>
                                        <span class="btn btn-sm btn-dark">{{ $product->unit_sale_price }}</span>
                                    </div>
                                </div>
                                <form id="product_add_to_cart_form">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                                    <input type="hidden" name="product_unit_sale_price"
                                        value="{{ $product->unit_sale_price }}">
                                    @if ($product->unit->related_unit)
                                        <input type="hidden" name="product_subunit_sale_price"
                                            value="{{ $product->subunit_sale_price }}">
                                    @endif
                                </form>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="product_item">
            <div>
                <div class="user_product_item">
                    {{-- data list --}}
                    <div class="user_list">
                        <i class="fa fa-user"></i>
                        {{-- <input type="text" name="product_search" id="product_search" list="data_list"> --}}

                        <select class="js-example-basic-single" name="customer_id" id="customer_id">
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $customer->id == 1 ? 'selected' : '' }}
                                    data-due="{{ $customer->receivable }}" data-balance="{{ $customer->balance }}"
                                    data-phone="{{ $customer->phone }}">
                                    {{ $customer->name }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="due">
                        <span>DUE</span>
                        <span id="customer_due">0.00</span>
                    </div>

                    <div class="add_user">
                        <i class="fa fa-plus"></i>
                    </div>


                </div>

                <div class="product_item_list_header">
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                <th colspan="2">Product</th>
                                <th>Unit Price</th>
                                <th>Unit</th>
                                <th>Subunit Price</th>
                                <th>Subunit</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="cart_list">
                            {{-- product will append here --}}

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="product_item_list_footer">
                <table class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>Total Item <span class="total_item"> 0 </span> = <span id="total_product"> 0(Unit) +
                                    0(Subunit) </span></th>
                            <th>Total : <span id="sub_total">0.00</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form id="others_cost" action="">
                            <tr>
                                <td>
                                    <span class="text-start">Discount</span>
                                    <input class="px-3 text-center rounded-3 bg-dark text-light" type="number"
                                        min="0" value="0" name="discount">
                                </td>
                                <td class="text-end">
                                    <span>Tax Amount (%)</span>
                                    <input class="px-3 text-center rounded-3 bg-dark text-light" type="number"
                                        min="0" value="0" name="tax">
                                </td>
                            </tr>
                            <tr>
                                <td class="w-80">
                                    <span>Shipping Charge</span>
                                    <input class="px-3 text-center rounded-3 bg-dark text-light" type="number"
                                        min="0" value="0" name="shipping">
                                </td>
                                <td class="text-end">
                                    <span>Other Charge</span>
                                    <input class="px-3 text-center rounded-3 bg-dark text-light" type="number"
                                        min="0" value="0" name="other">
                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>

            </div>
        </div>
        <footer class="footer">
            <div class="footer_left">
                <h1 class="text-center" id="grand_total">0.00</h1>
            </div>
            <div class="footer_right">
                {{-- modal --}}
                <button id="payment_modal_btn">
                    pay now
                </button>
                <button>reset</button>
            </div>
        </footer>
        {{-- button toggle icon product_item show and hide --}}
        <div class="product_item_toggle">
            <i class="fa fa-shopping-cart"></i>
        </div>
    </div>

    <!-- Payment Modal -->
    @include('backend.pages.pos.payment-modal')
@endsection
@push('js')
    <script src="{{ asset('backend/js/pos.js') }}"></script>
@endpush
