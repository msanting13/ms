@extends('layouts.layout-master')
@section('title','Extension')
@section('statusResearch','active')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Extension</h1>
{{-- 		@if(Auth::user()->hasRole('role_admin'))
			<a href="#modal-id" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"><i class="fas fa-plus fa-sm text-white-50"></i> Create Report</a>
		@endif --}}
	</div>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">List of Extension Report Forms</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table" id="extensionBoardDataTable">
					<thead>
						<tr>
							<th>ID#</th>
							<th>Type</th>
							<th>Description</th>
							<th>Fiscal year</th>
							<th>Remark</th>
							<th>Status</th>
							{{-- <th>Progress</th> --}}
							<th>Deadline</th>
							<th>Date created</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>ID#</th>
							<th>Type</th>
							<th></th>
							<th>Fiscal year</th>
							<th>Remark</th>
							<th></th>
							{{-- <th>Progress</th> --}}
							<th>Deadline</th>
							<th>Date created</th>
							<th></th>
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
			    $('#extensionBoardDataTable').DataTable({
			    	"columnDefs": [{ 
			    		"orderable": false, "targets": [0,5,8]
			    	},{
						"targets": 2,
						"render": function ( data, type, row ) {
    return type === 'display' && data.length > 10 ?
        data.substr( 0, 10 ) +'…' :
        data;
}
					}],
			    	"order": [[ 7, "desc" ]],
			    	"processing": true,
			    	"serverSide": true,
			    	"ajax":{
			    		"url": "{{ route('admin.extensions.card.data','extension') }}",
			    		"type": "GET"
			    	},
			    	"columns": [
						{ "data": "id" },
						{ "data": "card_name" },
						{ "data": "description" },
						{ "data": "fiscal_year" },
						{ "data": "message" },
						{ "data": "status" },
						// { "data": "counts" },
						{ "data": "deadline" },
						{ "data": "created_at" },
						{ "data": "action" },
						],
			    	"drawCallback": function(settings){
						initbootstrapSwitch();
						postUpostSwitcher();
			    		deleteFunction();
			    	},
					initComplete: function () {
						this.api().columns([0,1,3,4,6,7]).every( function () {
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
		<script src="/js/custom/edit-card-ajax.js"></script>
		<script src="/js/custom/edit-message-ajax.js"></script>
		<script src="/js/custom/submit-extension-report-ajax.js"></script>
	@endsection
	@section('publisher','/admin/card/status/')
@endsection