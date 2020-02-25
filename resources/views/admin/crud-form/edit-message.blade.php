<form action="{{ route('card.message.update', $card->id) }}" method="POST" role="form">
	<div class="form-group">
		@csrf
		<input name="_method" type="hidden" value="PUT">
		<label for="message">Remark</label>
		<textarea id="message" class="form-control" name="message">{{ $card->message }}</textarea>
	</div>

	<button type="submit" class="btn btn-primary btn-icon-split">
		<span class="icon text-white-50">
			<i class="fas fa-edit"></i>
		</span>
		<span class="text">Update</span>
	</button>
</form>