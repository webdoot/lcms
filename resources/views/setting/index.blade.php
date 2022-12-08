@extends('lcms::layout')
@section('page_title', 'Setting')

@push('head')
@endpush

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title font-weight-semibold "> Edit </h6>
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="site" class="nav-link active" data-toggle="tab"> <i class="icon-library2 mr-2"></i> Site </a></li>                     
        </ul>
       
        <div class="tab-content">
            
            @include('lcms::setting.index-inc.site')            
            
        </div>
    </div>

</div>

@endsection

@section('footer')
@endsection

@push('footer')
@endpush