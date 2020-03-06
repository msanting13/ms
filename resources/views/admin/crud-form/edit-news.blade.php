<form action="{{ route('news.update', $news->id) }}" method="POST" role="form">	
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="border-right: 1px solid#ccc;">
			<div class="form-group">
				<legend>Info</legend>
			</div>
			<div class="form-group">
				@csrf
				<input name="_method" type="hidden" value="PUT">
				<label for="Title">Title *</label>
				<input type="text" id="Title" class="form-control" name="title" value="{{ $news->title }}" required>
			</div>				
			<div class="form-group">
				<label for="Author">Author *</label>
				<input type="text" id="Author" class="form-control" name="author" value="{{ $news->author }}" required>
			</div>
			<div class="form-group">
				<label>Overview *</label>
				<textarea class="form-control makeMeRichTextareaEdit" id="{{ uniqid() }}" name="overview" required>{!! $news->overview !!}</textarea>
			</div>	
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<div class="form-group">
				<legend>Content</legend>
			</div>
			<div class="form-group">
				<label for="Content">Full Content *</label>
				<textarea class="form-control makeMeRichTextareaEdit" id="{{ uniqid() }}" name="content" required>{!! $news->content !!}</textarea>
			</div>				
			<button type="submit" class="btn btn-primary btn-icon-split">
				<span class="icon text-white-50">
					<i class="fas fa-plus"></i>
				</span>
				<span class="text">Save</span>
			</button>
		</div>
	</div>					
</form>
<script type="text/javascript">
	$(document).ready(function() {
		 $(".defaultdropify").dropify();

		$('.makeMeRichTextareaEdit').each( function () {
			CKEDITOR.replace(this.id,options)
		});
	});
</script>