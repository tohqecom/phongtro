@extends('layouts.app')

@section('title') Admin Change Password @endsection

@section('content')
@include('pages.admin.adminnav')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			@include('includes.showerrors')
			@include('includes.showerror')
			@include('includes.showsuccess')
			<h3>Admin Password</h3>
			<form action="{{ route('update_admin_password') }}" method="POST" role="form">
				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control" required="" placeholder="Enter New Password" />
				</div>
				<div class="form-group">
					<input type="password" name="password_confirmation" id="newpass" class="form-control" required="" placeholder="Re-enter New Password" />
				</div>
				<div class="form-group">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<button class="btn btn-info" type="submit">Change Password</button>
					<a href="{{ route('admin_home') }}" class="btn btn-default">Home</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection