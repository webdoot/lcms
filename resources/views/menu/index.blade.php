@extends('lcms::layout')
@section('page_title', 'Menu')

@push('head')
@endpush

@section('content')

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h5 class="mb-0">List</h5>
        @if(Lcms::isAdmin())
        <a class="btn btn-sm btn-outline-primary d-inline-flex ms-auto" href="{{route('lcms_menu.create')}}"> <i class="icon-plus2 me-2"></i> Add </a>
        @endif
    </div>

    <div class="table-responsive mb-3">
		<table class="table datatable">
			<thead>
				<tr>
					<th width="80">#</th>
					<th>Title</th>
					<th>Items</th>
					<th>Code</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($menus as $m) 
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>
						<a href="{{ route('lcms_menu.show', $m->id) }}">
							<span class="fw-semibold d-block">{{$m->title}}</span>
						</a>
					</td>
					<td>
						<span class="d-block">{{$m->content_json ? implode(', ', array_column($m->content_json, 'name')) : '' }}</span>
					</td>
					<td> <code>{{$m->code}}</code> </td>
					<td class="d-flex"> 
						{{--EDIT--}}                        
                        <a href="{{ route('lcms_menu.edit', $m->id) }}" class="btn btn-icon btn-outline-success d-inline-flex me-2"><i class="icon-pencil"></i> </a>

                        {{--DELETE--}} 
                        <a id="{{ $m->id }}" onclick="confirmDelete(this.id)" href="#" class="btn btn-icon btn-outline-danger d-inline-flex"><i class="icon-trash"></i> </a>
                        <form method="post" id="item-delete-{{ $m->id }}" action="{{ route('lcms_menu.destroy', $m->id) }}" class="hidden">@csrf @method('delete')</form>                       
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
<script>
	// Datatable setting defaults
	$.extend( $.fn.dataTable.defaults, { columnDefs: [{ orderable: false, width: 100, targets: [ 3, 4 ] }] });

	// Data table
	$('.datatable').DataTable();

</script>
@endpush