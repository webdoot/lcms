<div id="media-model" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Media</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<div class="modal-body">
				
				<div class="row show-media-box">
					@foreach($medias as $m)
					<div class="col-lg-2 col-md-3 col-4">
						<img src="{{$m->url}}" class="img-fluid media-selectable">
					</div>
					@endforeach
				</div>

			</div>

			<div class="modal-footer">
				<button type="button" id="insert-media-btn" class="btn btn-primary btn-sm"> Insert <i class="icon-stack-down ms-2"></i></button>
			</div>			
		</div>
	</div>
</div>