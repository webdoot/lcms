<div class="navbar navbar-expand-md navbar-dark navbar-static">
    {{-- Mobile View --}}
    <div class="d-flex flex-1 d-md-none">
        <button type="button" class="navbar-toggler sidebar-mobile-main-toggle">
            <i class="icon-paragraph-justify3"></i>
        </button>
        @hasSection('sidebar_sec')
        <button type="button" class="navbar-toggler sidebar-mobile-secondary-toggle">
            <i class="icon-loop"></i>
        </button>
        @endif
    </div>

    {{-- Logo --}}
    <div class="navbar-brand text-center text-md-left">
        <a href="{{ route('lcms_dashboard') }}" class="d-inline-block text-muted">
            <!-- <h3>LCMS</h3> -->
            <img src="{{ asset('vendor/lcms/logo-bg.png') }}" alt="">
        </a>
    </div>
    
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="#" class="navbar-nav-link sidebar-control sidebar-control sidebar-main-resize d-none d-md-block">
                <i class="icon-loop"></i>
            </a>
        </li>
    </ul>

    <div class="navbar-collapse order-2 order-md-1">
        <span class="navbar-text font-weight-semibold text-muted ml-md-3 mr-md-auto">Admin Panel</span>        
    </div>

    <ul class="navbar-nav flex-row order-1 order-lg-2 flex-1 flex-lg-0 justify-content-end align-items-center">
        <li class="nav-item nav-item-dropdown-md dropdown dropdown-user h-100">
            <a href="#" class="navbar-nav-link navbar-nav-link-toggler dropdown-toggle d-inline-flex align-items-center h-100" data-toggle="dropdown">
                <img src="{{ asset('assets/images/user.png') }}" class="rounded-pill mr-md-2" width="34" height="34" alt="">
                <span class="d-none d-md-inline-block">{{ Auth::user()->name }}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item"><i class="icon-lock"></i> Change Password</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</div>
