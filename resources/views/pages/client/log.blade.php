@extends('layouts.app')

@section('title') User Log @endsection

@section('content')
@include('includes.navin')
<div class="container">
	<br/><br/>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3>Logs</h3>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Action</th>
						<th>Date and Time</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($logs as $log)
						<tr>
							<td>{{ $log->action }}</td>
							<td>{{ $log->created_at }}</td>
						</tr>
					@endforeach
				</tbody>
				
			</table>
			<strong>{{ $logs->count() }} of {{ $logs->total() }}</strong>
			{{ $logs->render() }}
		</div>
	</div>

</div>
@endsection