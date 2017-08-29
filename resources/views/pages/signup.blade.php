@extends('layouts.app')

@section('title') Signup @endsection

@section('content')
@include('includes.navout')
<div class="container conbody">
	<h2 class="text-center">Room and Appartment Rentals</h2>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<b>Signup</b>
				</div>
				<div class="panel-body">
				@include('includes.showerror')
				@include('includes.showerrors')
				@include('includes.showsuccess')
					<form action="user_signup" method="POST" role="form" autocomplete="off">
						<div class="form-group">
							<input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email" required="required" class="form-control" />
						</div>
						<div class="form-group">
							<input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" placeholder="First Name" required="required | regex:/^[\p{L} .'-]+$/u" class="form-control" />
						</div>
						<div class="form-group">
							<input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" placeholder="Last Name" required="required" class="form-control" />
						</div>
						<div class="form-group">
							<input type="text" name="bday" id="bday" value="{{ old('bday') }}" placeholder="mm/dd/yy e.g 4/28/1995" required="required" class="form-control" />
						</div>
						<div class="form-group">
							<label for="gender-male">Male</label>
							<input type="radio" name="gender" id="gender-male" value="Male" required="required" />
							<label for="gender-female">Female</label>
							<input type="radio" name="gender" id="gender-female" value="Female" />
						</div>
						<div class="form-group">
							<input type="number" name="mobile" id="mobile" value="{{ old('mobile') }}" placeholder="Mobile Number Ex: 09234567890" required="required" class="form-control" />
						</div>
						<div class="form-group">
							<input type="password" name="password" id="password" placeholder="Password" required="required" class="form-control" />
						</div>
						<div class="form-group">
							<input type="password" name="password_confirmation" id="password_confirmation" placeholder="Re-enter Password" required="required" class="form-control" />
						</div>
						<div class="form-group">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<button type="submit" class="btn btn-info">Singup</button>
							<button type="reset" class="btn btn-info">Clear Fields</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection