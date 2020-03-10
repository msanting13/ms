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
	<hr>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">List of Extension Report Forms</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table" id="researchCardDataTable">
					<thead>
						<tr>
							<th>ID#</th>
							<th>Status</th>
							<th>Type</th>
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
	@section('ajax-request')
		<script type="text/javascript">
			$(document).ready(function() {
			    $('#researchCardDataTable').DataTable({
			    	"columnDefs": [{ 
			    		"orderable": false, "targets": [1,8]
			    	}],
			    	"order": [[ 7, "desc" ]],
			    	"processing": false,
			    	"serverSide": false,
			    	"ajax":{
			    		"url": "{{ route('director-reports.data','extension') }}",
			    		"type": "GET"
			    	},
			    	"columns": [
			    	{ "data": "id" },
			    	{ "data": "status" },
			    	{ "data": "card_name" },
			    	{ "data": "description" },
			    	{ "data": "fiscal_year" },
			    	{ "data": "message" },
			    	{ "data": "deadline" },
			    	{ "data": "created_at" },
			    	{ "data": "action" },
			    	],
			    	"drawCallback": function(settings){
			    	}
			    });
			});
		</script>
	@endsection
@endsection