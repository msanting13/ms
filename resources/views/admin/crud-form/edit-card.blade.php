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
		<label for="cardName">Report type</label>
            <select id="cardName" class="form-control @error('card_name') is-invalid @enderror" name="card_name" required>
              <option>{{ $card->card_name }}</option>
              <option>Program</option>
              <option>Project</option>
              <option>Activities</option>
            </select>
	</div>
	<div class="form-group">
		<label for="description">Description</label>
		<textarea id="description" class="form-control" name="description" required>{{ $card->description }}</textarea>
	</div>	
	<div class="form-group">
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