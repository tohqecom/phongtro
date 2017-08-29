@extends('layouts.app')

@section('title') Change Password @endsection

@section('content')
@include('includes.navin')
<div class="container">
	<br/><br/><br/>
	<h2>Change Password</h2>
	@include('includes.showerrors')
	@include('includes.showerror')
	@include('includes.showsuccess')
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<b>Change Password</b>
				</div>
				<div class="panel-body">
					<form action="{{ route('updatepass') }}" method="POST" role="form" autocomplete="off">
						<div class="form-group">
							<input type="password" name="old_password" id="old_password" class="form-control" placeholder="Current Password" required="" />
						</div>
						<div class="form-group">
							<input type="password" name="password" id="password" class="form-control" placeholder="New Password" required="" />
						</div>
						<div class="form-group">
							<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re Enter New Password" required="" />
						</div>
						<div class="form-group">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
							<button type="submit" class="btn btn-info">Apply Change</button>
							<button type="reset" class="btn btn-info">Clear</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection