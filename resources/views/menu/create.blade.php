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
			<div class="col-md-3 action-btn" style="display:none">
				<a class="btn btn-sm btn-outline-primary me-3 add-menu-btn" onclick="addItemBox()"> <i class="icon-plus2 me-2"></i> Add Item </a>
				<button type="submit" class="btn btn-sm btn-success"> <i class="icon-paperplane me-2"></i> Save </button>
			</div>
		</div>					
	</div>
</div>

<div id="item-wrapper">

</div>

<input type="hidden" name="action" value="menu">
</form>

@endsection

@section('footer')
@endsection

@push('footer')
<script>

	let i=0; 

	const itemBox = function() {
		let html = '<div class="row">';
		html += '<div class="col-md-7 item-box">';
		html += '<div class="card">';
		html += '<div class="card-header d-flex flex-wrap pb-0"> <p class="fw-semibold item-title">Add</p> <div class="d-inline-flex ms-auto"> <a href="#" class="add-sub-menu-btn me-3" data-m='+ i +' data-n="0" onclick="addSubItemBox(this)" style="margin-top: -3px"> <i class="icon-plus2"></i> Add Sub Item </a> <a class="text-body" data-card-action="collapse"> <i class="icon-arrow-down12"></i> </a> <a class="text-body ms-2" data-card-action="remove"> <i class="icon-cross3"></i> </a> </div> </div>';
		html += '<div class="collapse show"> <div class="card-body">';
		html += '<div class="row mb-3"> <label class="col-md-2 col-form-label">Name:</label> <div class="col-md-10"> <input type="text" class="form-control" name="menu['+ i +'][name]" placeholder="Name"> <code class="float-end">name</code> </div> </div>';
		html += '<div class="row mb-3"> <label class="col-md-2 col-form-label">Url:</label> <div class="col-md-10"> <input type="text" class="form-control" name="menu['+ i +'][url]" placeholder="Url"> <code class="float-end">url</code> </div> </div>';
		html += '<div class="row mb-3"> <label class="col-md-2 col-form-label">Image:</label> <div class="col-md-10"> <input type="text" class="form-control" name="menu['+ i +'][image]" placeholder="Image"> <code class="float-end">image</code> </div> </div>';
		html += '<div class="row mb-3"> <label class="col-md-2 col-form-label">Description:</label> <div class="col-md-10"> <textarea rows="2" class="form-control" name="menu['+ i +'][description]" placeholder="Description..."></textarea> <code class="float-end">description</code> </div> </div>';	
		html += '</div> </div>';	// .collapse .card-body
		html += '</div>';  // .card
		html += '</div>';  // .col-md-7
		html += '</div>';  // .row
		return html;
	}


	const subItemBox = function(j, k) {
		let html = '<div class="col-md-6 offset-md-1 item-box">';
		html += '<div class="card">';
		html += '<div class="card-header d-flex flex-wrap pb-0"> <p class="fw-semibold item-title">Add</p> <div class="d-inline-flex ms-auto"> <a class="text-body" data-card-action="collapse"> <i class="icon-arrow-down12"></i> </a> <a class="text-body ms-2" data-card-action="remove"> <i class="icon-cross3"></i> </a> </div> </div>';
		html += '<div class="collapse show"> <div class="card-body">';
		html += '<div class="row mb-3"> <label class="col-md-2 col-form-label">Name:</label> <div class="col-md-10"> <input type="text" class="form-control" name="menu['+ j +'][items]['+ k +'][name]" placeholder="Name"> <code class="float-end">name</code> </div> </div>';
		html += '<div class="row mb-3"> <label class="col-md-2 col-form-label">Url:</label> <div class="col-md-10"> <input type="text" class="form-control" name="menu['+ j +'][items]['+ k +'][url]" placeholder="Url"> <code class="float-end">url</code> </div> </div>';
		html += '<div class="row mb-3"> <label class="col-md-2 col-form-label">Image:</label> <div class="col-md-10"> <input type="text" class="form-control" name="menu['+ j +'][items]['+ k +'][image]" placeholder="Image"> <code class="float-end">image</code> </div> </div>';
		html += '<div class="row mb-3"> <label class="col-md-2 col-form-label">Description:</label> <div class="col-md-10"> <textarea rows="2" class="form-control" name="menu['+ j +'][items]['+ k +'][description]" placeholder="Description..."></textarea> <code class="float-end">description</code> </div> </div>';
		html += '</div> </div>'; // .collapse .card-body
		html += '</div>';	// .card
		html += '</div>'; // .col-md-6
		return html;
	}

	// add menu item
	function addItemBox(){
		$('#item-wrapper').append(itemBox);
		i += 1;			
		App.initCardActions();
		titleUpdateEvent();
	}

	// add sub menu item
	function addSubItemBox(e){
		let j = $(e).data('m');
		let k = $(e).data('n');
		
		$(e).parents('div.row').append(subItemBox(j, k));	
		$(e).data('n', k+1);

		App.initCardActions();
		titleUpdateEvent();
	}

	function titleUpdateEvent() {
		const inputName = $("[name*='[name]']");
		inputName.change(function(e){
			$(e.currentTarget).parents('div.item-box').find('p.item-title').html($(this).val());
		})
	}

	$(function(){

		// display action btn
		const inputTitle = $("[name='title']");
		inputTitle.change(function(e){
			e.preventDefault();
			$(e.currentTarget).parents('div.card-body').find('div.action-btn').css('display', 'block');
		})

	}) // $()

</script>
@endpush