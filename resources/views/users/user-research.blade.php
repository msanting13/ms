@extends('layouts.layout-master')
@section('title','Research')
@section('statusResearch','active')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Research</h1>
{{-- 		@if(Auth::user()->hasRole('role_admin'))
			<a href="#modal-id" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"><i class="fas fa-plus fa-sm text-white-50"></i> Create Report</a>
		@endif --}}
	</div>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Submission’s</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table" id="researchCardDataTable">
					<thead>
						<tr>
							<th>ID#</th>
							<th>Type</th>
							<th>Description</th>
							<th>Fiscal year</th>
							<th>Remark</th>
							<th>Status</th>
							<th>Date created</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>ID#</th>
							<th>Type</th>
							<th>Description</th>
							<th>Fiscal year</th>
							<th>Remark</th>
							<th>Status</th>
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
			    		"orderable": false, "targets": [5,7]
			    	}],
			    	"order": [[ 6, "desc" ]],
			    	"processing": false,
			    	"serverSide": false,
			    	"ajax":{
			    		"url": "{{ route('user-reports.data','research') }}",
			    		"type": "GET"
			    	},
			    	"columns": [
			    	{ "data": "id" },
			    	{ "data": "card_name" },
			    	{ "data": "description" },
			    	{ "data": "fiscal_year" },
			    	{ "data": "message" },
			    	{ "data": "status" },
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