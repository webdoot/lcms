@extends('lcms::layout')
@section('page_title', 'Gallery')

@push('head')
@endpush

@section('content')


<div class="card">
    <div class="card-header d-flex align-items-center">
        <h5 class="mb-0">View &nbsp; <code>{{$gallery->code}}</code></h5>
        <a class="btn btn-sm btn-outline-primary d-inline-flex ms-auto" href="{{route('lcms_gallery.edit', $gallery->id)}}"> <i class="icon-pencil me-2"></i> Edit </a>
    </div>

    <div class="card-body pb-5">
    	<table class="table table-striped">
			<thead>
				<tr>
					<th width="80">#</th>
					<th>Media</th>
					<th>Name</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				@if(isset($gallery->content_json) && $gallery->content_json)
				@foreach($gallery->content_json as $g) 
				<tr>
					<td>{{$loop->iteration}}</td>
					<td><img src="{{$g->image}}" class="border" width="120"></td>
					<td> <span class="fw-semibold d-block">{{$g->name}}</span> </td>
					<td> {{$g->description}} </td>
				</tr>
				@endforeach		
				@endif						
			</tbody>
		</table>
    	
    </div>
</div>

@endsection

@section('footer')
@endsection

@push('footer')
@endpush