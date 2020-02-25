<form action="{{ route('card.update',$card->id) }}" method="POST" role="form">
	<div class="form-group">
		@csrf
		<input name="_method" type="hidden" value="PUT">
		<label for="fiscalYear">Fiscal-Year</label>
		<select id="fiscalYear" class="form-control" name="fiscal_year" required>
			<option>{{ $card->fiscal_year }}</option>
			@for($i=date('Y'); $i >= 2000; $i--)
				<option>FY {{ $i }}</option>
			@endfor
		</select>
	</div>
	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" id="name" class="form-control" name="card_name" value="{{ $card->card_name }}" required>
	</div>
	<div class="form-group">
		<label for="description">Description</label>
		<textarea id="description" class="form-control" name="description">{{ $card->description }}</textarea>
	</div>

	<button type="submit" class="btn btn-primary btn-icon-split">
		<span class="icon text-white-50">
			<i class="fas fa-edit"></i>
		</span>
		<span class="text">Update</span>
	</button>
</form>