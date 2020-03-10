@extends('layouts.layout-master')
@section("title",'Research')
@section('statusResearch','active')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Research</h1>
		@if(Auth::user()->hasRole('role_user') || Auth::user()->hasRole('role_director'))
			<div class="btn-group" role="group" aria-label="Basic example">
			  <button type="button" class="btn btn-sm btn-secondary" onclick="goBack()"><i class="fas fa-arrow-left"></i> Back</button>
			  <button type="button" class="btn btn-sm btn-primary submit-report" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $card->id }}" data-backdrop="static" {{ ($card->is_lock)? 'disabled' : '' }}><i class="fas fa-upload fa-sm text-white-50"></i> Submit report</button>
			</div>
		@else
			<button type="button" class="btn btn-sm btn-secondary" onclick="goBack()"><i class="fas fa-arrow-left"></i> Back</button>
		@endif
	</div>
	<hr>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="h4 mb-0 text-gray-800">
        	{{ $card->card_name." "."FY ".$card->fiscal_year }}
				@if($card->is_lock)
					<i class="fas fa-lock fa-md fa-fw" style="color: #e74a3b;"></i>
				@else
					<i class="fas fa-unlock fa-md fa-fw" style="color: #36b9cc;"></i>
				@endif
        	<p class="h6 mb-0 text-gray-800">Description: {{ $card->description }}</p>
        	<p class="h6 mb-0 text-gray-800">Deadline: {{ $card->deadline->format('F d,Y') }}</p>
        </h4>        
	</div>

	<hr>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">
				List of Submitted Reports	
			</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="researchReportsDataTable" width="100%">
					<thead>
						<tr>
							<th>ID#</th>
							<th>Research title</th>
							<th>Project cost</th>
							<th>Funding source</th>
							<th>Agency</th>
							<th>SDG/s addressed</th>
							<th>Submitted by</th>
							<th>Campus</th>
							<th>Date submitted</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th></th>
							<th>Research title</th>
							<th>Project cost</th>
							<th>Funding source</th>
							<th>Agency</th>
							<th>SDG/s addressed</th>
							<th>Submitted by</th>
							<th>Campus</th>
							<th>Date submitted</th>
							<th>Action</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	@include('includes.modal')
	@section('ajax-request')
		<script type="text/javascript">
			$(document).ready(function() {
			    $('#researchReportsDataTable').DataTable({
			    	"columnDefs": [{ 
			    		"orderable": false, 
						"targets": [9]
			    	}],
			    	"order": [[ 8, "desc" ]],
					"responsive": true,
			    	"processing": false,
			    	"serverSide": false,
			    	"ajax":{
			    		"url": "{{ route('admin.research.report.data',$card->id) }}",
			    		"type": "POST",
			    		"data":{ _token: "{{csrf_token()}}"}
			    	},
		            columns: [
		            {data: 'id', name: 'id'},
		            {data: 'title', name: 'title'},
		            {data: 'project_cost', name: 'project_cost'},
		            {data: 'funding_source', name: 'funding_source'},
		            {data: 'agency', name: 'agency'},
		            {data: 'sdgs_addressed', name: 'sdgs_addressed'},
		            {data: 'submitted_by', name: 'submitted_by'},
		            {data: 'campus', name: 'campus'},
		            {data: 'created_at', name: 'created_at'},
		            {data: 'action', name: 'action'},
		            ],
			    	"drawCallback": function(settings){
			    		deleteFunction();
			    	},
					initComplete: function () {
						this.api().columns([0,1,2,3,4,5,6,7,8]).every( function () {
							var column = this;
							var select = $('<select><option value=""></option></select>')
								.appendTo( $(column.footer()).empty())
								.on( 'change', function () {
									var val = $.fn.dataTable.util.escapeRegex(
										$(this).val()
									);
			
									column
										.search( val ? '^'+val+'$' : '', true, false )
										.draw();
								} );
			
							column.data().unique().sort().each( function ( d, j ) {
								select.append( '<option value="'+d+'">'+d+'</option>' )
							} );
						} );
        			}
			    });

			});
		</script>
		<script src="/js/custom/submit-research-report-ajax.js"></script>
		<script src="/js/custom/view-research-report-details-ajax.js"></script>
		<script src="/js/custom/edit-research-report-ajax.js"></script>
		<script src="/js/custom/edit-research-report-file-ajax.js"></script>
	@endsection
@endsection