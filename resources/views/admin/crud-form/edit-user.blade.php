	<div class="row">	
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="border-right: 1px solid#ccc;">
			<form action="{{ route('register-users.update', $register_user->id) }}" method="POST" role="form">	
				<div class="form-group">
					<legend>Profile</legend>
				</div>
				<div class="form-group">
					@csrf
					<input name="_method" type="hidden" value="PUT">
					<label for="fullname">Fullname</label>
					<input type="text" id="fullname" class="form-control" value="{{ $register_user->name }}" name="name" required>
				</div>				
				<div class="form-group">
					<label for="position">Position</label>
					<input type="text" id="position" class="form-control" value="{{ $register_user->position }}" name="position" required>
				</div>
				<div class="form-group">
					<label for="campuses">Campus</label>
					<select id="campuses" name="campuses" class="form-control" required>
						<option>{{ $register_user->campuses }}</option>
						@foreach($campuses as $campus)
							<option>{{ $campus }}</option>
						@endforeach
					</select>
				</div>	
				<button type="submit" class="btn btn-primary btn-icon-split">
					<span class="icon text-white-50">
						<i class="fas fa-edit"></i>
					</span>
					<span class="text">Update</span>
				</button>
			</form>	
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<form action="{{ route('admin.update.register-user-account', $register_user->id) }}" method="POST">
				<div class="form-group">
					<legend>Account</legend>
				</div>
				<div class="form-group">
					@csrf
					<input name="_method" type="hidden" value="PUT">
					<label for="Email">Email</label>
					<input type="email" id="email" class="form-control" name="email" value="{{ $register_user->email }}" required>
				</div>				
				<div class="form-group">
					<label for="password">New password</label>
					<input type="password" id="password" class="form-control" name="password" required>
				</div>
				<button type="submit" class="btn btn-primary btn-icon-split">
					<span class="icon text-white-50">
						<i class="fas fa-edit"></i>
					</span>
					<span class="text">Update</span>
				</button>
			</form>
			</div>
	</div>