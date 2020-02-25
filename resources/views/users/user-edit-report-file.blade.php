<form action="{{ route('report.research.file.update', $research_report->id) }}" method="POST" enctype="multipart/form-data" role="form">
	<div class="form-group">
		@csrf
		<input name="_method" type="hidden" value="PUT">
		<h4>File: <a href="/public_files/{{ $research_report->file }}"> {{ $research_report->file }} </a></h4>
	</div>
	<div class="form-group">
		<label>Select file</label>
		<input type="file" id="input-file-now" class="defaultdropify" name="file" data-allowed-file-extensions="docs docx xls xlsx pdf pptx ppt" required>
	</div>
	<button type="submit" class="btn btn-primary btn-icon-split">
		<span class="icon text-white-50">
			<i class="fas fa-upload"></i>
		</span>
		<span class="text">Upload</span>
	</button>
</form>
<script type="text/javascript">
	$(document).ready(function() {
	    $(".defaultdropify").dropify();
	});
</script>