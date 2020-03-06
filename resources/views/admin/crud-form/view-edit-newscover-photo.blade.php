<form action="{{ route('news.upload.cover',$news->id) }}" method="POST" enctype="multipart/form-data" role="form">
	<div class="row">
		<div class="col-md-12">
			<img src="/public_files/image/news/{{ $news->cover_photos }}" style="width: 320px;">

		</div>
	</div>
	<div class="form-group">
		@csrf
		<label>Cover photo</label>
		<input type="file" id="input-file-now" class="defaultdropify" name="photo" data-allowed-file-extensions="jpg png JPEG">
	</div>		

	<button type="submit" class="btn btn-primary btn-icon-split">
		<span class="icon text-white-50">
			<i class="fas fa-plus"></i>
		</span>
		<span class="text">Upload</span>
	</button>				
</form>
<script type="text/javascript">
	$(document).ready(function() {
		 $(".defaultdropify").dropify();
	});
</script>