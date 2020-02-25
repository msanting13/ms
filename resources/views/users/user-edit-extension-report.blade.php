<form action="{{ route('extension-report.update', $extensionReport->id) }}" method="POST" role="form">
	<div class="form-group">
		@csrf
		<input name="_method" type="hidden" value="PUT">
		<label>Title *</label>
		<input type="text" id="name" class="form-control" name="title" value="{{ $extensionReport->title }}" required>
	</div>
	<div class="form-group">
		<label>Short description</label>
		<textarea id="shortDescription" class="form-control" name="short_description" required>{{ $extensionReport->short_description }}</textarea>	
	</div>			
	<div class="form-group">
		<label>Project cost *</label>
		<input type="text" id="currency-field" pattern="^\₱\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" name="project_cost" value="{{ $extensionReport->project_cost }}" required>
	</div>
	<div class="form-group">
		<label>Funding source *</label>
		<input type="text" id="fundingSource" class="form-control" name="funding_source" value="{{ $extensionReport->funding_source }}" required>
	</div>			
	<div class="form-group">
		<label>Agency *</label>
		<input type="text" id="agency" class="form-control" name="agency" value="{{ $extensionReport->agency }}" required>
	</div>
	<div class="form-group">
		<label>SDG/s addressed</label>
		<input type="text" id="sdgsAddressed" class="form-control" name="sdgs_addressed" value="{{ $extensionReport->sdgs_addressed }}" required>
	</div>
	<div class="form-group">
		<label>Beneficiaries and Impact</label>
		<textarea class="form-control" name="beneficiaries" required>{{ $extensionReport->beneficiaries }}</textarea>	
	</div>
	<button type="submit" class="btn btn-primary btn-icon-split">
		<span class="icon text-white-50">
			<i class="fas fa-edit"></i>
		</span>
		<span class="text">Update</span>
	</button>
</form>
<script type="text/javascript">
	currencyFormatter()
</script>