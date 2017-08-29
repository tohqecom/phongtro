@extends('layouts.app')

@section('title') Edit User Profile @endsection

@section('content')
@include('includes.navin')
<div class="container">
	<h2 class="">Edit My Profile</h2>
	<img src="/uploads/profiles/{{ Auth::user()->profile }}" class="user-profile-img" alt="{{ Auth::user()->firstname }}" />
	<div class="row">
	<div class="col-md-4">
		<form action="{{ route('profile_update') }}" method="POST" enctype="multipart/form-data" role="form" >
		
			<div class="form-group">
				<label for="profile">Choose Image</label>
				<input type="file" name="profileimg" id="profile" accept="jpg, jpeg, png" />
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6"> 
						<input type="text" name="firstname" id="firstname" value="{{ Auth::user()->firstname }}" class="form-control" placeholder="First Name" required="" />
					</div>
					<div class="col-md-6"> 
						<input type="text" name="lastname" id="lastname" value="{{ Auth::user()->lastname }}" class="form-control" placeholder="Last Name" required="" />
					</div>
				</div>
			</div>	
			<div class="form-group"> 
				<input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="Email" required="" />
			</div>
			<div class="form-group"> 
				<input type="text" name="mobile" id="mobile" value="{{ Auth::user()->mobile }}" class="form-control" placeholder="Mobile Number" required="" />
			</div>
			<div class="form-group"> 
				<input type="text" name="bday" id="bday" value="{{ Auth::user()->birthday }}" class="form-control" placeholder="Birthday" required="" />
			</div>
			<div class="form-group"> 
				<label for="male">Male</label>
				<input type="radio" name="gender" id="male" value="Male" required="" />
				<label for="female">Female</label>
				<input type="radio" name="gender" id="female" value="Female" />
			</div>
			<div class="form-group">
				<input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<button type="submit" class="btn btn-primary">Update</button>
				<a href="{{ route('profile') }}" class="btn btn-default">Back to Profile</a>
			</div>
		</form>
	</div>
	</div>
</div>
@endsection