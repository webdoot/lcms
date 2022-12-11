@extends('lcms::layout')
@section('page_title', 'Article')

@push('head')
@endpush

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title font-weight-semibold "> List </h6>
    </div>

    <div class="card-body">
        
    	<table class="table datatable-basic">
			<thead>
				<tr>
					<th width="80">SL</th>
					<th>Title</th>
					<th>Content</th>
					<th>Images</th>
					<th class="text-center" width="150">Status Code</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>Enright</td>
					<td>Traffic Court Referee</td>
					<td>22 Jun 1972</td>
					<td class="text-center">Action</td>
				</tr>								
			</tbody>
		</table>	

    </div>

</div>

@endsection

@section('footer')
<!-- <script>
	$(document).ready( function () {
	    $('.table').DataTable();
	});
</script> -->
@endsection

@push('footer')
@endpush