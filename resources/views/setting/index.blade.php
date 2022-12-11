@extends('lcms::layout')
@section('page_title', 'Settings')

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
        <h6 class="card-title font-weight-semibold "> Site </h6>
    </div>

    <div class="card-body">
        <div class="row py-2">
            <div class="col-md-8">
                <form method="post" action="{{route('lcms_setting.update')}}" enctype="multipart/form-data">
                    @csrf @method('put')

                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Title : <span class="text-danger">*</span> </label>
                        <div class="col-lg-10">
                            <input name="site_title" class="form-control" type="text" value="{{Lcms::get('site_title')}}" required>
                            <code class="text-right">site_title</code>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Sub Title : </label>
                        <div class="col-lg-10">
                            <input name="site_sub_title" class="form-control" type="text" value="{{Lcms::get('site_sub_title')}}">
                            <code class="text-right">site_sub_title</code>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Logo : <span class="text-danger">*</span> </label>
                        <div class="col-lg-10">
                            <input name="site_logo" class="form-control" type="text" value="{{Lcms::get('site_logo')}}" required>
                            <code class="text-right">site_logo</code>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Logo_2 : </label>
                        <div class="col-lg-10">
                            <input name="site_logo_2" class="form-control" type="text" value="{{Lcms::get('site_logo_2')}}">
                            <code class="text-right">site_logo_2</code>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Favicon : <span class="text-danger">*</span> </label>
                        <div class="col-lg-10">
                            <input name="site_favicon" class="form-control" type="text" value="{{Lcms::get('site_favicon')}}" required>
                            <code class="text-right">site_favicon</code>
                        </div>
                    </div>

                    <div class="text-right">
                        <input type="hidden" name="action" value="site">
                        <button type="submit" class="btn btn-primary"> Update <i class="icon-paperplane ml-2"></i> </button>
                    </div>

                </form>
            </div>
            <div class="col-md-3 py-3 px-3 ml-3 bg-light text-muted text-justify">                     
                <i class="icon-play4 mr-2"></i> Site front end setting variables.
                <br> <br> 
                <i class="icon-play4 mr-2"></i> Usage: Copy field corresponding <b>code</b>.
                <br> <br>  
                <i class="icon-play4 mr-2"></i> Display Blade file: <b>Lcms::get("code")</b> 
                <br> <br>                               
            </div>
        </div>

    </div>

</div>

@endsection

@section('footer')
@endsection

@push('footer')
@endpush