@extends('layouts.app')

@section('title') Admin Login @endsection

@section('content')
<div class="container">
	<h2 class="text-center">Admin Login</h2>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel panel-heading panel-admin">
					<b>Admin Login</b>
				</div>
				<div class="panel panel-body">
					<form action="{{ route('admin_login') }}" method="POST" role="form" autocomplete="off">
						<div class="form-group">
							<input type="text" name="email" id="email" class="form-control" placeholder="Email" />
						</div>
						<div class="form-group">
							<input type="password" name="password" id="password" class="form-control" placeholder="Password" />
						</div>
						<div class="form-group">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<button type="submit" class="btn btn-info">Login</button>
						</div>
					</form>
				</div>
			</div>
			<a href="{{ route('home') }}" title="Back to Home">&lt;&lt;--- Back to Home</a>
		</div>
	</div>
</div>
@endsection