<div class="row py-4 g-4">
    <div class="col-lg-8">
        <form method="post" action="{{route('lcms_setting.update')}}" enctype="multipart/form-data">
            @csrf @method('put')

            <div class="row mb-3">
                <label class="col-lg-2 col-form-label">Title : <span class="text-danger">*</span> </label>
                <div class="col-lg-10">
                    <input name="site_title" class="form-control" type="text" value="{{Lcms::get('site_title')}}" placeholder="Site title" required>
                    <code class="float-end">site_title</code>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-lg-2 col-form-label">Sub Title : </label>
                <div class="col-lg-10">
                    <input name="site_sub_title" class="form-control" type="text" value="{{Lcms::get('site_sub_title')}}" placeholder="Site sub title">
                    <code class="float-end">site_sub_title</code>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-lg-2 col-form-label">Logo : <span class="text-danger">*</span> </label>
                <div class="col-lg-10">
                    <input name="site_logo" class="form-control" type="text" value="{{Lcms::get('site_logo')}}" placeholder="Site logo url" required>
                    <code class="float-end">site_logo</code>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-lg-2 col-form-label">Logo2 : </label>
                <div class="col-lg-10">
                    <input name="site_logo2" class="form-control" type="text" value="{{Lcms::get('site_logo2')}}" placeholder="Site logo2 url">
                    <code class="float-end">site_logo2</code>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-lg-2 col-form-label">Favicon : <span class="text-danger">*</span> </label>
                <div class="col-lg-10">
                    <input name="site_favicon" class="form-control" type="text" value="{{Lcms::get('site_favicon')}}" placeholder="Site favicon" required>
                    <code class="float-end">site_favicon</code>
                </div>
            </div>

            <div>
                <input type="hidden" name="action" value="site">
                <button type="submit" class="btn btn-sm btn-primary float-end"> Update <i class="icon-paperplane ms-2"></i> </button>
            </div>

        </form>
    </div>

    <div class="col-lg-3 p-3 bg-light text-muted ms-auto me-auto">
        <i class="icon-play4 mr-2"></i> Site front end setting variables.
        <br> <br> 
        <i class="icon-play4 mr-2"></i> Usage: Copy field corresponding <b>code</b>.
        <br> <br>  
        <i class="icon-play4 mr-2"></i> Display Blade file: <b>Lcms::get("code")</b>     
    </div>
</div>