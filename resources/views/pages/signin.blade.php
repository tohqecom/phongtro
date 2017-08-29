@extends('layouts.app')

@section('title') Signin @endsection

@section('content')
@include('includes.navout')
<div class="container-fluid">
	<br/><br/><br/>
	<h2 class="text-center">Room and Appartment Rentals</h2>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<b>Signin</b>
				</div>
				<div class="panel-body">
				@include('includes.showerror')
				@include('includes.showerrors')
				@include('includes.showsuccess')
					<form action="user_signin" method="post" role="form" autocomplete="off">
						<div class="form-group">
							<input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email" required="required" {{ session('signin')? 'autofocus' : '' }} autofocus="" />
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required" />
						</div>
						<!-- <div class="form-group">
							<input type="checkbox" name="remember" id="remember"/>
							<label for="remember">Remember Me?</label>
						</div>  -->
						<div class="form-group">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<button type="submit" class="btn btn-info">Login</button>
							<button type="reset" class="btn btn-info">Clear Fields</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@include('includes.signin-register')
@endsection