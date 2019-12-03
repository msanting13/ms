@if(Auth::user()->hasRole('role_admin'))
	<a class="dropdown-item edit-card" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $card->id }}" data-backdrop="static">
		<i class="fas fa-edit fa-sm fa-fw text-gray-400"></i>
		Edit card
	</a>
	<a class="dropdown-item edit-message" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $card->id }}" data-backdrop="static">
		<i class="fas fa-edit fa-sm fa-fw text-gray-400"></i>
		Edit message
	</a>
	<a class="dropdown-item" href="#">
		<i class="fas fa-lock fa-sm fa-fw text-gray-400"></i>
		Lock
	</a>
	<div class="dropdown-divider"></div>
	<a class="dropdown-item btn-delete" href="javascript:void(0)" title="Delete" data-id="{{ $card->id }}" data-textval="{{ $card->card_name }}">
		<i class="fas fa-trash fa-sm fa-fw text-gray-400"></i>
		Delete
	</a>
	<form id="delete-form{{ $card->id }}" action="{{ action('ResearchCardsController@destroy',$card->id) }}" method="POST">
		@csrf
		<input name="_method" type="hidden" value="DELETE">
	</form>
@else
	<a class="dropdown-item submit-report" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $card->id }}" data-backdrop="static">
		<i class="fas fa-upload fa-sm fa-fw text-gray-400"></i>
		Submit Report
	</a>
@endif