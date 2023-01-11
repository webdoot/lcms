@extends('lcms::layout')
@section('page_title', 'Post')

@push('head')
@endpush

@section('content')

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h5 class="mb-0">List</h5>
        @if(Lcms::isAdmin())
        <a class="btn btn-sm btn-outline-primary d-inline-flex ms-auto" href="{{route('lcms_post.create')}}"> <i class="icon-plus2 me-2"></i> Add </a>
        @endif
    </div>

    <div class="table-responsive mb-3">
		<table class="table datatable">
			<thead>
				<tr>
					<th width="80">#</th>
					<th width="25%">Title</th>
					<th>Content</th>
					<th>Taxonomy</th>
					<th>Images</th>
					<th>Code</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@if(isset($posts) && count($posts))
				@foreach($posts as $p)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>
						<a href="{{ route('lcms_post.show', $p->id) }}">
							<span class="fw-semibold d-block">{{$p->title_dsp}}</span>
							<span class="fst-italic text-muted d-block">{{$p->sub_title_dsp}}</span>
							<span class="fst-italic text-muted d-block">{{$p->label_dsp}}</span>
						</a>
					</td>
					<td>
						<span class="d-block">{!! $p->content_dsp !!}</span>
						<span class="fst-italic text-muted d-block">{!! $p->sub_content_dsp !!}</span>
					</td>
					<td>
						@if($p->category)
							<span class="d-block fw-semibold">{{ $p->category->name }}</span>
						@endif
						@if(count($p->tags))
							<span class="d-block fst-italic">
							@foreach($p->tags as $t)
								@if(!$loop->last)
									{{$t->name}},
								@else
									{{$t->name}}
								@endif
							@endforeach
							</span>						
						@endif
					</td>
					<td>
						@foreach($p->media as $m)
						<img src="{{$m}}" class="border rounded" width="30">
						@endforeach
					</td>
					<td> <code>{{$p->code}}</code> </td>
					<td class="d-flex"> 
						{{--EDIT--}}                        
                        <a href="{{ route('lcms_post.edit', $p->id) }}" class="btn btn-icon btn-outline-success d-inline-flex me-2"><i class="icon-pencil"></i> </a>

                        {{--DELETE--}} 
                        <a id="{{ $p->id }}" onclick="confirmDelete(this.id)" href="#" class="btn btn-icon btn-outline-danger d-inline-flex"><i class="icon-trash"></i> </a>
                        <form method="post" id="item-delete-{{ $p->id }}" action="{{ route('lcms_post.destroy', $p->id) }}" class="hidden">@csrf @method('delete')</form>                       
					</td>
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
<script>
	// Datatable setting defaults
	$.extend( $.fn.dataTable.defaults, { columnDefs: [{ orderable: false, width: 100, targets: [ 4, 5 ] }] });

	// Data table
	$('.datatable').DataTable();

</script>
@endpush