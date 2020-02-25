@extends('layouts.layout-master')
@section('title','Research')
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
			<h6 class="m-0 font-weight-bold text-primary">Reports</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table" id="extensionBoardDataTable">
					<thead>
						<tr>
							<th>ID#</th>
							<th>Name</th>
							<th>Fiscal year</th>
							<th>Remark</th>
							<th>Status</th>
							<th>Submitted</th>
							<th>Date updated</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>ID#</th>
							<th>Name</th>
							<th>Fiscal year</th>
							<th>Remark</th>
							<th>Status</th>
							<th>Submitted</th>
							<th>Date updated</th>
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
			    $('#extensionBoardDataTable').DataTable({
			    	"columnDefs": [{ 
			    		"orderable": false, "targets": [7]
			    	}],
			    	"order": [[ 6, "desc" ]],
			    	"processing": true,
			    	"serverSide": true,
			    	"ajax":{
			    		"url": "{{ route('extensions.card.data','extension') }}",
			    		"type": "POST",
			    		"data":{ _token: "{{csrf_token()}}"}
			    	},
			    	"columns": [
			    	{ "data": "id" },
			    	{ "data": "card_name" },
			    	{ "data": "fiscal_year" },
			    	{ "data": "message" },
			    	{ "data": "status" },
			    	{ "data": "counts" },
			    	{ "data": "updated_at" },
			    	{ "data": "action" },
			    	],
			    	"drawCallback": function(settings){
			    		deleteFunction();

			    		$(".lock-btn").click(function(){
			    			let id = $(this).data('id');
			    			swal({
			    				title: 'Lock?',
			    				text: "",
			    				icon: 'warning',
			    				buttons: true,
			    			}).then((isConfirm) => {
			    				if (isConfirm) {
			    					document.getElementById('lock-form'+id).submit(); 
			    				} 
			    			})
			    		});
			    		$(".unlock-btn").click(function(){
			    			let id = $(this).data('id');
			    			swal({
			    				title: 'Unlock?',
			    				text: "",
			    				icon: 'warning',
			    				buttons: true,
			    			}).then((isConfirm) => {
			    				if (isConfirm) {
			    					document.getElementById('unlock-form'+id).submit(); 
			    				} 
			    			})
			    		});
			    	}
			    });
			});
		</script>
		<script src="/js/custom/edit-card-ajax.js"></script>
		<script src="/js/custom/edit-message-ajax.js"></script>
		<script src="/js/custom/submit-extension-report-ajax.js"></script>
		@include('sweet::alert')
	@endsection
@endsection