@extends('lcms::layout')
@section('page_title', 'Tags')

@push('head')
@endpush

@section('content')

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h5 class="mb-0">List</h5>
        <a class="btn btn-sm btn-outline-primary d-inline-flex ms-auto" href="{{route('lcms_tag.create')}}"> <i class="icon-plus2 me-2"></i> Add </a>
    </div>

    <div class="table-responsive mb-3">
		<table class="table datatable">
			<thead>
				<tr>
					<th width="80">#</th>
					<th>Name</th>
					<th>Description</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($tags as $t)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>
						<a href="{{ route('lcms_tag.show', $t->id) }}">
							<span class="fw-semibold d-block">{{$t->name}}</span>
						</a>
					</td>
					<td>
						<span class="d-block">{{ $t->description }}</span>
					</td>
					<td class="d-flex"> 
						{{--EDIT--}}                        
                        <a href="{{ route('lcms_tag.edit', $t->id) }}" class="btn btn-icon btn-outline-success d-inline-flex me-2"><i class="icon-pencil"></i> </a>

                        {{--DELETE--}} 
                        <a id="{{ $t->id }}" onclick="confirmDelete(this.id)" href="#" class="btn btn-icon btn-outline-danger d-inline-flex"><i class="icon-trash"></i> </a>
                        <form method="post" id="item-delete-{{ $t->id }}" action="{{ route('lcms_tag.destroy', $t->id) }}" class="hidden">@csrf @method('delete')</form>                       
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
	$.extend( $.fn.dataTable.defaults, { columnDefs: [{ orderable: false, width: 100, targets: [ 3 ] }] });

	// Data table
	$('.datatable').DataTable();

</script>
@endpush