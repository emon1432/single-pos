<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Orbiter is a bootstrap minimal & clean admin template">
    <meta name="keywords"
        content="admin, admin panel, admin template, admin dashboard, responsive, bootstrap 4, ui kits, ecommerce, web app, crm, cms, html, sass support, scss">
    <meta name="author" content="Themesbox">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Single POS - @yield('page-title')</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="{{ asset('backend') }}/images/favicon.ico">
    <!-- Start css -->
    
    <!-- Switchery css -->
    <link href="{{ asset('backend') }}/plugins/switchery/switchery.min.css" rel="stylesheet">
    <!-- Apex css -->
    <link href="{{ asset('backend') }}/plugins/apexcharts/apexcharts.css" rel="stylesheet">
    <!-- Slick css -->
    <link href="{{ asset('backend') }}/plugins/slick/slick.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/plugins/slick/slick-theme.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend') }}/css/icons.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend') }}/css/flag-icon.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend') }}/css/style.css" rel="stylesheet" type="text/css">
    <!-- Summernote css -->
    <link href="{{ asset('backend') }}/plugins/summernote/summernote-bs4.css" rel="stylesheet">
    <!-- iziToast css -->
    <link href="{{ asset('backend') }}/plugins/iziToast/css/iziToast.css" rel="stylesheet">
    <!-- toggle css -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- End css -->
    @stack('css')
</head>

<body class="vertical-layout">
    <div id="containerbar">
        @include('backend.layouts.includes.sidebar')
        <div class="rightbar">
            @include('backend.layouts.includes.header')
            @include('backend.layouts.includes.breadcrumb')
            <div class="contentbar">
                @yield('content')
            </div>
            @include('backend.layouts.includes.footer')
        </div>
    </div>
    <!-- Start js -->
    <script src="{{ asset('backend') }}/js/jquery.min.js"></script>
    <script src="{{ asset('backend') }}/js/popper.min.js"></script>
    <script src="{{ asset('backend') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('backend') }}/js/modernizr.min.js"></script>
    <script src="{{ asset('backend') }}/js/detect.js"></script>
    <script src="{{ asset('backend') }}/js/jquery.slimscroll.js"></script>
    <script src="{{ asset('backend') }}/js/vertical-menu.js"></script>
    <!-- Switchery js -->
    <script src="{{ asset('backend') }}/plugins/switchery/switchery.min.js"></script>
    <!-- Apex js -->
    <script src="{{ asset('backend') }}/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/apexcharts/irregular-data-series.js"></script>
    <!-- Slick js -->
    <script src="{{ asset('backend') }}/plugins/slick/slick.min.js"></script>

    <!-- Select2 js -->
    <script src="{{ asset('backend') }}/plugins/select2/select2.min.js"></script>
    
    <!-- Custom Dashboard js -->
    <script src="{{ asset('backend') }}/js/custom/custom-dashboard.js"></script>
    <!-- Summernote js -->
    <script src="{{ asset('backend') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="{{ asset('backend') }}/js/custom/custom-form-editor.js"></script>
    <!-- Core js -->
    <script src="{{ asset('backend') }}/js/core.js"></script>
    <script src="{{ asset('backend') }}/js/status-update.js"></script>
    <!-- toggle js -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- iziToast js -->
    <script src="{{ asset('backend') }}/plugins/iziToast/js/iziToast.js"></script>
    @include('vendor.lara-izitoast.toast')
    <!-- End js -->
    @stack('js')
</body>

</html>
