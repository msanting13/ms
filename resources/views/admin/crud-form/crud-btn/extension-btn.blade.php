<div class="dropdown no-arrow">
	<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-800"></i>
	</a>
	<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
		<div class="dropdown-header text-gray-800">Action:</div>
		<a class="dropdown-item view-report-details" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $report->id }}" data-textval="{{ $report->title }}"  data-backdrop="static">
			<i class="fas fa-eye fa-sm fa-fw text-gray-800"></i>
			Complete details
		</a>
		@if(Auth::user()->hasRole('role_user') || Auth::user()->hasRole('role_director'))
			@if(Auth::id() == $report->users->id)   
				<div class="dropdown-divider"></div>
				<a class="dropdown-item edit-report-name" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $report->id }}" data-backdrop="static">
					<i class="fas fa-edit fa-sm fa-fw text-gray-800"></i>
					Edit report
				</a>
				<a class="dropdown-item edit-report-photos" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $report->id }}" data-backdrop="static">
					<i class="fas fa-edit fa-sm fa-fw text-gray-800"></i>
					Add attach photos
				</a>				
	<a class="dropdown-item btn-delete" href="javascript:void(0)" title="Delete" data-id="{{ $report->id }}" data-textval="{{ $report->title }}">
		<i class="fas fa-trash fa-sm fa-fw text-gray-800"></i>
		Delete
	</a>
	<form id="delete-form{{ $report->id }}" action="{{ route('extension-report.destroy', $report->id) }}" method="POST">
		@csrf
		<input name="_method" type="hidden" value="DELETE">
	</form>
			@endif
		@endif
	</div>
</div>