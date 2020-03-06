@extends('layouts.layout-master')
@section('title','Manage Announcement')
@section('statusUser','active')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Announcement</h1>
		@if(Auth::user()->hasRole('role_admin'))
			<a href="#modal-id" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"><i class="fas fa-plus fa-sm text-white-50"></i> Post Announcement</a>
		@endif
	</div>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Announcement List</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="announcementDataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>ID#</th>
							<th>Title</th>
							<th>Created at</th>
							<th>status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>ID#</th>
							<th>Title</th>
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
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Post Announcement</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data" role="form">	
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="border-right: 1px solid#ccc;">
								<div class="form-group">
									<legend>Info</legend>
								</div>
								<div class="form-group">
									@csrf
									<label for="Title">Title *</label>
									<input type="text" id="Title" class="form-control" name="title" required>
								</div>				
								<div class="form-group">
									<label>Overview *</label>
									<textarea class="form-control makeMeRichTextarea" id="{{ uniqid() }}" name="overview" required></textarea>
								</div>	
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="height: 480px; overflow: auto;">
								<div class="form-group">
									<legend>Content</legend>
								</div>
								<div class="form-group">
									<label for="Content">Full Content *</label>
									<textarea class="form-control makeMeRichTextarea" id="{{ uniqid() }}" name="content" required></textarea>
								</div>				
								<button type="submit" class="btn btn-primary btn-icon-split">
									<span class="icon text-white-50">
										<i class="fas fa-plus"></i>
									</span>
									<span class="text">Save</span>
								</button>
							</div>
						</div>					
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

	        $('.makeMeRichTextarea').each( function () {
	          CKEDITOR.replace(this.id,options)
	        });

		    $('#announcementDataTable').DataTable({
		    	"columnDefs": [{ 
		    		"orderable": false, "targets": [1,4]
		    	}],
		    	"processing": true,
		    	"serverSide": true,
		    	"ajax":{
		    		"url": "{{ route('announcement.data') }}",
		    		"type": "POST",
		    		"data":{ _token: "{{csrf_token()}}"}
		    	},
		    	"columns": [
		    	{ "data": "id" },
		    	{ "data": "title" },
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
	<script type="text/javascript" src="/js/custom/edit-announcement-ajax.js"></script>
	@include('sweet::alert')
	@endsection
	@section('publisher','/announcements/status/');
@endsection
