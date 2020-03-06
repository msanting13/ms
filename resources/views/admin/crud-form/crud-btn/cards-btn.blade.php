<div class="dropdown no-arrow">
	<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-800"></i>
	</a>
	<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
		<div class="dropdown-header text-gray-900">Action:</div>
		{{-- @include('includes.crud-card-btn') --}}
		<a class="dropdown-item" href="{{ ($card->type == 'research') ? route('admin-research-card.show',$card->id) :  route('admin-extension-card.show',$card->id) }}">
			<i class="fas fa-eye fa-sm fa-fw text-gray-800"></i>
			View submitted reports
		</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item edit-card" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $card->id }}" data-backdrop="static">
			<i class="fas fa-edit fa-sm fa-fw text-gray-800"></i>
			Edit
		</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item btn-delete" href="javascript:void(0)" title="Delete" data-id="{{ $card->id }}" data-textval="{{ $card->card_name }}">
			<i class="fas fa-trash fa-sm fa-fw text-gray-800"></i>
			Delete
		</a>
		<form id="delete-form{{ $card->id }}" action="{{ route('card.destroy', $card->id) }}" method="POST">
			@csrf
			<input name="_method" type="hidden" value="DELETE">
		</form>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item">
			{{-- <i class="fas fa-edit fa-sm fa-fw text-gray-800"></i> --}}
			<div class="bt-switch">
				<input type="checkbox" class="post-unpost-switch" data-id="{{ $card->id }}" data-textval="{{ $card->card_name }}" data-on-color="success" data-off-color="warning" data-on-text="Post" data-off-text="Unpost" data-size="medium" {{ $card->is_published ? 'value=on ' : 'value=off' }} {{ $card->is_published ? 'checked=checked ' : '' }}>
			</div>
		</a>
	</div>
</div>