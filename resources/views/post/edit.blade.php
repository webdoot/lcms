@extends('lcms::layout')
@section('page_title', 'Post')

@push('head')
<style>
	.media-selected {
		border: 3px solid #0c83ff;
	}
</style>
@endpush

@section('content')

<form method="post" action="{{route('lcms_post.update', $post->id)}}" enctype="multipart/form-data">
@csrf @method('put')
<div class="row">	
	<div class="col-md-9">
		<div class="card">
			<div class="card-header d-flex align-items-center">
		        <h5 class="mb-0"> Edit &nbsp; <code>{{$post->code}}</code></h5>

		        <div class="d-inline-flex ms-auto">
					<a class="text-body" data-card-action="collapse"> More fields
						<i class="icon-arrow-down32"></i>
					</a>
				</div>
		    </div>

		    <div class="collapse bg-light border-bottom">
		    	<div class="m-3">					
					<label class="form-check form-check-inline">
						<input type="checkbox" class="form-check-input" onclick="toggle_div_fun('sub_title');" @if($post->sub_title) checked @endif>
						<span class="form-check-label">Sub Title</span>
					</label>

					<label class="form-check form-check-inline">
						<input type="checkbox" class="form-check-input" onclick="toggle_div_fun('meta');" @if($post->meta) checked @endif>
						<span class="form-check-label">meta</span>
					</label>									
				</div>					
			</div>

		    <div class="card-body"> 
		    	<div class="my-3">
					<label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
					<code class="float-end">title</code>
					<input type="text" class="form-control" name="title" value="{{$post->title}}" placeholder="Enter title..." required>
				</div>

				<div class="mb-3" id="sub_title" style="display: @if(!$post->sub_title) none @endif">
					<label class="form-label fw-semibold">Sub Title</label>
					<code class="float-end">sub_title</code>
					<input type="text" class="form-control" name="sub_title" value="{{$post->sub_title}}" placeholder="Enter sub title...">
				</div>

		    	<div class="mb-3">
					<label class="form-label fw-semibold">Content</label>
					<code class="float-end">content</code>
					<textarea id="editor" class="form-control" name="content" placeholder="Enter content here...">{!! $post->content !!}</textarea>
				</div>

				<div class="mb-3">
					<label class="form-label fw-semibold">Media</label>
					<span id="addMedia" class="bg-light rounded ms-3 px-2 py-1 text-primary cursor-pointer"> Add new <i class="icon-arrow-right5"></i> </span>
					<code class="float-end">media</code>
					<div class="row border rounded mx-1 py-2 gx-4" id="attach-media-box"> 
						@foreach($post->media as $val)
						<div class="col-lg-2 col-md-3 col-4"> 
							<img src="{{$val}}" class="img-fluid media-inserted"> 
							<button type="button" class="btn btn-outline-danger btn-icon rounded-pill position-absolute rem-make-media-btn p-0" onclick="removeMedia(this);"> <i class="icon-cross3"></i> </button> 
							<input type="hidden" name="media[]" value="{{$val}}"> 
						</div>
						@endforeach
					</div>
				</div>

				<div class="mb-3 addBox" id="meta" style="display: @if(!$post->meta) none @endif">
					<label class="form-label fw-semibold">Meta</label>
					<span id="addMeta" class="bg-light rounded ms-3 px-2 py-1 text-primary cursor-pointer"> Add new <i class="icon-arrow-right5"></i> </span>
					<code class="float-end">meta</code>

					<div class="addWrap">
						@if($post->meta)
						@foreach($post->meta as $key => $val)
						<div class="row mb-2">
							<div class="col-lg-5">
								<input type="text" class="form-control" name="meta_keys[]" value="{{$key}}" placeholder="Key" required>
							</div>
							<div class="col-lg-6">
								<input type="text" class="form-control" name="meta_vals[]" value="{{$val}}" placeholder="Value" required>
							</div>
							<div class="col-lg-1 text-end">
			                    <button type="button" class="btn btn-outline-danger btn-sm mt-1 rembtn"><i class="icon-minus3"></i></button>
			                </div>
						</div>
						@endforeach
						@endif
					</div> 
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
		    <div class="card-body"> 
		    	<div class="mb-3">
					<label class="form-label fw-semibold">Category</label>
					<code class="float-end">sub_title</code>
					<select name="category_id" class="form-select select" data-placeholder="Select a category...">
						@foreach($categories as $c)
                        <option value="{{$c->id}}" {{$c->id==$post->category_id ? 'selected' : ''}}>{{$c->name}}</option>
                        @endforeach
                    </select>
				</div>
			</div>
		</div>

		<div class="card">
		    <div class="card-header">
		        <h5 class="mb-0"> Publish </h5>
		    </div>    

		    <div class="card-body"> 
		    	<div class="mb-3"> Published at: <span class="fw-semibold fst-italic"> {{$post->published_at_dsp}} </span> </div>   	   	
		    	<input type="hidden" name="action" value="post">
                <button type="submit" class="btn btn-sm btn-primary"> Update <i class="icon-paperplane ms-2"></i> </button> 	
		    </div>
		</div>
	</div>	
