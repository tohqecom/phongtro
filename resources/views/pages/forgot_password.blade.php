@extends('layouts.app')

@section('title') Reset Password Form @endsection

@section('content')
<div class="container-fluid ">
	<div class="row top-margin-50">
		<div class="col-md-offset-4 col-md-4">
			<p><a href="{{ route('home') }}" class="btn btn-info btn-md">Back to Home</a></p>

			@include('includes.showerror')
			@include('includes.showsuccess')
			@include('includes.showerrors')
			<h3>Password Reset</h3>
			<form action="{{ route('reset_password') }}" method="POST" role="form">
				<div class="form-group">
					<input type="text" name="email" id="email" class="form-control" placeholder="Your Email Here" />
				</div>
				<div class="form-group">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<button class="btn btn-info pull-right" type="submit">Continue</button>
				</div>
			</form>
			
		</div>
	</div>
</div>
@endsection