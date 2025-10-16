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
      {{-- Dashboard --}}
      <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}">
          <i class="menu-icon fa fa-tachometer"></i>
          <span class="menu-text"> Dashboard </span>
        </a>
        <b class="arrow"></b>
      </li>

      @php
      $currentRoute = request()->route()->getName();
      @endphp

      
        {{-- CRUD SECTION (1–6) --}}
      <li class="{{ Str::startsWith($currentRoute, 'dashboard.crud-') && (int)explode('.', explode('-', $currentRoute)[1])[0] <= 6 ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="dropdown-toggle">
          <i class="menu-icon fa fa-list"></i>
          <span class="menu-text"> CRUD </span>
          <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
          @for ($i = 1; $i <= 6; $i++) <li class="{{ request()->routeIs('dashboard.crud-' . $i . '.*') ? 'active' : '' }}">
            <a href="{{ route('dashboard.crud-' . $i . '.index') }}">
              <i class="menu-icon fa fa-caret-right"></i>
              CRUD - {{ $i }}
            </a>
      </li>
      @endfor
      </ul>
      </li>


    {{-- ==========================
        BLOG MANAGEMENT (CRUD 7–10)
    =========================== --}}
    <li class="{{ (Str::startsWith($currentRoute, 'dashboard.crud-7') || Str::startsWith($currentRoute, 'dashboard.crud-8') || Str::startsWith($currentRoute, 'dashboard.crud-9') || Str::startsWith($currentRoute, 'dashboard.crud-10')) ? 'active open' : '' }}">
      <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-desktop"></i>
        <span class="menu-text"> Blog Management </span>
        <b class="arrow fa fa-angle-down"></b>
      </a>

      <b class="arrow"></b>

      <ul class="submenu">
        {{-- Category Section --}}
        <li class="{{ (request()->routeIs('dashboard.crud-7.*') || request()->routeIs('dashboard.crud-8.*') || request()->routeIs('dashboard.crud-9.*')) ? 'active open' : '' }}">
          <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-caret-right"></i>
            Categories
            <b class="arrow fa fa-angle-down"></b>
          </a>

          <b class="arrow"></b>
          <ul class="submenu">
            <li class="{{ request()->routeIs('dashboard.crud-7.*') ? 'active' : '' }}">
              <a href="{{ route('dashboard.crud-7.index') }}">
                <i class="menu-icon fa fa-caret-right"></i> Category
              </a>
            </li>

            <li class="{{ request()->routeIs('dashboard.crud-8.*') ? 'active' : '' }}">
              <a href="{{ route('dashboard.crud-8.index') }}">
                <i class="menu-icon fa fa-caret-right"></i> Sub-Category
              </a>
            </li>

            <li class="{{ request()->routeIs('dashboard.crud-9.*') ? 'active' : '' }}">
              <a href="{{ route('dashboard.crud-9.index') }}">
                <i class="menu-icon fa fa-caret-right"></i> Sub-Sub-Category
              </a>
            </li>
          </ul>
        </li>

        {{-- Posts --}}
        <li class="{{ request()->routeIs('dashboard.crud-10.*') ? 'active' : '' }}">
          <a href="{{ route('dashboard.crud-10.index') }}">
            <i class="menu-icon fa fa-caret-right"></i>
            Posts Management
          </a>
        </li>
      </ul>
    </li>

    {{-- ==========================
        OTHER PAGES SECTION
    =========================== --}}
    <li class="{{ Str::startsWith($currentRoute, 'dashboard.company') ? 'active open' : '' }}">
      <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-file-o"></i>
        <span class="menu-text">
          Other Pages
          <span class="badge badge-primary">1</span>
        </span>
        <b class="arrow fa fa-angle-down"></b>
      </a>

      <b class="arrow"></b>

      <ul class="submenu">
        <li class="{{ request()->routeIs('dashboard.company.*') ? 'active' : '' }}">
          <a href="{{ route('dashboard.company.index') }}">
            <i class="menu-icon fa fa-caret-right"></i>
            Company Settings
          </a>
        </li>
      </ul>
    </li>
    </ul>



    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>