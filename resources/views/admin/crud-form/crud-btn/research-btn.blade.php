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
				<a class="dropdown-item edit-report-file" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $report->id }}" data-backdrop="static">
					<i class="fas fa-edit fa-sm fa-fw text-gray-800"></i>
					Change file
				</a>
			@endif
		@endif
	</div>
</div>