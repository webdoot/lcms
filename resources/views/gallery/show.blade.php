@extends('lcms::layout')
@section('page_title', 'Slider')

@push('head')
@endpush

@section('content')


<div class="card">
    <div class="card-header d-flex align-items-center">
        <h5 class="mb-0">View &nbsp; <code>{{$slide->code}}</code></h5>
        <a class="btn btn-sm btn-outline-primary d-inline-flex ms-auto" href="{{route('lcms_slider.edit', $slide->id)}}"> <i class="icon-pencil me-2"></i> Edit </a>
    </div>

    <div class="card-body pb-5">
    	<table class="table table-striped">
			<thead>
				<tr>
					<th width="80">#</th>
					<th>Media</th>
					<th>Name</th>
					<th>Description</th>
					<th>Link url</th>
				</tr>
			</thead>
			<tbody>
				@foreach($slide->content_json as $s) 
				<tr>
					<td>{{$loop->iteration}}</td>
					<td><img src="{{$s->image}}" class="border" width="120"></td>
					<td> <span class="fw-semibold d-block">{{$s->name}}</span> </td>
					<td> {{$s->description}} </td>
					<td> {{$s->url}} </td>
				</tr>
				@endforeach								
			</tbody>
		</table>
    	
    </div>
</div>

@endsection

@section('footer')
@endsection

@push('footer')
@endpush