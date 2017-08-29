@extends('layouts.app')

@section('title') FullName @endsection

@section('content')
@include('includes.navin')
<div class="container">
	<br/><br/><br/>
	<div class="row">
		<div class="col-md-6">
			<h3>User Contact Information</h3>
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
			</table>
		</div>
	</div>
</div>
@endsection