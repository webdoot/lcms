@extends('lcms::layout')
@section('page_title', 'Media')

@push('head')

@endpush

@section('content')
<div class="card">
    <div class="card-header d-flex"> 
    	<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#file-upload-box" aria-expanded="true"> <i class="icon-file-upload me-2"></i> Upload file </button>

    	<div class="col-lg-3 ms-auto">
	    	<form action="{{route('lcms_media.index')}}" method="GET">
	    		@php $type = app('request')->input('type'); @endphp
	    		<select class="form-select" name="type" onchange="this.form.submit()">
	                <option {{$type=='all' ? 'selected' : ''}} value="all">All</option>
	                <option {{$type=='photo' ? 'selected' : ''}} value="photo">Photo</option>
	                <option {{$type=='video' ? 'selected' : ''}} value="video">Video</option>
	                <option {{$type=='pdf' ? 'selected' : ''}} value="pdf">Pdf</option>
	                <option {{$type=='doc' ? 'selected' : ''}} value="doc">Document</option>
	            </select>
	        </form>
    	</div>    	
    </div>

    <div class="collapse" id="file-upload-box">
    	<div class="card-body">
    		<p class="fw-semibold">Upload file:</p>
			<form action="{{route('lcms_media.store')}}" method="POST" class="dropzone" id="dropzone">
				@csrf
			</form>
    	</div>    	
    </div>
</div>

<div class="row">	
	@foreach($medias as $m)
	<div class="col-lg-2 col-md-3 col-4">		
		<div class="card">
			<div class="card-img-actions">
				<img class="card-img-top img-fluid" src="{{ $m->url_dsp }}" alt="{{ $m->alt }}">
				<div class="card-img-actions-overlay card-img-top">
					<a href="{{ $m->url }}" class="btn btn-outline-white btn-icon rounded-pill" data-popup="lightbox"> 
						<i class="icon-enlarge"></i>
					</a>
					<a href="#media_details_model" class="btn btn-outline-white btn-icon rounded-pill ms-2" data-bs-toggle="modal" data-id={{$m->id}}>
						<i class="icon-pencil3"></i>
					</a>
				</div>
			</div>

			<div class="text-center bg-light p-1">
				<code> {{ $m->code }} </code>
			</div>
		</div>
	</div>
	@endforeach

</div>

@endsection

@section('footer')
<div id="media_details_model" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-xl">
		<form id="media_details_form" data-id="">	
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Media details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<div class="modal-body py-0 px-2">
				<div class="row align-items-center">
					<div class="col-lg-8 text-center pt-2">
						<img src="" style="max-width: 730px; max-height: 390px">
						<p class="fw-semibold"></p>
					</div>

					<div class="col-lg-4 border-start bg-light p-3">
						<div class="row">
							<div class="col-md-5 mb-3">
								<label class="form-label d-block mb-0">Width (px) <code  class="float-end">width</code></label>
								<input type="number" class="form-control py-1 px-2" name="width" max="1920" placeholder="max:1920px">
							</div>
							<div class="col-md-5 ms-auto mb-3">
								<label class="form-label d-block mb-0">Height (px) <code  class="float-end">height</code></label>
								<input type="number" class="form-control py-1 px-2" name="height" max="1080" placeholder="max:1080px">
							</div>
						</div>

						<div class="row">
							<div class="col mb-3">
								<label class="form-label d-block mb-0">Url  <code  class="float-end">url</code> </label>

								<div class="input-group">
									<input type="text" class="form-control py-1 px-2" name="url" placeholder="Url" readonly>
									<button type="button" class="btn btn-light btn-icon" onclick="textToClipboard(this.parentNode.querySelector('[name=url]'))"> <i class="icon icon-copy2"></i> </button>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col mb-3">
								<label class="form-label d-block mb-0">Alt <code  class="float-end">alt</code> </label>
								<input type="text" class="form-control py-1 px-2" name="alt" placeholder="Alt value">
							</div>
						</div>

						<div class="row">
							<div class="col mb-3">
								<label class="form-label d-block mb-0">File Name <code  class="float-end">name</code> </label>
								<input type="text" class="form-control py-1 px-2" name="name" placeholder="Name">
							</div>
						</div>

						<div class="row">
							<div class="col">
								<label class="form-label d-block mb-0">Description <code  class="float-end">description</code> </label>
								<textarea rows="2" class="form-control py-1 px-2" name="description" placeholder="Description..."></textarea>
							</div>
						</div>
						
					</div>
				</div>

			</div>

			<div class="modal-footer">
				@csrf @method('put')
				<input type="hidden" name="action" value="media_details">
				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Update <i class="ph-paper-plane-tilt ms-2"></i></button>
			</div>
		</div>
		</form>
	</div>
