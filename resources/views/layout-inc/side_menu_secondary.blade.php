<!-- Secondary sidebar -->
{{-- Put into @section('sidebar_sec') of blade file --}}
<div class="sidebar sidebar-secondary sidebar-expand-lg">

    <!-- Expand button -->
    <button type="button" class="btn btn-sidebar-expand sidebar-control sidebar-secondary-toggle h-100">
        <i class="ph-caret-right"></i>
    </button>
    <!-- /expand button -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Header -->
        <div class="sidebar-section sidebar-section-body d-flex align-items-center pb-0">
            <h5 class="mb-0">Sidebar</h5>
            <div class="ms-auto">
                <button type="button" class="btn btn-light border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-secondary-toggle d-none d-lg-inline-flex">
                    <i class="icon-transmission"></i>
                </button>

                <button type="button" class="btn btn-light border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-secondary-toggle d-lg-none">
                    <i class="icon-x"></i>
                </button>
            </div>
        </div>
        <!-- /header -->


        <!-- Sidebar search -->
        <div class="sidebar-section">
            <div class="sidebar-section-header border-bottom">
                <span class="fw-semibold">Sidebar search</span>
                <div class="ms-auto">
                    <a href="#sidebar_secondary_search" class="text-reset" data-bs-toggle="collapse">
                        <i class="ph-caret-down collapsible-indicator"></i>
                    </a>
                </div>
            </div>

            <div class="collapse show" id="sidebar_secondary_search">
                <div class="sidebar-section-body">
                    <div class="form-control-feedback form-control-feedback-end">
                        <input type="search" class="form-control" placeholder="Search">
                        <div class="form-control-feedback-icon">
                            <i class="ph-magnifying-glass opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /sidebar search -->


        <!-- Sub navigation -->
        <div class="sidebar-section">
            <div class="sidebar-section-header border-bottom">
                <span class="fw-semibold">Navigation</span>
                <div class="ms-auto">
                    <a href="#sidebar_secondary_navigation" class="text-reset" data-bs-toggle="collapse">
                        <i class="ph-caret-down collapsible-indicator"></i>
                    </a>
                </div>
            </div>

            <div class="collapse show" id="sidebar_secondary_navigation">
                <ul class="nav nav-sidebar my-2" data-nav-type="accordion">
                    <li class="nav-item-header opacity-50">Header</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="ph-plus-circle me-2"></i>
                            Nav item 1
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="ph-circles-three-plus me-2"></i>
                            Nav item 2
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="ph-user-plus me-2"></i>
                            Nav item 3
                            <span class="badge bg-primary rounded-pill ms-auto">Badge</span>
                        </a>
                    </li>
                    <li class="nav-item-header opacity-50">Header</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="ph-kanban me-2"></i>
                            Nav item 4
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="ph-file-plus me-2"></i>
                            Nav item 5
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link disabled">
                            <i class="ph-file-x me-2"></i>
                            Nav item 6
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sub navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /secondary sidebar -->