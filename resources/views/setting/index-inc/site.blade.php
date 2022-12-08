{{-- Site Tab --}}
<div class="tab-pane fade show active" id="organisation">

    <h4>Site</h4>
    <div class="row py-2">
        <div class="col-md-8">
            <form method="post" action="{{route('lcms_setting.update')}}" enctype="multipart/form-data">
                @csrf @method('put')

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Title : <span class="text-danger">*</span> </label>
                    <div class="col-lg-10">
                        <input name="site_title" class="form-control" type="text" value="" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Sub Title : </label>
                    <div class="col-lg-10">
                        <input name="site_sub_title" class="form-control" type="text" value="">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Logo : <span class="text-danger">*</span> </label>
                    <div class="col-lg-10">
                        <input name="site_logo" class="form-control" type="text" value="" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Logo_2 : </label>
                    <div class="col-lg-10">
                        <input name="site_logo_2" class="form-control" type="text" value="">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Favicon : <span class="text-danger">*</span> </label>
                    <div class="col-lg-10">
                        <input name="site_favicon" class="form-control" type="text" value="" required>
                    </div>
                </div>

                <div class="text-right">
                    <input type="hidden" name="action" value="site">
                    <button type="submit" class="btn btn-primary"> Update <i class="icon-paperplane ml-2"></i> </button>
                </div>

            </form>
        </div>
        <div class="col-md-3 py-3 px-3 ml-3 bg-light text-muted text-justify">                     
            <i class="icon-play4 mr-2"></i> Site (front end) relate setting.
            <br> <br>                               
        </div>
    </div>
</div>