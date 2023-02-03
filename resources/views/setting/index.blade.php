@extends('lcms::layout')
@section('page_title', 'Settings')

@push('head')
@endpush

@section('content')

<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item">
                <a href="#tab-1" class="nav-link active" data-bs-toggle="tab"> <h6 class="mb-0"> Site </h6> </a>
            </li>
            <li class="nav-item">
                <a href="#tab-2" class="nav-link" data-bs-toggle="tab"> <h6 class="mb-0"> Address </h6> </a>
            </li>                   
        </ul>


        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-1">
                @include('lcms::setting.index-inc.tab-1')
            </div>

            <div class="tab-pane fade" id="tab-2">
                @include('lcms::setting.index-inc.tab-2')
            </div>
        </div>

    </div>

</div>

@endsection

@section('footer')
@endsection

@push('footer')
<script>
    // add meta
    var i = 100;
    $('#addContact').click(function(e){
        i++;         
        var html = '';
        html += '<div class="row p-3 bg-light mt-3">';
        html += '<div class="col-md-11">';
        html += '<div class="row mb-3"> <label class="col-md-2 col-form-label">Title : </label> <div class="col-md-10"> <input name="contact['+ i +'][title]" class="form-control" type="text" placeholder="Title" > </div> </div>';
        html += '<div class="row mb-3"> <label class="col-md-2 col-form-label">Phone : </label> <div class="col-md-4"> <input name="contact['+ i +'][phone]" class="form-control" type="text" placeholder="Phone" > </div> <label class="col-md-2 col-form-label">Email : </label> <div class="col-md-4"> <input name="contact['+ i +'][email]" class="form-control" type="email" placeholder="Email"> </div> </div>';
        html += '<div class="row"> <label class="col-md-2 col-form-label">Address : </label> <div class="col-md-10"> <textarea class="form-control" name="contact['+ i +'][address]" placeholder="Enter address here..."></textarea> </div> </div>';
        html += '</div>';
        html += '<div class="col-md-1 text-end"> <span class="icon-cross2 btn btn-icon btn-outline-danger rembtn"></span> </div>';
        html += '</div>';

        $(this).parents('form').find('.addrWrap').append(html);

    });

    // remove field
    $('.addrWrap').on("click",".rembtn", function(e){ 
        e.preventDefault(); 
        $(this).parent('div').parent('div.row').remove();
    });

</script>
@endpush