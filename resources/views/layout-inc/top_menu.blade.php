<!-- Main navbar -->
<div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
    {{-- Mobile View --}}
    <div class="container-fluid">
        <div class="d-flex d-lg-none">
            <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded">
                <i class="icon-paragraph-justify3"></i>
            </button>
            
            @hasSection('sidebar_sec')
            <button type="button" class="navbar-toggler sidebar-mobile-secondary-toggle rounded">
                <i class="icon-loop"></i>
            </button>
            @endif
        </div>

        {{-- Logo --}}
        <div class="navbar-brand">
            <a href="{{route('lcms_dashboard')}}" class="d-inline-flex align-items-center">
                <img src="{{asset('vendor/lcms/logo-bg.png')}}" alt="">
            </a>
        </div>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-control sidebar-main-resize d-none d-lg-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>

            <li class="nav-item ms-1">
                <a href="{{route('home')}}" class="navbar-nav-link navbar-nav-link-icon rounded"  target="_blank">
                    <div class="d-flex align-items-center mx-md-1">
                        <i class="icon-sphere"></i>
                        <span class="d-none d-md-inline-block ms-2">Visit website</span>
                    </div>
                </a>
            </li>
        </ul>

        <ul class="nav gap-sm-2 order-1 order-lg-2 ms-lg-auto">
            <li class="nav-item nav-item-dropdown-lg dropdown">
                <a href="#" class="navbar-nav-link align-items-center rounded p-1" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="status-indicator-container">
                        <img src="{{asset('assets/images/user.png')}}" class="w-32px h-32px rounded" alt="">
                        <span class="status-indicator bg-success"></span>
                    </div>
                    <span class="d-none d-lg-inline-block mx-lg-2">{{Auth::user()->name}}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <a href="#" class="dropdown-item"> My profile</a>
                    <a href="#" class="dropdown-item"> Another action</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();" class="dropdown-item"> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->