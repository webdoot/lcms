@extends('lcms::layout')
@section('page_title', 'Menu')

@push('head')
@endpush

@section('content')


<div class="card">
    <div class="card-header d-flex align-items-center">
        <h5 class="mb-0">View &nbsp; <code>{{$menu->code}}</code></h5>
        <a class="btn btn-sm btn-outline-primary d-inline-flex ms-auto" href="{{route('lcms_menu.edit', $menu->id)}}"> <i class="icon-pencil me-2"></i> Edit </a>
    </div>

    <div class="card-body pb-5">
    	<table class="table table-striped">
			<thead>
				<tr>
					<th width="80">#</th>
					<th>Menu Item</th>
					<th>Sub Menu Items</th>
				</tr>
			</thead>
			<tbody>
				@foreach($menu->content_json as $m) 
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>
						<a href="/{{ $m->url }}" target="_blank">
							<span class="fw-semibold d-block">{{$m->name}}</span>
						</a>
					</td>
					<td>
						@if($m->items && count($m->items))
						@foreach($m->items as $s)
						<a href="/{{$s->url}}" class="d-block" target="_blank"> {{$s->name}} </a>
						@endforeach
						@endif
					</td>
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