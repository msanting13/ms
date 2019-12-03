<form action="{{ route('research.report.name.update', $id) }}" method="POST" role="form">
	<div class="form-group">
		@csrf
		<input name="_method" type="hidden" value="PUT">
		<label>Name</label>
		<input type="text" id="name" class="form-control" name="name" value="{{ $report->name }}" required>
	</div>

	<button type="submit" class="btn btn-primary btn-icon-split">
		<span class="icon text-white-50">
			<i class="fas fa-edit"></i>
		</span>
		<span class="text">Update</span>
	</button>
</form>