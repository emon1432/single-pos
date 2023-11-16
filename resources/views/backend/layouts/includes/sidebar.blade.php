<div class="leftbar">
    <div class="sidebar">
        <div class="logobar">
            {{-- <a href="index.html" class="logo logo-large"><img src="{{ asset('backend') }}/images/logo.svg" class="img-fluid"
                    alt="logo"></a> --}}
                    <h3 class="text-white logo logo-large">RandomIT</h3>
            {{-- <a href="index.html" class="logo logo-small"><img src="{{ asset('backend') }}/images/small_logo.svg"
                    class="img-fluid" alt="logo"></a> --}}
                    <h5 class="logo logo-small">rIT</h5>
        </div>
        <div class="navigationbar">
            <ul class="vertical-menu">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('backend') }}/images/svg-icon/dashboard.svg" class="img-fluid"
                            alt="dashboard">
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users.index') }}">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                            alt="basic">
                        <span>Bank Accounts</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users.index') }}">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                            alt="basic">
                        <span>POS</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                            alt="basic">
                        <span>Sale List</span>
                    </a>
                </li>

                <li>
                    <a href="javaScript:void();">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                            alt="basic">
                        <span>Purchase</span>
                        <i class="feather icon-chevron-right pull-right"></i>
                    </a>
                    <ul class="vertical-submenu">
                        @if (check_permission('users.create'))
                            <li>
                                <a href="{{ route('users.create') }}">
                                    Create Purchase
                                </a>
                            </li>
                        @endif
                        @if (check_permission('users.index'))
                            <li>
                                <a href="{{ route('users.index') }}">
                                    Purchase List
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

                <li>
                    <a href="{{ route('suppliers.index') }}">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                            alt="basic">
                        <span>Suppliers</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('customers.index') }}" class="{{ request()->is('customers*') ? 'active' : '' }}">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid"
                            alt="basic">
                        <span>Customers</span>
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

            </ul>
        </div>
    </div>
</div>
