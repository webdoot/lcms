<!-- Page header -->
<div class="page-header page-header-light shadow border-bottom">
    <div class="page-header-content d-flex"> 
		<h4 class="page-title mb-0">@yield('page_title')</h4>
    
    	<a class="btn btn-sm btn-outline-dark my-3 ms-auto" href="{!! isset($backurl) ? $backurl : url()->previous() !!}"> <i class="icon-chevron-left"></i> Back </a>
    </div>
</div>
<!-- /page header -->