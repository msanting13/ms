@extends('layouts.layout-master')
@section('title','Manage User')
@section('statusUser','active')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Users</h1>
		@if(Auth::user()->hasRole('role_admin'))
			<a href="#modal-id" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"><i class="fas fa-plus fa-sm text-white-50"></i> Add User</a>
		@endif
	</div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">User's List</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    	<th>ID#</th>
                      	<th>Name</th>
                      	<th>Position</th>
                      	<th>Campuses</th>
                      	<th>Email</th>
                       	<th>Date Registered</th>
						<th>User</th>
						<th>Director</th>
						<th>Admin</th>
						<th>Assign</th>
                      	<th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    	<th>ID#</th>
                      	<th>Name</th>
                      	<th>Position</th>
                      	<th>Campuses</th>
                      	<th>Email</th>
                      	<th>Date Registered</th>
						<th>User</th>
						<th>Director</th>
						<th>Admin</th>
						<th>Assign</th>
                      	<th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  	@foreach($users as $user)
        				<tr>
						<form action="{{ route('admin.assign.role', $user->id) }}" method="post">
							@csrf
        					<td>{{ $user->id }}</td>
        					<td>{{ $user->name }}</td>
        					<td>{{ $user->position }}</td>
        					<td>{{ $user->campuses }}</td>
        					<td>{{ $user->email }}</td>
        					<td>{{ $user->created_at }}</td>
							<td><input type="checkbox" name="role_user" {{ $user->hasRole('role_user') ? 'checked' : '' }}></td>		
							<td><input type="checkbox" name="role_director" {{ $user->hasRole('role_director') ? 'checked' : '' }}></td>		
							<td><input type="checkbox" name="role_admin" {{ $user->hasRole('role_admin') ? 'checked disabled': '' }}></td>
							<td><button type="submit" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">Assign</button></td>
						</form>
        					<td>
								<div class="dropdown no-arrow">
									<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-900"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
										<div class="dropdown-header">Action:</div>

										<a class="dropdown-item edit-users" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $user->id }}" data-backdrop="static"><i class="fas fa-edit fa-sm fa-fw text-gray-600"></i> Edit</a>
										<div class="dropdown-divider"></div>

										<a class="dropdown-item btn-delete" href="javascript:void(0)" title="Delete" data-id="{{-- {{ $announcement->id }} --}}" data-textval="{{-- {{ $announcement->title }} --}}">
											<i class="fas fa-trash fa-sm fa-fw text-gray-600"></i>
											Delete
										</a>
										<form id="delete-form{{-- {{ $announcement->id }} --}}" action="{{-- {{ action('AnnouncementController@destroy',$announcement->id) }} --}}" method="POST">
											@csrf
											<input name="_method" type="hidden" value="DELETE">
										</form>
									</div>
								</div>
        					</td>	
        				</tr>
                  	@endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
	<div class="modal fade" id="modal-id">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<form action="{{ action('RegisterUserController@store') }}" method="POST" role="form">	
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="border-right: 1px solid#ccc;">
								<div class="form-group">
									<legend>Profile</legend>
								</div>
								<div class="form-group">
									@csrf
									<label for="fullname">Fullname</label>
									<input type="text" id="fullname" class="form-control" name="name" required>
								</div>				
								<div class="form-group">
									<label for="position">Position</label>
									<input type="text" id="position" class="form-control" name="position" required>
								</div>
								<div class="form-group">
									<label for="campuses">Campus</label>
									<select id="campuses" name="campuses" class="form-control" required>
										@foreach($campuses as $campus)
											<option>{{ $campus }}</option>
										@endforeach
									</select>
								</div>		
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<div class="form-group">
									<legend>Account</legend>
								</div>
								<div class="form-group">
									@csrf
									<label for="Email">Email</label>
									<input type="email" id="email" class="form-control" name="email" required>
								</div>				
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" id="password" class="form-control" name="password" required>
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
		<script type="text/javascript" src="/js/custom/edit-users-ajax.js"></script>
		<script type="text/javascript" src="/js/custom/switch-ajax.js"></script>
		@include('sweet::alert')
	@endsection
@endsection