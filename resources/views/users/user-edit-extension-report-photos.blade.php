<!-- Page Content -->
<div class="container">

  <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">{{ ucfirst($extensionReport->title) }} Photos</h1>

  <hr class="mt-2 mb-5">

  <div class="row text-center text-lg-left">
	@foreach($extensionReport->extensionReportPhotos as $photo)
	    <div class="col-lg-3 col-md-4 col-6">
	      <a href="#" class="d-block mb-4 h-100">
	            <img class="img-fluid img-thumbnail" src="/public_files/gallery/{{ $photo->photo }}">
	          </a>
	    </div>
	@endforeach
  </div>

</div>
<!-- /.container -->
<form action="{{ route('add.extension.report.photo', $extensionReport->id) }}" method="POST" enctype="multipart/form-data" role="form">
	<div class="form-group">
		@csrf
	</div>
	<div class="form-group">
		<label>Select file</label>
		<input type="file" id="input-file-now" class="defaultdropify" name="file[]" data-allowed-file-extensions="pdf jpg JPEG png" multiple required>
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