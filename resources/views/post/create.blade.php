@extends('lcms::layout')
@section('page_title', 'Article')

@push('head')
@endpush

@section('content')

<form method="post" action="{{route('lcms_article.store')}}" enctype="multipart/form-data">
@csrf @method('post')
<div class="row">	
	<div class="col-md-9">
		<div class="card">
			<div class="card-header d-flex align-items-center">
		        <h5 class="mb-0"> Add </h5>

		        <div class="d-inline-flex ms-auto">
					<a class="text-body" data-card-action="collapse"> More fields
						<i class="icon-arrow-down32"></i>
					</a>
				</div>
		    </div>

		    <div class="collapse bg-light border-bottom">
		    	<div class="m-3">					
					<label class="form-check form-check-inline">
						<input type="checkbox" class="form-check-input" onclick="toggle_div_fun('sub_title');">
						<span class="form-check-label">Sub Title</span>
					</label>

					<label class="form-check form-check-inline">
						<input type="checkbox" class="form-check-input" onclick="toggle_div_fun('label');">
						<span class="form-check-label">Label</span>
					</label>

					<label class="form-check form-check-inline">
						<input type="checkbox" class="form-check-input" onclick="toggle_div_fun('sub_content');">
						<span class="form-check-label">Sub Content</span>
					</label>

					<label class="form-check form-check-inline">
						<input type="checkbox" class="form-check-input" onclick="toggle_div_fun('metas');">
						<span class="form-check-label">Metas</span>
					</label>									
				</div>					
			</div>

		    <div class="card-body"> 
		    	<div class="my-3">
					<label class="form-label fw-semibold">Title</label>
					<code class="float-end">title</code>
					<input type="text" class="form-control" name="title" placeholder="Enter title...">
				</div>

				<div class="mb-3" id="sub_title" style="display: none">
					<label class="form-label fw-semibold">Sub Title</label>
					<code class="float-end">sub_title</code>
					<input type="text" class="form-control" name="sub_title" placeholder="Enter sub title...">
				</div>

				<div class="mb-3" id="label" style="display: none"> 
					<label class="form-label fw-semibold">Label</label>
					<code class="float-end">label</code>
					<input type="text" class="form-control" name="label" placeholder="Enter label...">
				</div>

		    	<div class="mb-3">
					<label class="form-label fw-semibold">Content</label>
					<code class="float-end">content</code>
					<textarea id="editor" class="form-control" name="content" placeholder="Enter content here..."></textarea>
				</div>

				<div class="mb-3" id="sub_content" style="display: none">
					<label class="form-label fw-semibold">Sub Content</label>
					<code class="float-end">sub_content</code>
					<textarea id="editor2" class="form-control" name="sub_content" placeholder="Enter sub content here..."></textarea>
				</div>

				<div class="mb-3">
					<label class="form-label fw-semibold">Images</label>
					<code class="float-end">images</code>
					<input type="file" class="file-input-preview" data-show-remove="true">
				</div>

				<div class="mb-3 addBox" id="metas" style="display: none">

					<label class="form-label fw-semibold">Metas</label>
					<span id="addMeta" class="bg-light ms-3 text-primary cursor-pointer"> Add new <i class="icon-arrow-right5"></i> </span>
					<code class="float-end">metas</code>

					<div class="addWrap">
						<div class="row mb-2">
							<div class="col-lg-5">
								<input type="text" class="form-control" name="meta_keys[]" placeholder="Key" >
							</div>
							<div class="col-lg-6">
								<input type="text" class="form-control" name="meta_vals[]" placeholder="Value" >
							</div>
							<div class="col-lg-1 text-end">
			                    <button type="button" class="btn btn-outline-danger btn-sm mt-1 rembtn"><i class="icon-minus3"></i></button>
			                </div>
						</div>
					</div> 
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
		    <div class="card-header">
		        <h5 class="mb-0"> Publish </h5>
		    </div>

		    <div class="card-body"> 
		    	<div class="mb-2"> Status: <span class="fw-semibold"> Status </span> </div>
		    	<div class="mb-3"> Publish: <span class="fw-semibold"> Status </span> </div>
		    	   	
		    	<input type="hidden" name="action" value="article">
                <button type="submit" class="btn btn-sm btn-primary"> Save <i class="icon-paperplane ms-2"></i> </button> 		    			    	
		    </div>
		</div>

		<div class="card">
		    <div class="card-body"> 
		    	<div class="mb-3">
					<label class="form-label">Category</label>
					<select name="category" class="form-select select" multiple="multiple" data-placeholder="Select a category...">
                        <option value="opt1" selected>Uncategories</option>
                        <option value="opt2">Option 2</option>
                        <option value="opt3">Option 3</option>
                        <option value="opt4">Option 4</option>
                    </select>
				</div>
				<div class="mb-3">
					<label class="form-label">Tags</label>
					<select name="tags" class="form-select select" multiple="multiple" data-placeholder="Enter tags...">
                        <option value="opt1">Uncategories</option>
                        <option value="opt2">Option 2</option>
                        <option value="opt3">Option 3</option>
                        <option value="opt4">Option 4</option>
                    </select>
				</div>
			</div>
		</div>
	</div>	
</div>
</form>

@endsection

@section('footer')
@endsection

@push('footer')
<script>
	// ck editor
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#editor2' ) )
        .catch( error => {
            console.error( error );
        } );

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
    })

    

</script>
@endpush