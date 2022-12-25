@extends('lcms::layout')
@section('page_title', 'Article')

@push('head')
@endpush

@section('content')

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h5 class="mb-0">List</h5>
        @if(Lcms::isAdmin())
        <a class="btn btn-sm btn-outline-primary d-inline-flex ms-auto" href="{{route('lcms_article.create')}}"> <i class="icon-plus2 me-2"></i> Add </a>
        @endif
    </div>

    <div class="table-responsive mb-3">
		<table class="table datatable">
			<thead>
				<tr>
					<th width="80">#</th>
					<th width="25%">Title</th>
					<th>Content</th>
					<th>Images</th>
					<th>Ref. Code</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($articles as $a)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>
						<a href="{{ route('lcms_article.show', $a->id) }}">
							<span class="fw-semibold d-block">{{$a->title_dsp}}</span>
							<span class="fst-italic text-muted d-block">{{$a->sub_title}}</span>
							<span class="fst-italic text-muted d-block">{{$a->label}}</span>
						</a>
					</td>
					<td>
						<span class="d-block">{!! $a->content_dsp !!}</span>
						<span class="fst-italic text-muted d-block">{!! $a->sub_content_dsp !!}</span>
					</td>
					<td>
						@foreach($a->media as $m)
						<img src="{{$m}}" class="border rounded" width="30">
						@endforeach
					</td>
					<td> <code>{{$a->code}}</code> </td>
					<td class="d-flex"> 
						{{--EDIT--}}                        
                        <a href="{{ route('lcms_article.edit', $a->id) }}" class="btn btn-icon btn-outline-success d-inline-flex me-2"><i class="icon-pencil"></i> </a>

                        {{--DELETE--}} 
                        <a id="{{ $a->id }}" onclick="confirmDelete(this.id)" href="#" class="btn btn-icon btn-outline-danger d-inline-flex"><i class="icon-trash"></i> </a>
                        <form method="post" id="item-delete-{{ $a->id }}" action="{{ route('lcms_article.destroy', $a->id) }}" class="hidden">@csrf @method('delete')</form>                       
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
	$.extend( $.fn.dataTable.defaults, { columnDefs: [{ orderable: false, width: 100, targets: [ 4, 5 ] }] });

	// Data table
	$('.datatable').DataTable();

</script>
@endpush