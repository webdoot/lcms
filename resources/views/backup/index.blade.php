@extends('lcms::layout')
@section('page_title', 'Backup')

@push('head')
@endpush

@section('content')

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h5 class="mb-0">List</h5>
    </div>

    <div class="row g-5 p-4" style="min-height: 400px">
    	<div class="col-md-6">
    		<form method="get" action="{{route('lcms_backup.create')}}">
    		@csrf @method('get')
    		<div class="row border bg-light py-3 mb-3 text-center">				
    			<div class="col-8">
					<input type="text" class="form-control" name="name" placeholder="Backup name (max 50 character)" maxlength="50">
				</div>

				<div class="col-4">
					<input type="hidden" name="action" value="createbackup">
            		<button type="submit" class="btn btn-secondary"> <i class="icon-magic-wand me-2"></i> Create Backup </button>
            	</div>            	
    		</div>
    		</form>

    		<form method="post" action="{{route('lcms_backup.store')}}" enctype="multipart/form-data">    		   			
			@csrf @method('post')
    		<div class="row border bg-light py-3 text-center"> 
    			<div class="col-8">					  
  					<input type="file" class="form-control" name="bkpfile" accept=".zip">
				</div>

				<div class="col-4">
					<input type="hidden" name="action" value="createbackup">
            		<button type="submit" class="btn btn-secondary"> <i class="icon-box-remove me-2"></i> Upload Backup </button>
            	</div>            	
    		</div>
    		</form>
    	</div>

    	<div class="col-md-6">
    		<table class="table table-striped-columns border">
			  	@foreach($backups as $b)
				<tr>
					<td> {{$b['date']}} </td>	
					<td> {{$b['name']}} </td>				
					<td class="d-flex justify-content-end"> 
						{{--RESTORE--}}                        
                        <a href="{{ route('lcms_backup.show', [$b['id'], 'name'=>$b['basename']]) }}" class="btn btn-icon btn-outline-success d-inline-flex me-2" data-bs-popup="tooltip" data-bs-title="Restore"><i class="icon-reset"></i> </a>

						{{--DOWNLOAD--}}                        
                        <a href="{{ route('lcms_backup.edit', [$b['id'], 'name'=>$b['basename']]) }}" class="btn btn-icon btn-outline-primary d-inline-flex me-2" data-bs-popup="tooltip" data-bs-title="Download"><i class="icon-box-add"></i> </a>    

                        {{--DELETE--}} 
                        <a id="{{ $b['id'] }}" onclick="confirmDelete(this.id)" href="#" class="btn btn-icon btn-outline-danger d-inline-flex" data-bs-popup="tooltip" data-bs-title="Delete"><i class="icon-trash"></i> </a>
                        <form method="post" id="item-delete-{{ $b['id'] }}" action="{{ route('lcms_backup.destroy', $b['id']) }}" class="hidden">@csrf @method('delete') <input type="hidden" name="name" value="{{ $b['basename'] }}"> </form>              
					</td>
				</tr>
				@endforeach			
			</table>
    	</div>
    </div>
</div>

@endsection

@section('footer')
@endsection

@push('footer')
@endpush