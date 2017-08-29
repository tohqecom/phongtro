@extends('layouts.app')

@section('title') Members @endsection

@section('content')
@include('pages.admin.adminnav')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h3>Member's List</h3>
			<table class="table table-hover">
				<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>Birthday</th>
					<th>Status</th>
				</tr>
				</thead>
				<tbody>
				@foreach($members as $member)
				<tr>
					<td>{{ $member->firstname . ' ' . $member->lastname }}</td>
					<td>{{ $member->email }}</td>
					<td>{{ $member->mobile }}</td>
					<td>{{ $member->birthday }}</td>
					<td>
						@if($member->status == 'Active')
							<span class="btn btn-success btn-xs">Active</span>
						@else
							<span class="btn btn-warning btn-xs">Inactive</span>
						@endif
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
			<strong>{{ $members->count() }} of {{ $members->total() }}</strong>
			{{ $members->render() }}
		</div>
	</div>
</div>
@endsection