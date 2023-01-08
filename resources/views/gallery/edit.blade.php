@extends('lcms::layout')
@section('page_title', 'Gallery')

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

<form action="{{route('lcms_gallery.update', $gallery->id)}}" method="POST">
@csrf @method('put')
<input type="hidden" name="action" value="gallery">

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h5 class="mb-0">Add Gallery Items</h5>
    </div>

    <div class="card-body">
		<div class="row mb-3">
			<label class="col-md-1 col-form-label">Gallery Title:</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="title" value="{{$gallery->title}}" placeholder="Title" required>
				<code class="float-end">title</code>
			</div>
			<div class="col-md-3">
				<a class="btn btn-sm btn-outline-primary me-3" onclick="addItemBox(this)"> <i class="icon-plus2 me-2"></i> Add Item </a>
				<button type="submit" class="btn btn-sm btn-success"> <i class="icon-paperplane me-2"></i> Save </button>
			</div>
		</div>					
	</div>
</div>

@if(isset($gallery->content_json) && $gallery->content_json)
@foreach($gallery->content_json as $g)
<div class="row">
	<div class="col-md-7 item-box">
		<div class="card">
			<div class="card-header d-flex flex-wrap pb-0"> 
				<p class="fw-semibold item-title">Gallery{{$g->name ? ': '. $g->name : ''}}</p> 
				<div class="d-inline-flex ms-auto"> 
					<a class="text-body" data-card-action="collapse"> <i class="icon-arrow-down12"></i> </a> 
					<a class="text-body ms-2" data-card-action="remove"> <i class="icon-cross3"></i> </a> 
				</div> 
			</div>
			
			<div class="collapse show"> 
				<div class="card-body">
				
					<div class="row mb-3"> 
						<label class="col-md-2 col-form-label">Image (url):</label> 
						<div class="col-md-10"> 
							<input type="text" class="form-control" name="gallery[{{$loop->index}}][image]" value="{{$g->image}}" placeholder="Image"> 
							<code class="float-end">image</code> 
						</div> 
					</div>
			
					<div class="row mb-3"> 
						<label class="col-md-2 col-form-label">Name:</label> 
						<div class="col-md-10"> 
							<input type="text" class="form-control" name="gallery[{{$loop->index}}][name]" value="{{$g->name}}" placeholder="Name"> 
							<code class="float-end">name</code> 
						</div> 
					</div>		
			
					<div class="row mb-3"> 
						<label class="col-md-2 col-form-label">Description:</label> 
						<div class="col-md-10"> 
							<textarea rows="2" class="form-control" name="gallery[{{$loop->index}}][description]" placeholder="Description...">{{$g->description}}</textarea> 
							<code class="float-end">description</code>
						</div> 
					</div>	
			
				</div> 
			</div>
		</div>
	</div>
</div>
@endforeach
@endif

</form>

@endsection

@section('footer')
@endsection

@push('footer')
<script>

	let i=100; 

	const itemBox = function() {
		let html = '<div class="row">';
		html += '<div class="col-md-7 item-box">';
		html += '<div class="card">';
		html += '<div class="card-header d-flex flex-wrap pb-0"> <p class="fw-semibold item-title">Slide</p> <div class="d-inline-flex ms-auto"> <a class="text-body" data-card-action="collapse"> <i class="icon-arrow-down12"></i> </a> <a class="text-body ms-2" data-card-action="remove"> <i class="icon-cross3"></i> </a> </div> </div>';
		html += '<div class="collapse show"> <div class="card-body">';
		html += '<div class="row mb-3"> <label class="col-md-2 col-form-label">Image (url):</label> <div class="col-md-10"> <input type="text" class="form-control" name="slides['+ i +'][image]" placeholder="Image"> <code class="float-end">image</code> </div> </div>';
		html += '<div class="row mb-3"> <label class="col-md-2 col-form-label">Name:</label> <div class="col-md-10"> <input type="text" class="form-control" name="slides['+ i +'][name]" placeholder="Name"> <code class="float-end">name</code> </div> </div>';		
		html += '<div class="row mb-3"> <label class="col-md-2 col-form-label">Description:</label> <div class="col-md-10"> <textarea rows="2" class="form-control" name="slides['+ i +'][description]" placeholder="Description..."></textarea> <code class="float-end">description</code> </div> </div>';	
		html += '</div> </div>';	// .collapse .card-body
		html += '</div>';  // .card
		html += '</div>';  // .col-md-7
		html += '</div>';  // .row
		return html;
	}

	// add item box
	function addItemBox(e){
		$(e.closest('form')).append(itemBox());

		// update collapse event
		let newItemBox = $(e.closest('.card')).nextAll().last();
		let collapseButton = newItemBox.find('[data-card-action=collapse]');
		cardActionCollapse(collapseButton.get(0));

		i += 1;	
		titleUpdateEvent();
	}

	function titleUpdateEvent() {
		let inputName = $("[name*='[name]']");
		inputName.change(function(e){
			$(e.currentTarget).parents('div.item-box').find('p.item-title').html($(this).val());
		})
	}

	// Collapse card
    function cardActionCollapse(button) {
        const cardCollapsedClass = 'card-collapsed';
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const parentContainer = button.closest('.card'),
                  collapsibleContainer = parentContainer.querySelectorAll(':scope > .collapse');

            if (parentContainer.classList.contains(cardCollapsedClass)) {
                parentContainer.classList.remove(cardCollapsedClass);
                collapsibleContainer.forEach(function(toggle) {
                    new bootstrap.Collapse(toggle, {
                        show: true
                    });
                });
            }
            else {
                parentContainer.classList.add(cardCollapsedClass);
                collapsibleContainer.forEach(function(toggle) {
                    new bootstrap.Collapse(toggle, {
                        hide: true
                    });
                });
            }
        });
    };


</script>
@endpush