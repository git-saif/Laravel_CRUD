<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <meta name="description" content="@yield('meta_description', 'Overview, Stats, Tables')" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- Bootstrap & Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

    <!-- Text fonts -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/fonts.googleapis.com.css') }}" />

    <!-- Ace styles -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/ace-skins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/ace-rtl.min.css') }}" />

    <!-- Page-specific styles -->
    @stack('page_styles')

    <!-- Ace settings handler -->
    <script src="{{ asset('admin/assets/js/ace-extra.min.js') }}"></script>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/ace-ie.min.css') }}" />
    <script src="{{ asset('admin/assets/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/respond.min.js') }}"></script>
    <![endif]-->

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
    <!-- jQuery - CDN fallback handled via IE conditional -->
    <!--[if !IE]> -->
    <script src="{{ asset('admin/assets/js/jquery-2.1.4.min.js') }}"></script>
    <!-- <![endif]-->

    <!--[if IE]>
<script src="{{ asset('admin/assets/js/jquery-1.11.3.min.js') }}"></script>
<![endif]-->

    <!-- jQuery Mobile Custom for touch devices -->
    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement)
            document.write("<script src='{{ asset('admin/assets/js/jquery.mobile.custom.min.js') }}'>" + "<" + "/script>");
    </script>

    <!-- Bootstrap Core -->
    <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>

    <!-- jQuery UI & Plugins (charts, sparkline, flot etc) -->
    <script src="{{ asset('admin/assets/js/jquery-ui.custom.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.sparkline.index.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.flot.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.flot.pie.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.flot.resize.min.js') }}"></script>

    <!-- DataTables Core & Extensions -->
    <script src="{{ asset('admin/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.select.min.js') }}"></script>

    <!-- ACE Scripts -->
    <script src="{{ asset('admin/assets/js/ace-elements.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ace.min.js') }}"></script>


    <!-- inline scripts related to this page -->
    @include('layouts.includes.inline-scripts')

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- other scripts -->
    @stack('scripts')
</body>

</html>