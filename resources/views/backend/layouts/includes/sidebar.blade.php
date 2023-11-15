<div class="leftbar">
    <div class="sidebar">
        <div class="logobar">
            <a href="index.html" class="logo logo-large"><img src="{{ asset('backend') }}/images/logo.svg" class="img-fluid"
                    alt="logo"></a>
            <a href="index.html" class="logo logo-small"><img src="{{ asset('backend') }}/images/small_logo.svg"
                    class="img-fluid" alt="logo"></a>
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
                    <a href="javaScript:void();">
                        <img src="{{ asset('backend') }}/images/svg-icon/basic.svg" class="img-fluid" alt="basic">
                        <span>User Management</span>
                        <i class="feather icon-chevron-right pull-right"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li>
                            <a href="{{ route('users.create') }}">
                                Add User
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}">
                                User List
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
