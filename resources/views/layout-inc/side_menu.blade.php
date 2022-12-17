<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg @hasSection('sidebar_sec') sidebar-main-resized @endif">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar header -->
        <div class="sidebar-section">
            <div class="sidebar-section-body d-flex justify-content-center">
                <h6 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h6>

                <div>
                    <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="icon-transmission"></i>
                    </button>

                    <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                        <i class="icon-x"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /sidebar header -->


        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                
                {{--Dashboard--}}  
                <li class="nav-item mb-2">
                    <a href="{{ route('lcms_dashboard') }}" class="nav-link {{ (Route::is('lcms_dashboard')) ? 'active' : '' }}"> <i class="icon-home4"></i> <span>Dashboard</span> </a>
                </li> 

                {{--Media--}}  
                <li class="nav-item mb-2">
                    <a href="{{ route('lcms_media.index', ['type'=>'all']) }}" class="nav-link {{ (Route::is('lcms_media.index')) ? 'active' : '' }}"> <i class="icon-images3"></i> <span>Media</span> </a>
                </li>  

                {{--Article--}}  
                <li class="nav-item mb-2">
                    <a href="{{ route('lcms_article.index') }}" class="nav-link {{ (Route::is('lcms_article.index')) ? 'active' : '' }}"> <i class="icon-file-text2"></i> <span>Article</span> </a>
                </li> 

                {{--Menu--}}  
                <li class="nav-item mb-2">
                    <a href="{{ route('lcms_menu.index') }}" class="nav-link {{ (Route::is('lcms_menu.index')) ? 'active' : '' }}"> <i class="icon-grid"></i> <span>Menu</span> </a>
                </li>  

                {{--Post--}}  
                <li class="nav-item mb-2">
                    <a href="{{ route('lcms_post.index') }}" class="nav-link {{ (Route::is('lcms_post.index')) ? 'active' : '' }}"> <i class="icon-stack2"></i> <span>Post</span> </a>
                </li>

                {{--Setting--}}  
                @if(Lcms::isAdmin())
                <li class="nav-item mb-2">
                    <a href="{{ route('lcms_setting.index') }}" class="nav-link {{ (Route::is('lcms_setting.index')) ? 'active' : '' }}"> <i class="icon-cog"></i> <span>Settings</span> </a>
                </li> 
                @endif

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->
    
</div>
<!-- /main sidebar -->