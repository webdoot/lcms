@extends('lcms::layout')
@section('page_title', 'Tags')

@push('head')
<style>
	.media-selected {
		border: 3px solid #0c83ff;
	}
</style>
@endpush

@section('content')

<form method="post" action="{{route('lcms_tag.update', $tag->id)}}" >
@csrf @method('put')
<div class="row">	
	<div class="col-md-9">
		<div class="card">
			<div class="card-header d-flex align-items-center">
		        <h5 class="mb-0"> Edit </h5>
		    </div>

		    <div class="card-body"> 
		    	<div class="my-3">
					<label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
					<code class="float-end">name</code>
					<input type="text" class="form-control" name="name" value="{{$tag->name}}" placeholder="Name..." required>
				</div>

		    	<div class="mb-3">
					<label class="form-label fw-semibold">Description</label>
					<code class="float-end">description</code>
					<textarea class="form-control" name="description" placeholder="Description here...">{{$tag->description}}</textarea>
				</div>
			</div>

			<div class="card-footer"> 		    	   	
		    	<input type="hidden" name="action" value="tag">
                <button type="submit" class="btn btn-sm btn-primary float-end"> Update <i class="icon-paperplane ms-2"></i> </button> 	
		    </div>
		</div>
	</div>
		
</div>
</form>

@endsection

@section('footer')
@endsection

@push('footer')
@endpush