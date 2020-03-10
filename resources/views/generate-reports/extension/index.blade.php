@extends('layouts.layout-master')
@section('title','Generate Research Report')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Extension Reports</h1>
	</div>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Forms</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table" id="extensionCardDataTable" width="100%">
					<thead>
						<tr>
							<th>ID#</th>
							<th>Type</th>
							<th>Description</th>
							<th>Fiscal year</th>
							<th>Status</th>
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
							<th></th>
							<th>Deadline</th>
							<th>Date created</th>
							<th></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
    </div>
	@section('ajax-request')
		<script type="text/javascript">
			$(document).ready(function() {
			    $('#extensionCardDataTable').DataTable({
					"responsive": true,
			    	"columnDefs": [{
						"targets": [2],
      					"render": $.fn.dataTable.render.ellipsis(10)
					},{ 
			    		"orderable": false, "targets": [7]
			    	}],
			    	"order": [[ 6, "desc" ]],
			    	"processing": false,
			    	"serverSide": false,
			    	"ajax":{
			    		"url": "{{ route('extension-forms-data') }}",
			    		"type": "GET"
			    	},
			    	"columns": [
			    	{ "data": "id" },
			    	{ "data": "card_name" },
			    	{ "data": "description" },
			    	{ "data": "fiscal_year" },
			    	{ "data": "status" },
					{ "data": "deadline" },
			    	{ "data": "created_at" },
			    	{ "data": "action" },
			    	],
					initComplete: function () {
						this.api().columns([0,1,3,5,6]).every( function () {
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
	@endsection
@endsection