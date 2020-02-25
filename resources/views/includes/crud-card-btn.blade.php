<a class="dropdown-item" href="{{ ($card->type == 'research') ? route('card.show',$card->id) :  route('extension.card.show',$card->id) }}">
	<i class="fas fa-eye fa-sm fa-fw text-gray-800"></i>
	View
</a>
<div class="dropdown-divider"></div>
@if(Auth::user()->hasRole('role_admin'))
	<a class="dropdown-item edit-card" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $card->id }}" data-backdrop="static">
		<i class="fas fa-edit fa-sm fa-fw text-gray-800"></i>
		Edit
	</a>
	<a class="dropdown-item edit-message" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $card->id }}" data-backdrop="static">
		<i class="fas fa-edit fa-sm fa-fw text-gray-800"></i>
		Edit remark
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
@elseif(Auth::user()->hasRole('role_director'))
	<a class="dropdown-item submit-report {{ ($card->is_lock)? 'disabled' : '' }}" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $card->id }}" data-backdrop="static">
		<i class="fas fa-upload fa-sm fa-fw text-gray-800"></i>
		Submit Report
	</a>
	@if($card->is_lock)
		<a class="dropdown-item unlock-btn" href="javascript:void(0)" data-id="{{ $card->id }}" {{-- onclick="event.preventDefault(); document.getElementById('unlock-form{{ $card->id }}').submit();"  --}}>
			<i class="fas fa-unlock fa-sm fa-fw text-gray-800"></i>
			UnLock
		</a>
		<form id="unlock-form{{ $card->id }}" action="{{ route('unlock.research.card', $card->id) }}" method="POST" style="display: none;">
			@csrf
			<input name="_method" type="hidden" value="PUT">
		</form>   	
	@else
		<a class="dropdown-item lock-btn" href="javascript:void(0)" data-id="{{ $card->id }}" {{-- onclick="event.preventDefault(); document.getElementById('lock-form{{ $card->id }}').submit();" --}} >
			<i class="fas fa-lock fa-sm fa-fw text-gray-800"></i>
			Lock
		</a>
		<form id="lock-form{{ $card->id }}" action="{{ route('lock.research.card', $card->id) }}" method="POST" style="display: none;">
			@csrf
			<input name="_method" type="hidden" value="PUT">
		</form>   
	@endif
@else
	<a class="dropdown-item submit-report {{ ($card->is_lock)? 'disabled' : '' }}" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $card->id }}" data-backdrop="static">
		<i class="fas fa-upload fa-sm fa-fw text-gray-800"></i>
		Submit report
	</a>
@endif