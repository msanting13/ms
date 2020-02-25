<form action="{{ route('research-report.update', $research_report->id) }}" method="POST" role="form">
	<div class="form-group">
		@csrf
		<input name="_method" type="hidden" value="PUT">
		<label>Title *</label>
		<input type="text" id="name" class="form-control" name="title" value="{{ $research_report->title }}" required>
	</div>
	<div class="form-group">
		<label>Short description</label>
		<textarea id="shortDescription" class="form-control" name="short_description" required>{{ $research_report->short_description }}</textarea>	
	</div>			
	<div class="form-group">
		<label>Project cost *</label>
		<input type="text" id="currency-field" pattern="^\₱\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" name="project_cost" value="{{ $research_report->project_cost }}" required>
	</div>
	<div class="form-group">
		<label>Funding source *</label>
		<input type="text" id="fundingSource" class="form-control" name="funding_source" value="{{ $research_report->funding_source }}" required>
	</div>			
	<div class="form-group">
		<label>Agency *</label>
		<input type="text" id="agency" class="form-control" name="agency" value="{{ $research_report->agency }}" required>
	</div>
	<div class="form-group">
		<label>SDG/s addressed</label>
		<input type="text" id="sdgsAddressed" class="form-control" name="sdgs_addressed" value="{{ $research_report->sdgs_addressed }}" required>
	</div>
	<div class="form-group">
		<label>Beneficiaries and Impact</label>
		<textarea class="form-control" name="beneficiaries" required>{{ $research_report->beneficiaries }}</textarea>	
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