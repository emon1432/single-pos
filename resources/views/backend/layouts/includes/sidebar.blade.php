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
                    <a href="#">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid" alt="basic">
                        <span>POS</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid" alt="basic">
                        <span>Sale List</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid" alt="basic">
                        <span>Return List</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid" alt="basic">
                        <span>Damage</span>
                    </a>
                </li>

                <li>
                    <a href="javaScript:void();">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid" alt="basic">
                        <span>Purchase</span>
                        <i class="feather icon-chevron-right pull-right"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li>
                            <a href="{{ route('purchase.create') }}">
                                Product Purchase
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('purchase.index') }}">
                                Purchase List
                            </a>
                        </li>
                    </ul>
                </li>


                @if (check_permission('units.index'))
                    <li>
                        <a href="{{ route('units.index') }}">
                            <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                                alt="basic">
                            Unit
                        </a>
                    </li>
                @endif

                {{-- Brand --}}
                @if (check_permission('brands.index'))
                    <li>
                        <a href="{{ route('brands.index') }}">
                            <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                                alt="basic">
                            Brand
                        </a>
                    </li>
                @endif

                {{-- Category --}}
                @if (check_permission('categories.index'))
                    <li>
                        <a href="{{ route('categories.index') }}">
                            <i class="feather icon-book"></i>
                            Category
                        </a>
                    </li>
                @endif

                {{-- products --}}
                <li>
                    <a href="javaScript:void();">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid" alt="basic">
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

                <li>
                    <a href="{{ route('customers.index') }}"
                        class="{{ request()->is('customers*') ? 'active' : '' }}">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid" alt="basic">
                        <span>Customers</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('suppliers.index') }}">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid" alt="basic">
                        <span>Suppliers</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="{{ request()->is('customers*') ? 'active' : '' }}">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid" alt="basic">
                        <span>Expense</span>
                    </a>
                </li>
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


                <li>
                    <a href="#">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid" alt="basic">
                        <span>Promotional SMS</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid" alt="basic">
                        <span>Accounts</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid" alt="basic">
                        <span>Reports</span>
                    </a>
                </li>

                {{-- users --}}
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

                <li>
                    <a href="#">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                            alt="basic">
                        <span>Backup</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
