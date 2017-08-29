@extends('layouts.app')

@section('title') Update Admin Profile @endsection

@section('content')
@include('pages.admin.adminnav')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h3>Update Admin Profile</h3>
			<form action="{{ route('admin_profile_update') }}" method="POST" enctype="multipart/form-data" role="form">
				<div class="form-group">
					<input type="text" name="firstname" id="firstname" value="{{ $firstname }}" class="form-control" placeholder="First Name" required="" />
				</div>
				<div class="form-group">
					<input type="text" name="lastname" id="lastname" value="{{ $lastname }}" class="form-control" placeholder="Last Name" required="" />
				</div>
				<div class="form-group">
					<input type="text" name="mobile" id="mobile" value="{{ $mobile }}" class="form-control" placeholder="Mobile Number" required="" />
				</div>
				<div class="form-group">
					<input type="text" name="bday" id="bday" value="{{ $birthday }}" class="form-control" placeholder="Birth Day" required="" />
				</div>
				<div class="form-group">
					<input type="hidden" name="id" value="{{ $id }}" />
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<button class="btn btn-primary" type="submit">Update</button>
					<a href="{{ route('admin_profile') }}" class="btn btn-default">Back</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection