<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-inline py-3">        
        <h4 class="font-weight-semibold">@yield('page_title')</h4>
        
        <a type="button" class="btn btn-sm btn-outline-dark" href="{!! isset($backurl) ? $backurl : url()->previous() !!}" style="margin-top: -10px"> <i class="icon-chevron-left"></i> Back </a>
    </div>
</div>
<!-- /page header -->
