@extends('layouts.layout-master')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Account Settings</h1>
	</div>
	<!-- Content Row -->
	<div class="row">
      <!-- Research Card -->
      <div class="col-xl-6 col-md-6 mb-4">
              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                </div>
                <div class="card-body">
                  <form action="{{ action('AccountSettingsController@update', Auth::id()) }}" method="POST" role="form">
                    <div class="form-group">
                      @csrf
                      <input name="_method" type="hidden" value="PUT">
                      <label for="fullname">Fullname</label>
                      <input type="text" id="fullname" class="form-control" value="{{ Auth::user()->name }}" name="name" required>
                    </div>        
                    <div class="form-group">
                      <label for="position">Position</label>
                      <input type="text" id="position" value="{{ Auth::user()->position }}" class="form-control" name="position" required>
                    </div>
                    <div class="form-group">
                      <label for="campuses">Campus</label>
                      <select id="campuses" name="campuses" class="form-control" required>
                        <option>{{ Auth::user()->campuses }}</option>
                        @foreach($campuses as $campus)
                          <option>{{ $campus }}</option>
                        @endforeach
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </form>
                </div>
              </div>
      </div>
      <div class="col-xl-6 col-md-6 mb-4">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Account Picture</h6>
          </div>
          <div class="card-body">
            <form action="{{ action('AccountSettingsController@updateCredentials', Auth::id()) }}" method="POST" role="form">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <div class="form-group" style="text-align: center;">
                    <img class="img-profile rounded-circle" src="/assets/images/users/{{ (!is_null(Auth::user()->picture)) ? Auth::user()->picture : 'user.png' }}" style="width: 120px;">
                </div>   
                <div class="form-group" style="text-align: center;">  
                    <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Change</a>
                </div>
            </form>
          </div>
        </div>
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Account</h6>
          </div>
          <div class="card-body">
            <form action="{{ action('AccountSettingsController@updateCredentials', Auth::id()) }}" method="POST" role="form">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <div class="form-group">
                  <label for="Email">Email</label>
                  <input type="email" id="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                </div>     
                <div class="form-group">
                  <label for="currentpassword">Current password</label>
                  <input type="password" id="currentpassword" class="form-control" name="currentpassword" required>
                </div>   
                <div class="form-group">
                  <label for="password">New password</label>
                  <input type="password" id="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                  <label for="confirmpassword">Confirm your new password</label>
                  <input type="password" id="confirmpassword" class="form-control" name="password_confirmation" required>
                </div>
              <button type="submit" class="btn btn-primary">Save</button>
            </form>
          </div>
        </div>
      </div>
	</div>
  <div class="modal fade" id="modal-id">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload Photo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <form action="{{ action('AccountSettingsController@changeProfilePicture', Auth::id()) }}" method="POST" role="form" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              @csrf
              <input name="_method" type="hidden" value="PUT">
              <label for="">Choose photo</label>
              <input type="file" class="form-control" id="profilepix" name="image">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @section('ajax-request')
    @include('sweet::alert')
  @endsection
@endsection