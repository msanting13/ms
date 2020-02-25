<div class="dropdown no-arrow">
	<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-900"></i>
	</a>
	<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
		<div class="dropdown-header">Action:</div>
		<a class="dropdown-item edit-event" href="javascript:void(0)" id="editBtn" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $event->id }}" data-backdrop="static"><i class="fas fa-edit fa-sm fa-fw text-gray-600"></i> Edit</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item btn-delete" href="javascript:void(0)" title="Delete" data-id="{{ $event->id }}" data-textval="{{ $event->event_name }}">
			<i class="fas fa-trash fa-sm fa-fw text-gray-600"></i>
			Delete
		</a>
		<form id="delete-form{{ $event->id }}" action="{{ action('EventController@destroy',$event->id) }}" method="POST">
			@csrf
			<input name="_method" type="hidden" value="DELETE">
		</form>
	</div>
</div>