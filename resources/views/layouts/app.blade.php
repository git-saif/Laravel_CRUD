<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Dashboard - Smart ERP</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

    <!-- text fonts -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/fonts.googleapis.com.css') }}" />

    <!-- ace styles -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/ace-skins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/ace-rtl.min.css') }}" />

    <!-- ace settings handler -->
    <script src="{{ asset('admin/assets/js/ace-extra.min.js') }}"></script>

</head>

<body class="no-skin">

    <!-- header Start -->
    @include('layouts.includes.header')
    <!-- header end -->

    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.loadState('main-container')
            } catch (e) {}
        </script>

        <!-- Sidebar Start -->
        @include('layouts.includes.sidebar')
        <!-- Sidebar End -->

        <div class="main-content">
            @yield('content')
        </div><!-- /.main-content -->

        <!-- Footer Start -->
        @include('layouts.includes.footer')
        <!-- Footer End -->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script src="{{ asset('admin/assets/js/jquery-2.1.4.min.js') }}"></script>

    <!-- <![endif]-->

    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('admin/assets/js/jquery.mobile.custom.min.js') }}'>" + "<" + "/script>");
    </script>
    <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>

    <!-- page specific plugin scripts -->

    <script src="{{ asset('admin/assets/js/jquery-ui.custom.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.sparkline.index.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.flot.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.flot.pie.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.flot.resize.min.js') }}"></script>

    <!-- ace scripts -->
    <script src="{{ asset('admin/assets/js/ace-elements.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ace.min.js') }}"></script>

    <!-- inline scripts related to this page -->
    @include('layouts.includes.inline-scripts')
</body>

</html>