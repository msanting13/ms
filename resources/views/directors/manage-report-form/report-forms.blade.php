@extends('layouts.layout-master')
@section('title','List of Report forms')
@section('statusResearch','active')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Report Forms</h1>
{{-- 		@if(Auth::user()->hasRole('role_admin'))
			<a href="#modal-id" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"><i class="fas fa-plus fa-sm text-white-50"></i> Create Report</a>
		@endif --}}
	</div>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">List of Report Forms</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table" id="researchCardDataTable">
					<thead>
						<tr>
							<th>ID#</th>
							<th>Status</th>
							<th>Type</th>
							<th>Form type</th>
							<th>Description</th>
							<th>Fiscal year</th>
							<th>Remark</th>
							<th>Deadline</th>
							<th>Date created</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>ID#</th>
							<th>Status</th>
							<th>Type</th>
							<th>Form type</th>
							<th>Description</th>
							<th>Fiscal year</th>
							<th>Remark</th>
							<th>Deadline</th>
							<th>Date created</th>
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
			    $('#researchCardDataTable').DataTable({
			    	"columnDefs": [{ 
			    		"orderable": false, "targets": [0,9]
			    	}],
			    	"order": [[ 8, "desc" ]],
			    	"processing": false,
			    	"serverSide": false,
			    	"ajax":{
			    		"url": "{{ route('director-report-forms-data') }}",
			    		"type": "GET"
			    	},
			    	"columns": [
					{ "data": "id" },
					{ "data": "status" },
			    	{ "data": "type" },
			    	{ "data": "card_name" },
			    	{ "data": "description" },
			    	{ "data": "fiscal_year" },
			    	{ "data": "message" },
			    	{ "data": "deadline" },
			    	{ "data": "created_at" },
			    	{ "data": "action" },
			    	],
			    	"drawCallback": function(settings){
			    		initbootstrapSwitch();
			    		lockUnlockSwitcher();
					},
					initComplete: function () {
						this.api().columns([0,2,3,5,6,7,8]).every( function () {
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
		<script src="/js/custom/director-lock-unlock-report-form.js"></script>
	@endsection
@endsection