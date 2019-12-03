<form action="{{ route('research.report.store',$id) }}" method="POST" enctype="multipart/form-data" role="form">
	<div class="form-group">
		@csrf
		<label>Name</label>
		<input type="text" id="name" class="form-control" name="name" required>
	</div>
	<div class="form-group">
		<label>Select file</label>
		<input type="file" id="input-file-now" class="defaultdropify" name="file" data-allowed-file-extensions="docs docx xls xlsx pdf pptx ppt" required>
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