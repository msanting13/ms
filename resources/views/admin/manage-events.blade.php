@extends('layouts.layout-master')
@section('title','Manage Events')
@section('statusUser','active')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Events</h1>
		@if(Auth::user()->hasRole('role_admin'))
			<a href="#modal-id" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"><i class="fas fa-plus fa-sm text-white-50"></i> Post Event</a>
		@endif
	</div>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Events List</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="eventsDataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>ID#</th>
							<th>Event name</th>
							<th>Location</th>
							<th>Date</th>
							<th>Created at</th>
							<th>status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>ID#</th>
							<th>Event name</th>
							<th>Location</th>
							<th>Date</th>
							<th>Created at</th>
							<th>status</th>
							<th>Action</th>
						</tr>
					</tfoot>
				</table>
				
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-id">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add Event</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" role="form">	
						<div class="form-group">
							@csrf
							<label for="eventName">Event name *</label>
							<input type="text" id="eventName" name="name" class="form-control" required>
						</div>	
						<div class="form-group">
							<label for="location">Location *</label>
							<input type="text" id="location" name="location" class="form-control" required>
						</div>
						<label>Start</label>
						<div class="row">					
							<div class="form-group col-md-7">
								<div class="input-group date" id="startDateTimePicker">
									<input type='text' class="form-control" id="startdate" name="startdate" placeholder="Date">
									<div class="input-group-append input-group-addon">
										<button class="btn btn-primary" type="button">
											<i class="fas fa-calendar fa-sm"></i>
										</button>
									</div>
								</div>
							</div>	
							<div class="form-group col-md-5">
								<div class="input-group date" id="startTimeDateTimePicker">
									<input type='text' class="form-control" id="startime" name="starttime" placeholder="Time">
									<div class="input-group-append input-group-addon">
										<button class="btn btn-primary" type="button">
											<i class="fas fa-clock fa-sm"></i>
										</button>
									</div>
								</div>
							</div>	
						</div>
						<label>End</label>
						<div class="row">					
							<div class="form-group col-md-7">
								<div class="input-group date" id="endDateTimePicker">
									<input type='text' class="form-control" id="enddate" name="enddate" placeholder="Date">
									<div class="input-group-append input-group-addon">
										<button class="btn btn-primary" type="button">
											<i class="fas fa-calendar fa-sm"></i>
										</button>
									</div>
								</div>
							</div>	
							<div class="form-group col-md-5">
								<div class="input-group date" id="endtimeDateTimePicker">
									<input type='text' class="form-control" id="endtime" name="endtime" placeholder="Time">
									<div class="input-group-append input-group-addon">
										<button class="btn btn-primary" type="button">
											<i class="fas fa-clock fa-sm"></i>
										</button>
									</div>
								</div>
							</div>	
						</div>
						<div class="form-group">
							<input type='checkbox' class='js-switch all-day' value="false" name="allday"><label>All day</label>
						</div>
						<div class="form-group">
							<label>Description *</label>
							<textarea class="form-control makeMeRichTextarea" id="{{ uniqid() }}" name="description" required></textarea>
						</div>		
						<button type="submit" class="btn btn-primary btn-icon-split">
							<span class="icon text-white-50">
								<i class="fas fa-plus"></i>
							</span>
							<span class="text">Save</span>
						</button>	
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	@include('includes.modal')
	@section('ajax-request')
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#eventsDataTable').DataTable({
		    	"columnDefs": [{ 
		    		"orderable": false, "targets": [1,6]
		    	}],
		    	"processing": true,
		    	"serverSide": true,
		    	"ajax":{
		    		"url": "{{ route('event.data') }}",
		    		"type": "POST",
		    		"data":{ _token: "{{csrf_token()}}"}
		    	},
		    	"columns": [
		    	{ "data": "id" },
		    	{ "data": "event_name" },
		    	{ "data": "location" },
		    	{ "data": "date" },
		    	{ "data": "created_at" },
		    	{ "data": "switch" },
		    	{ "data": "action" },
		    	],
		    	"drawCallback": function(settings){
					initJSwitch('.switch');
					initbootstrapSwitch();
					postUpostSwitcher();
		    		deleteFunction();
		    	}
		    });
		});
	</script>
	<!--All-day-->
	<script>
		$(document).ready(function () {
		 	$(document).on('change', '.all-day', function(a){
		 		a.preventDefault();
		 		let state = $(this).val();
		 		if (state == 'false') {
		 			$(this).val(true);
		 			$("#endtime,#startime").attr("disabled", "disabled");
		 			$("#endtime,#startime").val("12:00 AM");
		 		}
		 		else{
		 			$(this).val(false);
		 			$("#startime,#endtime").removeAttr("disabled");
		 			$("#startime").val("12:00 PM");
		 			$("#endtime").val("01:00 PM");
		 		}
			});    
		}); 
	</script>
	<!--Ckeidtor-->
	<script>
		$('.makeMeRichTextarea').each( function () {
			CKEDITOR.replace(this.id,options)
		});
	</script>
	<script type="text/javascript" src="/js/custom/edit-event-ajax.js"></script>
	@include('sweet::alert')
	@endsection
	@section('publisher','/events/status/');
@endsection
