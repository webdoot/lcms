<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-dark sidebar-expand-md @hasSection('sidebar_sec') sidebar-main-resized @endif ">
    <div class="sidebar-content">
        <!-- User menu -->
        <div class="sidebar-section sidebar-user my-1">
            <div class="sidebar-section-body">
                <div class="media">
                    <a href="#" class="mr-3">
                        <img src="{{ asset('assets/images/user.png') }}" class="rounded-circle" alt="">
                    </a>

                    <div class="media-body">
                        <a href="#" class="text-white">
                        <div class="font-weight-semibold">{{ Auth::user()->name }}</div>
                        <div class="font-size-sm line-height-sm opacity-50">User</div>
                        </a>
                    </div>

                    <div class="align-self-center">
                        <a type="button" href="#" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm d-none d-md-inline-flex" data-toggle="tooltip" title="Change password">
                            <i class="icon-lock"></i>
                        </a>

                        <button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-md-none">
                            <i class="icon-cross2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->
        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                {{--Dashboard--}}  
                <li class="nav-item">
                    <a href="{{ route('lcms_dashboard') }}" class="nav-link {{ (Route::is('lcms_dashboard')) ? 'active' : '' }}"> <i class="icon-home4"></i> <span>Dashboard</span> </a>
                </li> 

                {{--Media--}}  
                <li class="nav-item">
                    <a href="{{ route('lcms_media.index') }}" class="nav-link {{ (Route::is('lcms_media.index')) ? 'active' : '' }}"> <i class="icon-images3"></i> <span>Media</span> </a>
                </li>  

                {{--Article--}}  
                <li class="nav-item">
                    <a href="{{ route('lcms_article.index') }}" class="nav-link {{ (Route::is('lcms_article.index')) ? 'active' : '' }}"> <i class="icon-file-text2"></i> <span>Article</span> </a>
                </li> 

                {{--Menu--}}  
                <li class="nav-item">
                    <a href="{{ route('lcms_menu.index') }}" class="nav-link {{ (Route::is('lcms_menu.index')) ? 'active' : '' }}"> <i class="icon-grid"></i> <span>Menu</span> </a>
                </li>  

                {{--Post--}}  
                <li class="nav-item">
                    <a href="{{ route('lcms_post.index') }}" class="nav-link {{ (Route::is('lcms_post.index')) ? 'active' : '' }}"> <i class="icon-stack2"></i> <span>Post</span> </a>
                </li>

                {{--Setting--}}  
                <li class="nav-item">
                    <a href="{{ route('lcms_setting.index') }}" class="nav-link {{ (Route::is('lcms_setting.index')) ? 'active' : '' }}"> <i class="icon-cog"></i> <span>Setting</span> </a>
                </li> 




            </ul>
        </div>
        <!-- /main navigation -->

    </div>    
</div>
<!-- /main sidebar -->
