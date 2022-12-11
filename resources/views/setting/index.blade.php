@extends('lcms::layout')
@section('page_title', 'Setting')

@push('head')
<style>
    code {
        float: right;
        background-color: #f0f2f5;
    }
</style>
@endpush

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title font-weight-semibold "> Edit </h6>
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#site" class="nav-link active" data-toggle="tab"> <i class="icon-library2 mr-2"></i> Site </a></li>  
            <li class="nav-item"><a href="#header" class="nav-link" data-toggle="tab"> <i class="icon-brain mr-2"></i> Header </a></li>  
            <li class="nav-item"><a href="#footer" class="nav-link" data-toggle="tab"> <i class="icon-footprint mr-2"></i> Footer </a></li>                     
        </ul>
       
        <div class="tab-content">
            <div class="tab-pane fade show active" id="site">
                @include('lcms::setting.index-inc.site')            
            </div>
            <div class="tab-pane fade" id="header">
                @include('lcms::setting.index-inc.header')            
            </div>
            <div class="tab-pane fade" id="footer">
                @include('lcms::setting.index-inc.footer')            
            </div>            
        </div>
    </div>

</div>

@endsection

@section('footer')
@endsection

@push('footer')
@endpush