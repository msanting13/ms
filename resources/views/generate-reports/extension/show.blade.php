@extends('layouts.layout-master')
@section('title','Generate Research Report')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 id="reportTitle" class="h3 mb-0 text-gray-800" data-textval="Extension-{{ $card->card_name." FY ".$card->fiscal_year }} Reports">Extension-{{ $card->card_name." FY ".$card->fiscal_year }}</h1>
		<button type="button" class="btn btn-sm btn-secondary" onclick="goBack()"><i class="fas fa-arrow-left"></i> Back</button>
	</div>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">List of submitted reports</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="extensionReportsDataTable" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Research title</th>
							<th>Short description</th>
							<th>Project cost</th>
							<th>Funding source</th>
							<th>Agency</th>
							<th>SDG/s addressed</th>
							<th>Beneficiaries</th>
							<th>Submitted by</th>
							<th>Campus</th>
							<th>File</th>
							<th>Photos</th>
							<th>Date submitted</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>ID</th>
							<th>Research title</th>
							<th></th>
							<th>Project cost</th>
							<th>Funding source</th>
							<th>Agency</th>
							<th>SDG/s addressed</th>
							<th></th>
							<th>Submitted by</th>
							<th></th>
							<th></th>
							<th>Photos</th>
							<th>Date submitted</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	@section('ajax-request')
	<script type="text/javascript">
		$(document).ready(function() {
			let reportTitle = $('#reportTitle').data("textval");
			$('#extensionReportsDataTable').DataTable({
				"columnDefs": [{
					"targets": [2,7],
      				"render": $.fn.dataTable.render.ellipsis(10)
				},{ "orderable": false, "targets": [10,11] }],
				"order": [[ 12, "desc" ]],
				"dom": "Bfrtip",
				"buttons": [
					{
						"extend": 'print',
						"title": reportTitle,
						"customize": function ( win ) { 
							$(win.document.body) .css('font-size', '12pt') .prepend( '<img src="http://127.0.0.1:8000/assets/images/prints/header-logo.png" style="width:100%;height:auto;" /> <hr style="position:relative; top:-60px;">' ); 
							$(win.document.body).find( 'table' ) .addClass( 'compact table table-striped' ) .css( 'font-size', '16px' ); },
						"exportOptions": { "columns": ':visible', "stripHtml" : false }
					},
					{
						"extend": 'colvis',
                		"collectionLayout": 'fixed two-column'
					},
				],
				"responsive": true,
				"processing": false,
				"serverSide": false,
				"ajax":{
					"url": "{{ route('extension-report-data',$card->id) }}",
					"type": "GET"
				},
				columns: [
			    	{ "data": "id" },
			    	{ "data": "title" },
			    	{ "data": "short_description" },
			    	{ "data": "project_cost" },
			    	{ "data": "funding_source" },
					{ "data": "agency" },
					{ "data": "sdgs_addressed" },
					{ "data": "beneficiaries" },
					{ "data": "submitted_by" },
					{ "data": "campus" },
					{ "data": "file_url" },
					{ "data": "photos" },
					{ "data": "created_at" },
				],
				initComplete: function () {
					this.api().columns([0,1,3,4,5,6,8,9,12]).every( function () {
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