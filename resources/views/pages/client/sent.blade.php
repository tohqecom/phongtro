@extends('layouts.app')

@section('title') Sent Inquiry Messages @endsection

@section('content')
@include('includes.navin')
 
<div class="container-fluid">
	<br/><br/><br/>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3>Sent Inquiry Message</h3>
			@include('includes.showsuccess')
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Receiver</th>
						<th>on Post</th>
						<th>Date Received</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($messages as $msg)
						<tr>
							<td><a href="{{ route('show_profile', $msg->post->user->id) }}">{{ $msg->post->user->firstname . ' ' . $msg->post->user->lastname}}</a></td>
							<td>{{ $msg->post->title }}</td>
							<td>{{ $msg->created_at }}</td>
							<td>
								<div class="row">
								<div class="col-md-6 nopadding">
								<form action="{{ route('read_sent') }}" method="POST">
									<input type="hidden" name="msg_id" value="{{ $msg->id }}" />
									<input type="hidden" name="_token" value="{{ csrf_token() }}" />
									<button class="btn btn-info btn-xs" type="submit">View</button>
								</form>
								</div>
								<div class="col-md-6 nopadding">
								<form action="{{ route('delete_sent') }}" method="POST">
									<input type="hidden" name="msg_id" value="{{ $msg->id }}" />
									<input type="hidden" name="_token" value="{{ csrf_token() }}" />
									<button class="btn btn-danger btn-xs" type="submit">Delete</button>
								</form>
								</div>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>				
			</table>
			<strong>{{ $messages->count() }} of {{ $messages->total() }}</strong>
			{{ $messages->render() }}
		</div>
	</div>
</div>
@endsection