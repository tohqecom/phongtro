@extends('layouts.app')

@section('title') User Log @endsection

@section('content')
@include('pages.admin.adminnav')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
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
			{{ $logs->render() }}
		</div>
	</div>

</div>
@endsection