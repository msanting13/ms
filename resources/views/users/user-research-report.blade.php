@extends('layouts.layout-master')
@section('title',"Research - {$card->card_name} FY {$card->fiscal_year}")
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Research</h1>
        <div class="btn-group" role="group" aria-label="Basic example">
			<a href="{{ route('user-research') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            <a href="{{ route('user-research-reports.create', $card->id) }}" class="btn btn-sm btn-primary submit-report {{ ($card->is_lock)? 'disabled' : '' }}"><i class="fas fa-upload fa-sm text-white-50"></i> Submit report</a>
        </div>
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
            <a href="{{ route('user-submitted-research-report.export-pdf',encrypt($card->id)) }}" class="btn btn-info btn-sm" target="_blank">
                <i class="fas fa-print"></i>
                Print
			</a>
			<br>
			<br>
			<div class="table-responsive">
				<table class="table" id="researchCardDataTable">
					<thead>
						<tr>
							<th>ID#</th>
							<th>Research title</th>
							<th>Project cost</th>
							<th>Funding source</th>
							<th>Agency</th>
							<th>SDG/s addressed</th>
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
							<th>Date submitted</th>
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
				
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				}); 

			    $('#researchCardDataTable').DataTable({
			    	"columnDefs": [{ 
			    		"orderable": false, "targets": [7]
			    	}],
			    	"order": [[ 6, "desc" ]],
			    	"processing": false,
			    	"serverSide": false,
			    	"ajax":{
			    		"url": "{{ route('user-research-reports.data',[$card->id,'research']) }}",
			    		"type": "GET"
			    	},
			    	"columns": [
			    	{ "data": "id" },
			    	{ "data": "title" },
			    	{ "data": "project_cost" },
			    	{ "data": "funding_source" },
			    	{ "data": "agency" },
			    	{ "data": "sdgs_addressed" },
			    	{ "data": "created_at" },
					{ "data": "action" },
			    	],
			    	"drawCallback": function(settings){
						deleteFunction();
						usersPostReports();
			    	}
			    });
			});
		</script>
		<script src="/js/custom/users-post-report.js"></script>
	@endsection
@endsection