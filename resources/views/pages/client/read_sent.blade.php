@extends('layouts.app')

@section('title') Read Sent @endsection

@section('content')
@include('includes.navin')
<div class="container-fluid">
	<br/><br/><br/>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<a href="{{ route('sent_msg') }}" class="btn btn-primary btn-xs">Back to Sent Inquiry</a>
			<br/><br/>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<strong>Message Details</strong>
				</div>
				<div class="panel-body">
					<p>To: <strong><a href="{{ route('show_profile', $message->post->user->id) }}">{{ $message->post->user->firstname . ' ' . $message->post->user->lastname}}</a></strong></p>
					<p>Email: <strong>{{ $message->post->user->email }}</strong></p>
					<p>Mobile: <strong>{{ $message->post->user->mobile }}</strong></p>
					<br/>
					<p>Message: <i>{{ $message->message }}</i></p>
					<br/>
					<p>Date Sent: <i>{{ $message->created_at }}</i></p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection