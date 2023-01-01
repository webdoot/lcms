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
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">File details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<div class="modal-body py-0 px-2">
				<div class="row">
					<div class="col-lg-7 border p-3">
						Edit window
					</div>

					<div class="col-lg-5 border bg-light p-3">
						<div class="row">
							<div class="col-md-5 mb-3">
								<label class="form-label">Width (px)</label>
								<input type="number" class="form-control" max="1600" placeholder="px">
							</div>
							<div class="col-md-5 ms-auto mb-3">
								<label class="form-label">Height (px)</label>
								<input type="number" class="form-control" max="900" placeholder="px">
							</div>
						</div>

						<div class="row">
							<div class="col mb-3">
								<label class="form-label">Alt</label>
								<input type="text" class="form-control" placeholder="Alt value">
							</div>
						</div>

						<div class="row">
							<div class="col mb-3">
								<label class="form-label">Title</label>
								<input type="text" class="form-control" placeholder="Title value">
							</div>
						</div>

						<div class="row">
							<div class="col">
								<label class="form-label">Description</label>
								<textarea rows="2" class="form-control" placeholder="Description..."></textarea>
							</div>
						</div>
						
					</div>
				</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Update <i class="ph-paper-plane-tilt ms-2"></i></button>
			</div>
		</div>
	</div>
</div>

<div id="media_edit_model" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Image editor</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<div class="modal-body py-0 px-2">
				
				<div id="editor_container"></div>

			</div>			
		</div>
	</div>
</div>
@endsection

@push('footer')
// Image editor plugin
<script src="{{ asset('vendor/lcms/js/image-editor/filerobot-image-editor.min.js') }}"></script>
<script src="{{ asset('vendor/lcms/js/image-editor/filerobot-config.js') }}"></script>

<script>

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

	const mediaDetailsModel = document.getElementById('media_details_model')
	mediaDetailsModel.addEventListener('show.bs.modal', event => {
	  	// Button that triggered the modal
	  	const button = event.relatedTarget
	  	// Extract info from data-bs-* attributes
	  	const recipient = button.getAttribute('data-id')

	  	var url = '{{ route('lcms_media.edit', [':id']) }}';
        url = url.replace(':id', recipient);
	  	$.ajax({
            dataType: 'json',
            url: url,
            type:'GET',
            success: function (resp) {

            	console.log(resp);

                // section_output.empty();
                // $.each(resp, function (i, data) {
                //     section_output.append($('<option>', {
                //         value: data.id,
                //         text: data.name
                //     }));
                // });
            }
        })
	  

	  	const modalTitle = mediaDetailsModel.querySelector('.modal-title')
	  	const modalBodyInput = mediaDetailsModel.querySelector('.modal-body input')

	  	modalTitle.textContent = `New message to ${recipient}`
	  	modalBodyInput.value = recipient
	})


	
	

</script>
@endpush