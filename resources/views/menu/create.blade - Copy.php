@extends('lcms::layout')
@section('page_title', 'Menu')

@push('head')
<style>
	
	.form-control{
		padding-right: 54px;
	}

	code {
		margin-top: -31px;
		margin-right: 5px;
	}

</style>
@endpush

@section('content')

<form action="{{route('lcms_menu.store')}}" method="POST">
@csrf @method('post')
<div class="card">
    <div class="card-header d-flex align-items-center">
        <h5 class="mb-0">Add Menu</h5>
    </div>

    <div class="card-body">
		<div class="row mb-3">
			<label class="col-md-1 col-form-label">Menu Title:</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="title" placeholder="Title" required>
				<code class="float-end">title</code>
			</div>
			<div class="col-md-3">
				<a class="btn btn-sm btn-outline-primary me-3"> <i class="icon-plus2 me-2"></i> Add Item </a>
				<button type="submit" class="btn btn-sm btn-success"> <i class="icon-paperplane me-2"></i> Save </button>
			</div>
		</div>					
	</div>
</div>

<div class="">
	
	<div class="row">
		<div class="col-md-7 item-box">
			<div class="card">
				<div class="card-header d-flex flex-wrap pb-0">
					<p class="fw-semibold item-title">Add</p>
					<div class="d-inline-flex ms-auto">
						<a class="me-3" style="margin-top: -3px"> <i class="icon-plus2"></i> Add Sub Item </a>
						<a class="text-body" data-card-action="collapse"> <i class="icon-arrow-down12"></i> </a>
						<a class="text-body ms-2" data-card-action="remove"> <i class="icon-cross3"></i> </a>
					</div>
				</div>

				<div class="collapse show">
					<div class="card-body">
						<div class="row mb-3">
							<label class="col-md-2 col-form-label">Name:</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="menu[0][name]" placeholder="Name">
								<code class="float-end">name</code>
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-md-2 col-form-label">Url:</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="menu[0][url]" placeholder="Url">
								<code class="float-end">url</code>
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-md-2 col-form-label">Image:</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="menu[0][image]" placeholder="Image">
								<code class="float-end">image</code>
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-md-2 col-form-label">Description:</label>
							<div class="col-md-10">
								<textarea rows="2" class="form-control" name="menu[0][description]" placeholder="Description..."></textarea>
								<code class="float-end">description</code>
							</div>
						</div>					
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 offset-md-1 item-box">
			<div class="card">
				<div class="card-header d-flex flex-wrap pb-0">
					<p class="fw-semibold item-title">Add</p>
					<div class="d-inline-flex ms-auto">
						<a href="#" class="me-3" style="margin-top: -3px"> <i class="icon-plus2"></i> Add Sub Item </a>
						<a class="text-body" data-card-action="collapse"> <i class="icon-arrow-down12"></i> </a>
						<a class="text-body ms-2" data-card-action="remove"> <i class="icon-cross3"></i> </a>
					</div>
				</div>

				<div class="collapse show">
					<div class="card-body">
						<div class="row mb-3">
							<label class="col-md-2 col-form-label">Name:</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="menu[0][items][name]" placeholder="Name">
								<code class="float-end">name</code>
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-md-2 col-form-label">Url:</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="menu[0][items][url]" placeholder="Url">
								<code class="float-end">url</code>
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-md-2 col-form-label">Image:</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="menu[0][items][image]" placeholder="Image">
								<code class="float-end">image</code>
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-md-2 col-form-label">Description:</label>
							<div class="col-md-10">
								<textarea rows="2" class="form-control" name="menu[0][items][description]" placeholder="Description..."></textarea>
								<code class="float-end">description</code>
							</div>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</div>



</div>

<div class="">
	
	<div class="row">
		<div class="col-md-7 item-box">
			<div class="card">
				<div class="card-header d-flex flex-wrap pb-0">
					<p class="fw-semibold item-title">Add</p>
					<div class="d-inline-flex ms-auto">
						<a href="#" class="me-3" style="margin-top: -3px"> <i class="icon-plus2"></i> Add Sub Item </a>
						<a class="text-body" data-card-action="collapse"> <i class="icon-arrow-down12"></i> </a>
						<a class="text-body ms-2" data-card-action="remove"> <i class="icon-cross3"></i> </a>
					</div>
				</div>

				<div class="collapse show">
					<div class="card-body">
						<div class="row mb-3">
							<label class="col-md-2 col-form-label">Name:</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="menu[1][name]" placeholder="Name">
								<code class="float-end">name</code>
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-md-2 col-form-label">Url:</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="menu[1][url]" placeholder="Url">
								<code class="float-end">url</code>
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-md-2 col-form-label">Image:</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="menu[1][image]" placeholder="Image">
								<code class="float-end">image</code>
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-md-2 col-form-label">Description:</label>
							<div class="col-md-10">
								<textarea rows="2" class="form-control" name="menu[1][description]" placeholder="Description..."></textarea>
								<code class="float-end">description</code>
							</div>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<input type="hidden" name="action" value="menu">
</form>

@endsection

@section('footer')
@endsection

@push('footer')
<script>
	
	const inputName = $("[name*='[name]']");
	// change title
	inputName.change(function(e){
		$(e.currentTarget).parents('div.item-box').find('p.item-title').html($(this).val());
	})

</script>
@endpush