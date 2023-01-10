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
                <li class="nav-item mb-1">
                    <a href="{{ route('lcms_dashboard') }}" class="nav-link {{ (Route::is('lcms_dashboard')) ? 'active' : '' }}"> <i class="icon-home4"></i> <span>Dashboard</span> </a>
                </li>  

                {{--Media--}}  
                <li class="nav-item mb-1">
                    <a href="{{ route('lcms_media.index', ['type'=>'all']) }}" class="nav-link {{ (Route::is('lcms_media.*')) ? 'active' : '' }}"> <i class="icon-images3"></i> <span>Media</span> </a>
                </li> 

                {{--Article--}}  
                <li class="nav-item mb-1">
                    <a href="{{ route('lcms_article.index') }}" class="nav-link {{ (Route::is('lcms_article.*')) ? 'active' : '' }}"> <i class="icon-file-text2"></i> <span>Article</span> </a>
                </li> 

                {{--Menu--}}  
                <li class="nav-item mb-1">
                    <a href="{{ route('lcms_menu.index') }}" class="nav-link {{ (Route::is('lcms_menu.*')) ? 'active' : '' }}"> <i class="icon-list"></i> <span>Menu</span> </a>
                </li> 

                {{--Slider--}}  
                <li class="nav-item mb-1">
                    <a href="{{ route('lcms_slider.index') }}" class="nav-link {{ (Route::is('lcms_slider.*')) ? 'active' : '' }}"> <i class="icon-grid5"></i> <span>Slider</span> </a>
                </li> 

                {{--Gallery--}}  
                <li class="nav-item mb-1">
                    <a href="{{ route('lcms_gallery.index') }}" class="nav-link {{ (Route::is('lcms_gallery.*')) ? 'active' : '' }}"> <i class="icon-gallery"></i> <span>Gallery</span> </a>
                </li> 

                {{--Post--}}  
                <li class="nav-item mb-1">
                    <a href="{{ route('lcms_post.index') }}" class="nav-link {{ (Route::is('lcms_post.*')) ? 'active' : '' }}"> <i class="icon-stack2"></i> <span>Post</span> </a>
                </li>

                {{--Category--}}  
                <li class="nav-item mb-1">
                    <a href="{{ route('lcms_category.index') }}" class="nav-link {{ (Route::is('lcms_category.*')) ? 'active' : '' }}"> <i class="icon-bookmark"></i> <span>Category</span> </a>
                </li>

                {{--Tags--}}  
                <li class="nav-item mb-1">
                    <a href="{{ route('lcms_tag.index') }}" class="nav-link {{ (Route::is('lcms_tag.*')) ? 'active' : '' }}"> <i class="icon-books"></i> <span>Tags</span> </a>
                </li>

                {{--Setting--}}  
                @if(Lcms::isAdmin())
                <li class="nav-item mb-1">
                    <a href="{{ route('lcms_setting.index') }}" class="nav-link {{ (Route::is('lcms_setting.*')) ? 'active' : '' }}"> <i class="icon-cog"></i> <span>Settings</span> </a>
                </li> 
                @endif

                {{--Icons--}}  
                <li class="nav-item mb-1">
                    <a href="{{ route('lcms_icon.index') }}" class="nav-link {{ (Route::is('lcms_icon.*')) ? 'active' : '' }}"> <i class="icon-stack2"></i> <span>Icons</span> </a>
                </li>

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->
    
</div>
<!-- /main sidebar -->