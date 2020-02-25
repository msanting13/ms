@extends('layouts.layout-master')
@section("title",'Extension')
@section('statusResearch','active')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Extension</h1>
		@if(Auth::user()->hasRole('role_user') || Auth::user()->hasRole('role_director'))
			<div class="btn-group" role="group" aria-label="Basic example">
			  <button type="button" class="btn btn-sm btn-secondary" onclick="goBack()"><i class="fas fa-arrow-left"></i> Back</button>
			  <button type="button" class="btn btn-sm btn-primary submit-report {{ ($card->is_lock)? 'disabled' : '' }}" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $card->id }}" data-backdrop="static"><i class="fas fa-upload fa-sm text-white-50"></i> Submit report</button>
			</div>
		@else
			<button type="button" class="btn btn-sm btn-secondary" onclick="goBack()"><i class="fas fa-arrow-left"></i> Back</button>
		@endif
	</div>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">
				@if($card->is_lock)
					<i class="fas fa-lock fa-md fa-fw" style="color: #e74a3b;"></i>
				@else
					<i class="fas fa-unlock fa-md fa-fw" style="color: #36b9cc;"></i>
				@endif
				{{ $card->card_name.' '.$card->fiscal_year }}
			</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="ExtensionReportsDataTable">
					<thead>
						<tr>
							<th>ID#</th>
							<th>Extension title</th>
							<th>Project cost</th>
							<th>Funding source</th>
							<th>Agency</th>
							<th>SDG/s addressed</th>
							<th>Submitted by</th>
							<th>Date submitted</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>ID#</th>
							<th>Research title</th>
							<th>Project cost</th>
							<th>Funding source</th>
							<th>Agency</th>
							<th>SDG/s addressed</th>
							<th>Submitted by</th>
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
			    $('#ExtensionReportsDataTable').DataTable({
			    	"columnDefs": [{ 
			    		"orderable": false, "targets": [8]
			    	}],
			    	"order": [[ 7, "desc" ]],
			    	"processing": true,
			    	"serverSide": true,
			    	"ajax":{
			    		"url": "{{ route('extension.report.card.data',$card->id) }}",
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
		            {data: 'created_at', name: 'created_at'},
		            {data: 'action', name: 'action'},
		            ],
			    	"drawCallback": function(settings){
			    		deleteFunction();
			    	}
			    });
			});
		</script>
		<script src="/js/custom/submit-extension-report-ajax.js"></script>
		<script src="/js/custom/view-report-details-ajax.js"></script>
		<script src="/js/custom/edit-extension-report-ajax.js"></script>
		<script src="/js/custom/edit-extension-report-photos-ajax.js"></script>
		@include('sweet::alert')
	@endsection
@endsection