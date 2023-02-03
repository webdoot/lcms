<div class="row py-4 g-4">
    <div class="col-lg-8">
        <form method="post" action="{{route('lcms_setting.update')}}">
            @csrf @method('put')

            <div class="addrWrap mb-3">
                
                @foreach(Webdoot\Lcms\Models\Setting::getJson('site_contact') as $contact)
                <div class="row p-3 bg-light">
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label">Title : </label>
                            <div class="col-md-10">
                                <input name="contact[1][title]" class="form-control" type="text" placeholder="Title" value="{{$contact['title']}}">
                                <code class="float-end">contact[]['title']</code>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label">Phone : </label>
                            <div class="col-md-4">
                                <input name="contact[1][phone]" class="form-control" type="text" placeholder="Phone" value="{{$contact['phone']}}" >
                                <code class="float-end">contact[]['phone']</code>
                            </div>

                            <label class="col-md-2 col-form-label">Email : </label>
                            <div class="col-md-4">
                                <input name="contact[1][email]" class="form-control" type="email" placeholder="Email" value="{{$contact['email']}}">
                                <code class="float-end">contact[]['email']</code>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-2 col-form-label">Address : </label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="contact[1][address]" placeholder="Enter address here...">{{$contact['address']}}</textarea>
                                <code class="float-end">contact[]['address']</code>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach               

            </div>                

            <div>
                <input type="hidden" name="action" value="address">
                <button type="button" id="addContact" class="btn btn-sm btn-outline-secondary float-start"><i class="icon-plus3 me-2"></i> Add more contacts... </button>
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