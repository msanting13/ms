<form action="{{ route('research-report.store') }}" method="POST" enctype="multipart/form-data" role="form">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				@csrf
				<input type="hidden" name="cardid" value="{{ $cardID }}">
				<label>Title *</label>
				<input type="text" id="name" class="form-control" name="title" required>
			</div>
			<div class="form-group">
				<label>Short description</label>
				<textarea id="shortDescription" class="form-control" name="short_description" required></textarea>	
			</div>			
			<div class="form-group">
				<label>Project cost *</label>
				<input type="text" id="projectCost" class="form-control" name="project_cost" required>
			</div>
			<div class="form-group">
				<label>Funding source *</label>
				<input type="text" id="fundingSource" class="form-control" name="funding_source" required>
			</div>			
			<div class="form-group">
				<label>Agency *</label>
				<input type="text" id="agency" class="form-control" name="agency" required>
			</div>
			<div class="form-group">
				<label>SDG/s addressed</label>
				<input type="text" id="sdgsAddressed" class="form-control" name="sdgs_addressed" required>
			</div>
			<div class="form-group">
				<label>Beneficiaries and Impact</label>
				<textarea class="form-control" name="beneficiaries" required></textarea>	
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Attach file</label>
				<input type="file" id="input-file-now" class="defaultdropify" name="file" data-allowed-file-extensions="docs docx xls xlsx pdf pptx ppt" required>
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-primary btn-icon-split">
		<span class="icon text-white-50">
			<i class="fas fa-upload"></i>
		</span>
		<span class="text">Submit</span>
	</button>
</form>
<script type="text/javascript">
	$(document).ready(function() {
	    $(".defaultdropify").dropify();
	});
</script>