<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')
        } catch (e) {}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
            <b class="arrow"></b>
        </li>

        {{-- CRUD Menu --}}
        @php
        $currentRoute = request()->route()->getName();
        @endphp

        <li class="{{ Str::startsWith($currentRoute, 'dashboard.crud') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="dropdown-toggle">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> CRUD </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                {{-- <li class="{{ Str::startsWith($currentRoute, 'dashboard.crud-1') ? 'active' : '' }}">

                  <a href="{{ route('dashboard.crud-1.index') }}">
                    <i class="menu-icon fa fa-caret-right"></i>
                    CRUD - 1
                  </a>
                </li> --}}
                
                <li class="{{ request()->routeIs('dashboard.crud-1.*') ? 'active' : '' }}">
                  <a href="{{ route('dashboard.crud-1.index') }}">
                    <i class="menu-icon fa fa-caret-right"></i>
                    CRUD - 1
                  </a>
                </li>

                <li class="{{ request()->routeIs('dashboard.crud-2.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.crud-2.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        CRUD - 2
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ request()->routeIs('dashboard.crud-3.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.crud-3.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        CRUD - 3
                    </a>
                    <b class="arrow"></b>
                </li>

                {{-- CRUD 4 --}}
                <li class="{{ request()->routeIs('dashboard.crud-4.*')  ? 'active' : '' }}">
                    <a href="{{ route('dashboard.crud-4.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        CRUD - 4
                    </a>
                    <b class="arrow"></b>
                </li>

                {{-- CRUD 5 --}}
                <li class="{{ request()->routeIs('dashboard.crud-5.*')  ? 'active' : '' }}">
                    <a href="{{ route('dashboard.crud-5.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        CRUD - 5
                    </a>
                    <b class="arrow"></b>
                </li>

                {{-- CRUD 6 --}}
                <li class="{{ request()->routeIs('dashboard.crud-6.*')  ? 'active' : '' }}">
                    <a href="{{ route('dashboard.crud-6.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        CRUD - 6
                    </a>
                    <b class="arrow"></b>
                </li>

                {{-- CRUD 7 --}}
                <li class="{{ request()->routeIs('dashboard.crud-7.*')  ? 'active' : '' }}">
                    <a href="{{ route('dashboard.crud-7.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        CRUD - 7
                    </a>
                    <b class="arrow"></b>
                </li>

                {{-- CRUD 8 --}}
                <li class="{{ request()->routeIs('dashboard.crud-8.*')  ? 'active' : '' }}">
                    <a href="{{ route('dashboard.crud-8.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        CRUD - 8
                    </a>
                    <b class="arrow"></b>
                </li>

                {{-- CRUD 9 --}}
                <li class="{{ request()->routeIs('dashboard.crud-9.*')  ? 'active' : '' }}">
                    <a href="{{ route('dashboard.crud-9.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        CRUD - 9
                    </a>
                    <b class="arrow"></b>
                </li>

                {{-- CRUD 10 --}}
                <li class="{{ request()->routeIs('dashboard.crud-10.*') ? 'active' : '' }}">
                  <a href="{{ route('dashboard.crud-10.index') }}">
                    <i class="menu-icon fa fa-caret-right"></i>
                    CRUD - 10
                  </a>
                </li>

                {{-- Company --}}
                <li class="{{ request()->routeIs('dashboard.company.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.company.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Company Settings
                    </a>
                </li>
                
            </ul>
        </li>


        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-desktop"></i>
                <span class="menu-text">
                    CRUD Alt
                </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-caret-right"></i>

                        Layouts
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li class="">
                            <a href="top-menu.html">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Top Menu
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="two-menu-1.html">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Two Menus 1
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="two-menu-2.html">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Two Menus 2
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="mobile-menu-1.html">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Default Mobile Menu
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="mobile-menu-2.html">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Mobile Menu 2
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="mobile-menu-3.html">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Mobile Menu 3
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>

                <li class="">
                    <a href="typography.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Typography
                    </a>

                    <b class="arrow"></b>
                </li>

            </ul>
        </li>



        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-file-o"></i>

                <span class="menu-text">
                    Other Pages

                    <span class="badge badge-primary">5</span>
                </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="faq.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        FAQ
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="error-404.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Error 404
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="error-500.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Error 500
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="grid.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Grid
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="blank.html">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Blank Page
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>