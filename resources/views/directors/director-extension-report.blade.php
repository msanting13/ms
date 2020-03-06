@extends('layouts.layout-master')
@section('title',"Extension - {$card->card_name} FY {$card->fiscal_year}")
@section('statusResearch','active')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Extension</h1>
        <div class="btn-group" role="group" aria-label="Basic example">
			<a href="{{ route('director-extension') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            <a href="{{ route('director-extension-reports.create', $card->id) }}" class="btn btn-sm btn-primary submit-report {{ ($card->is_lock)? 'disabled' : '' }}"><i class="fas fa-upload fa-sm text-white-50"></i> Submit report</a>
        </div>
	</div>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h5 class="m-0 font-weight-bold text-primary">
				{{ $card->card_name." "."FY ".$card->fiscal_year }}
				@if($card->is_lock)
					<i class="fas fa-lock fa-md fa-fw" style="color: #e74a3b;"></i>
				@else
					<i class="fas fa-unlock fa-md fa-fw" style="color: #36b9cc;"></i>
				@endif
			</h5>
			<h6 class="m-0 font-weight-bold text-primary">
				Description: {{ $card->description }}
			</h6>
			<h6 class="m-0 font-weight-bold text-primary">
				Deadline: {{ $card->deadline->format('F d,Y') }}
			</h6>
		</div>
		<div class="card-body">
            <a href="{{ route('user-submitted-extension-report.export-pdf',encrypt($card->id)) }}" class="btn btn-info btn-sm" target="_blank">
                <i class="fas fa-print"></i>
                Print
			</a>
			<br>
			<br>
			<div class="table-responsive">
				<table class="table" id="extensionCardDataTable">
					<thead>
						<tr>
							<th>ID#</th>
							<th>Title</th>
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
							<th>Title</th>
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

			    $('#extensionCardDataTable').DataTable({
			    	"columnDefs": [{ 
			    		"orderable": false, "targets": [7]
			    	}],
			    	"order": [[ 6, "desc" ]],
			    	"processing": false,
			    	"serverSide": false,
			    	"ajax":{
			    		"url": "{{ route('director-extension-reports.data',[$card->id,'extension']) }}",
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