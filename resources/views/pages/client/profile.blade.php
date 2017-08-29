@extends('layouts.app')

@section('title') User Profile @endsection

@section('content')
@include('includes.navin')
<div class="container">
	<br/><br/>
	<h2 class="">My Profile</h2>
	@include('includes.showerrors')
	@include('includes.showerror')
	@include('includes.showsuccess')
	<img style="margin-bottom:10px;" src="/uploads/profiles/{{ Auth::user()->profile }}" class="user-profile-img" alt="{{ Auth::user()->firstname }}" />
	<span><a href="{{ route('profile-edit') }}">Edit Profile</a></span>
	<div class="row">
		<div class="col-md-4">
			<table class="table">
				<tr>
					<td>Full Name:</td>
					<td>
						{{ Auth::user()->firstname }}
						{{ Auth::user()->lastname }}
					</td>
				</tr>
				<tr>
					<td>Email:</td>
					<td>{{ Auth::user()->email }}</td>
				</tr>
				<tr>
					<td>Mobile Number:</td>
					<td>{{ Auth::user()->mobile }}</td>
				</tr>
				<tr>
					<td>Birthday:</td>
					<td>{{ Auth::user()->birthday }}</td>
				</tr>
				<tr>
					<td>Gender:</td>
					<td>{{ Auth::user()->gender }}</td>
				</tr>
					<td>Privelege:</td>
					<td>{{ Auth::user()->privelege }}</td>
				</table>
			</table>
		</div>
	</div>
</div>
@endsection