</div>
@endsection

@push('footer')
<script>

	// file uploader
	$("#dropzone").dropzone({ 
		url: "{{route('lcms_media.store')}}",
		maxFiles: 10,
        paramName: "media_file", // The name that will be used to transfer the file
        dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
        maxFilesize: 2, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif, .pdf',
        success: function(file, response) {
            // location.reload(); 
            console.log(response);
        },
        error: function(file, response) {
           console.log(response);
        }
	});

	// media details model
	const mediaDetailsModel = document.getElementById('media_details_model')
	const modalTitle = mediaDetailsModel.querySelector('.modal-title')
	let mediaUrl;
	mediaDetailsModel.addEventListener('show.bs.modal', event => {
	  	// Button that triggered the modal
	  	const button = event.relatedTarget
	  	// Extract info from data-id attributes
	  	// const recipient = button.getAttribute('data-id')
	  	const recipient = button.getAttribute('data-id')

	  	let url = '{{ route('lcms_media.edit', [':id']) }}';
        mediaUrl = url.replace(':id', recipient);
        getMedia(mediaUrl);

	  	// at model hide, remove values
        mediaDetailsModel.addEventListener('hide.bs.modal', event => {
        	mediaDetailsModel.querySelector('.modal-title').innerHTML = 'Media details'
           	mediaDetailsModel.querySelector('img').src = ''
           	mediaDetailsModel.querySelector('img').removeAttribute('width')
           	mediaDetailsModel.querySelector('img').removeAttribute('height')
           	mediaDetailsModel.querySelector('img').alt = ''
        	mediaDetailsModel.querySelector('p').textContent = ''
        	mediaDetailsModel.querySelector('[name=width]').value = ''
        	mediaDetailsModel.querySelector('[name=height]').value = ''
        	mediaDetailsModel.querySelector('[name=url]').value = ''
        	mediaDetailsModel.querySelector('[name=alt]').value = ''
        	mediaDetailsModel.querySelector('[name=name]').value = ''
        	mediaDetailsModel.querySelector('[name=description]').value = ''
        })
	})

	// get media
	function getMedia(url) {
		$.ajax({
            dataType: 'json',
            url: url,
            type:'GET',
            success: function (resp) {
            	mediaDetailsModel.querySelector('form').setAttribute('data-id', resp.id)
            	mediaDetailsModel.querySelector('.modal-title').innerHTML = 'Media details &nbsp; <code class="fw-semibold">'+ resp.code +'</code>'
            	mediaDetailsModel.querySelector('img').src = resp.url
            	if (resp.width!=null) {
            		if (resp.width > 730) {
            			mediaDetailsModel.querySelector('img').width = 730
            		}
            		else {
            			mediaDetailsModel.querySelector('img').width = resp.width
            		}
            	}
            	
            	if (resp.height!=null) {
            		if (resp.height > 390) {
            			mediaDetailsModel.querySelector('img').height = 390
            		}
            		else {
            			mediaDetailsModel.querySelector('img').height = resp.height
            		}            		
            	}            	
            	mediaDetailsModel.querySelector('img').alt = resp.alt
            	mediaDetailsModel.querySelector('p').textContent = resp.name
            	mediaDetailsModel.querySelector('[name=width]').value = resp.width
            	mediaDetailsModel.querySelector('[name=height]').value = resp.height
            	mediaDetailsModel.querySelector('[name=url]').value = resp.url
            	mediaDetailsModel.querySelector('[name=alt]').value = resp.alt
            	mediaDetailsModel.querySelector('[name=name]').value = resp.name
            	mediaDetailsModel.querySelector('[name=description]').value = resp.description
            }
        })
	}

	// copy to clipboard
	function textToClipboard(inputBox){		
	  	inputBox.select()	// select the text field
	  	inputBox.setSelectionRange(0, 99999)	// For mobile devices
	   	// copy the text inside the text field
	  	navigator.clipboard.writeText(inputBox.value);
	}

	// submit media details form
	$('#media_details_form').submit(function(e){
		e.preventDefault();
		var url = '{{ route('lcms_media.update', [':id']) }}';
        url = url.replace(':id', this.getAttribute('data-id'));
	  	$.ajax({
            url: url,
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:new FormData(this),
            success: function (resp) {            	
        		new Noty({
		            text: resp.success,
		            type: 'success',
		            theme: 'limitless',
		            timeout: 2500
		        }).show();
            	
            	getMedia(mediaUrl);
            }
        })
	})
	
	

</script>
@endpush