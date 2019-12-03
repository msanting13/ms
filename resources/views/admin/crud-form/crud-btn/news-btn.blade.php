<div class="dropdown no-arrow">
	<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-900"></i>
	</a>
	<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
		<div class="dropdown-header">Action:</div>
		<a class="dropdown-item edit-news" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $news->id }}" data-backdrop="static"><i class="fas fa-edit fa-sm fa-fw text-gray-600"></i> Edit</a>
		<div class="dropdown-divider"></div>
		@if(!is_null($news->cover_photos))
			<a class="dropdown-item view-edit-news-cover" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $news->id }}" data-backdrop="static"><i class="fas fa-edit fa-sm fa-fw text-gray-600"></i> View & Edit photo</a>
		@else
			<a class="dropdown-item view-edit-news-cover" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $news->id }}" data-backdrop="static"><i class="fas fa-edit fa-sm fa-fw text-gray-600"></i> Upload photo</a>
		@endif
		<div class="dropdown-divider"></div>
		<a class="dropdown-item btn-delete" href="javascript:void(0)" title="Delete" data-id="{{ $news->id }}" data-textval="{{ $news->title }}">
			<i class="fas fa-trash fa-sm fa-fw text-gray-600"></i>
			Delete
		</a>
		<form id="delete-form{{ $news->id }}" action="{{ action('NewsController@destroy',$news->id) }}" method="POST">
			@csrf
			<input name="_method" type="hidden" value="DELETE">
		</form>
	</div>
</div>