</div>
</form>

@endsection

@section('footer')
	@include('lcms::post.__media-model')
@endsection

@push('footer')
<script>
	// ck editor
    ClassicEditor
        .create( document.querySelector( '#editor' ) );
        // .catch( error => {
        //     console.error( error );
        // } );

    // toggle div
	function toggle_div_fun(id) {
	  var divelement = document.getElementById(id);
	  if(divelement.style.display == 'none')
	    divelement.style.display = 'block';
	  else
	    divelement.style.display = 'none';
	}

	// select2
	$('.select').select2();

	// add meta
	var i = 100;
    $('#addMeta').click(function(e){
        i++;         
        var html = '';
        html += '<div class="row mb-2">';
        html += '<div class="col-lg-5">	<input type="text" class="form-control" name="meta_keys[]" placeholder="Key" required> </div>';
        html += '<div class="col-lg-6"> <input type="text" class="form-control" name="meta_vals[]" placeholder="Value" required> </div>';
        html += '<div class="col-lg-1 text-end"> <button type="button" class="btn btn-outline-danger btn-sm mt-1 rembtn"><i class="icon-minus3"></i></button> </div>';
        html += '</div>';

        $(this).parents('.addBox').find('.addWrap').append(html);

    });

	// remove field
    $('.addWrap').on("click",".rembtn", function(e){ 
        e.preventDefault(); 
        $(this).parent('div').parent('div.row').remove();
    });

    // add media
    const mediaModal = new bootstrap.Modal('#media-model', {focus: true});
    let mediaArr = {!! json_encode($post->media) !!} ;

    $('#addMedia').click(function(e){    	
    	mediaModal.show();
    	let mediaSelectable = $('.media-selectable');
    	mediaSelectable.removeClass("media-selected");
    	$.each(mediaSelectable, function(key, val){
    		let src = $(val).attr('src');
    		if ($.inArray(src, mediaArr) !== -1) {
    			$(val).addClass("media-selected");
    		}
		});
    });

    // on click add or remove media
	$('.media-selectable').click(function(){
		$(this).toggleClass("media-selected");

		let imgSrc = $(this).attr('src'); 
		
		if($(this).hasClass('media-selected')) {
			mediaArr.push(imgSrc);
		}
		else {
			mediaArr = $.grep(mediaArr, function(value) {
			  return value != imgSrc;
			});
		}
	})

	// insert
    $('#insert-media-btn').click(function(e){
    	$('#attach-media-box').html('');
		$.each(mediaArr, function(key, val){
			makeMedia(val);				
		});		
		mediaModal.hide();
	})

    // after media removal, remove url 
	function removeMedia(btn) {
		let imgSrc = $(btn).siblings("img").attr("src");
		mediaArr = $.grep(mediaArr, function(value) {
			return value != imgSrc;
		});
		$(btn).parent().remove();
	}

    // html
    function makeMedia(url){
    	let html = '<div class="col-lg-2 col-md-3 col-4"> <img src="'+ url +'" class="img-fluid media-inserted"> <button type="button" class="btn btn-outline-danger btn-icon rounded-pill position-absolute rem-make-media-btn p-0" onclick="removeMedia(this);"> <i class="icon-cross3"></i> </button> <input type="hidden" name="media[]" value="'+ url +'"> </div>' ;
    	$('#attach-media-box').append(html); 
    }

</script>
@endpush