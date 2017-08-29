@extends('layouts.app')

@section('title') Admin Profile @endsection

@section('content')
@include('pages.admin.adminnav')
<div class="container">
	@include('includes.showsuccess')
	<div class="row">
		<div class="col-md-6">
			<h3>Admin Information</h3>
			<table class="table table-hover">
				<tr>
					<td>Name:</td>
					<td>{{ $firstname }}  {{ $lastname }}</td>
				</tr>
				<tr>
					<td>Mobile:</td>
					<td>{{ $mobile }}</td>
				</tr>
				<tr>
					<td>Email:</td>
					<td>{{ $email }}</td>
				</tr>
				<tr>
					<td>Birthday:</td>
					<td>{{ $birthday }}</td>
				</tr>
			</table>

			<a href="{{ route('admin_profile_edit') }}">Edit Profile</a>
		</div>
	</div>
</div>
@endsection