@extends('layouts.app')

@section('title') Reset Password @endsection

@section('content')
<div class="container-fluid">
	<div class="row top-margin-50">
		<div class="col-md-4 col-md-offset-4">
			@include('includes.showerrors')
			<h3>Enter Your New Password:</h3>
			<form action="{{ route('password_reset') }}" method="POST" role="form">
				<div class="form-group">
					<input type="password" name="password" id="password" placeholder="Enter New Password" class="form-control" />
				</div>
				<div class="form-group">
					<input type="password" name="password_confirmation" id="password_confirmation" placeholder="Re-Enter New Password" class="form-control" />
				</div>
				<div class="form-group">
					<input type="hidden" name="id" value="{{ $id }}" />
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<button type="submit" class="btn btn-info">Change Password</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection