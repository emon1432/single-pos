<div class="leftbar">
    <div class="sidebar">
        <div class="logobar">
            {{-- <a href="index.html" class="logo logo-large"><img src="{{ asset('backend') }}/images/logo.svg" class="img-fluid"
                    alt="logo"></a> --}}
            <h3 class="text-white logo logo-large">Latest POS</h3>
            {{-- <a href="index.html" class="logo logo-small"><img src="{{ asset('backend') }}/images/small_logo.svg"
                    class="img-fluid" alt="logo"></a> --}}
            <h5 class="logo logo-small">LP</h5>
        </div>

        <div class="navigationbar">
            <ul class="vertical-menu">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('backend') }}/images/svg-icon/dashboard.svg" class="img-fluid" alt="dashboard">
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pos.index') }}">
                        <img src="{{ asset('backend') }}/images/svg-icon/dashboard.svg" class="img-fluid"
                            alt="pos">
                        <span>POS</span>
                    </a>
                </li>
                @if (main_menu_permission('sell'))
                    <li>
                        <a href="javaScript:void();">
                            <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                                alt="basic">
                            <span>Sell</span>
                            <i class="feather icon-chevron-right pull-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            @if (check_permission('sell.list'))
                                <li>
                                    <a href="{{ url('sell-list') }}">
                                        Sell List
                                    </a>
                                </li>
                            @endif
                            @if (check_permission('sell.log-list'))
                                <li>
                                    <a href="{{ url('sell/log') }}">
                                        Sell Log
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (main_menu_permission('accounting') ||
                        main_menu_permission('bank-accounts') ||
                        main_menu_permission('income-sources') ||
                        main_menu_permission('expense-categories'))
                    <li>
                        <a href="javaScript:void();">
                            <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                                alt="basic">
                            <span>Accounting</span>
                            <i class="feather icon-chevron-right pull-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            @if (check_permission('accounting.deposit'))
                                <li>
                                    <a href="{{ url('deposit') }}">
                                        Deposit
                                    </a>
                                </li>
                            @endif
                            @if (check_permission('accounting.withdraw'))
                                <li>
                                    <a href="{{ url('withdraw') }}">
                                        Withdraw
                                    </a>
                                </li>
                            @endif
                            @if (check_permission('accounting.transaction-history'))
                                <li>
                                    <a href="{{ url('transaction-history') }}">
                                        Transaction History </a>
                                </li>
                            @endif
                            @if (check_permission('bank-accounts.create'))
                                <li>
                                    <a href="{{ url('bank-accounts/create') }}">
                                        Add Bank Account
                                    </a>
                                </li>
                            @endif
                            @if (check_permission('bank-accounts.index'))
                                <li>
                                    <a href="{{ url('bank-accounts') }}">
                                        Bank Account List
                                    </a>
                                </li>
                            @endif
                            @if (check_permission('accounting.bank-transfer-create'))
                                <li>
                                    <a href="{{ url('bank-transfer') }}">
                                        Add Transfer </a>
                                </li>
                            @endif
                            @if (check_permission('accounting.bank-transfers-list'))
                                <li>
                                    <a href="{{ url('bank-transfer-list') }}">
                                        Transfer
                                        List </a>
                                </li>
                            @endif
                            @if (check_permission('accounting.balance-sheet'))
                                <li>
                                    <a href="{{ url('balance-sheet') }}">
                                        Balance
                                        Sheet
                                    </a>
                                </li>
                            @endif
                            @if (check_permission('income-sources.index'))
                                <li>
                                    <a href="{{ url('income-sources') }}">
                                        Income
                                        Sources </a>
                                </li>
                            @endif
                            @if (check_permission('expense-categories.index'))
                                <li>
                                    <a href="{{ url('expense-categories') }}">
                                        Expense
                                        Categories </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (main_menu_permission('purchase'))
                    <li>
                        <a href="javaScript:void();">
                            <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                                alt="basic">
                            <span>Purchase</span>
                            <i class="feather icon-chevron-right pull-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            @if (check_permission('purchase.create'))
                                <li>
                                    <a href="{{ route('purchase.create') }}">
                                        Product Purchase
                                    </a>
                                </li>
                            @endif
                            @if (check_permission('purchase.index'))
                                <li>
                                    <a href="{{ route('purchase.index') }}">
                                        Purchase List
                                    </a>
                                </li>
                            @endif
                            @if (check_permission('purchase.log-list'))
                                <li>
                                    <a href="{{ route('purchase.log-list') }}">
                                        Purchase Log
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (check_permission('units.index'))
                    <li>
                        <a href="{{ route('units.index') }}">
                            <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                                alt="basic">
                            <span>Unit</span>
                        </a>
                    </li>
                @endif

                @if (check_permission('brands.index'))
                    <li>
                        <a href="{{ route('brands.index') }}">
                            <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                                alt="basic">
                            <span>Brand</span>
                        </a>
                    </li>
                @endif

                @if (check_permission('categories.index'))
                    <li>
                        <a href="{{ route('categories.index') }}">
                            <i class="feather icon-book"></i>
                            <span>Category</span>
                        </a>
                    </li>
                @endif

                @if (main_menu_permission('products'))
                    <li>
                        <a href="javaScript:void();">
                            <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                                alt="basic">
                            <span>Products</span>
                            <i class="feather icon-chevron-right pull-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            {{-- //create --}}
                            @if (check_permission('products.create'))
                                <li>
                                    <a href="{{ route('products.create') }}">
                                        Add Product
                                    </a>
                                </li>
                            @endif
                            {{-- //list --}}
                            @if (check_permission('products.index'))
                                <li>
                                    <a href="{{ route('products.index') }}">
                                        Product List
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (main_menu_permission('customers'))
                    <li>
                        <a href="{{ route('customers.index') }}"
                            class="{{ request()->is('customers*') ? 'active' : '' }}">
                            <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                                alt="basic">
                            <span>Customers</span>
                        </a>
                    </li>
                @endif

                @if (main_menu_permission('suppliers'))
                    <li>
                        <a href="{{ route('suppliers.index') }}">
                            <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                                alt="basic">
                            <span>Suppliers</span>
                        </a>
                    </li>
                @endif

                @if (main_menu_permission('payment-methods'))
                    @if (check_permission('payment-methods.index'))
                        <li>
                            <a href="{{ route('payment-methods.index') }}"
                                class="{{ request()->is('customers*') ? 'active' : '' }}">
                                <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                                    alt="basic">
                                <span>Payment Method</span>
                            </a>
                        </li>
                    @endif
                @endif

                @if (main_menu_permission('users'))
                    <li>
                        <a href="javaScript:void();">
                            <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                                alt="basic">
                            <span>User Management</span>
                            <i class="feather icon-chevron-right pull-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            @if (check_permission('users.create'))
                                <li>
                                    <a href="{{ route('users.create') }}">
                                        Add User
                                    </a>
                                </li>
                            @endif
                            @if (check_permission('users.index'))
                                <li>
                                    <a href="{{ route('users.index') }}">
                                        User List
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (main_menu_permission('roles-permission'))
                    <li>
                        <a href="javaScript:void();">
                            <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                                alt="basic">
                            <span>Role Management</span>
                            <i class="feather icon-chevron-right pull-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            @if (check_permission('roles-permission.index'))
                                <li>
                                    <a href="{{ route('roles-permission.index') }}">
                                        Role & Permission
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</div>
