@extends('layouts.app')

@section('title') Read Message @endsection

@section('content')
@include('includes.navin')
<div class="container-fluid">
	<br/><br/><br/>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<a href="{{ route('inbox') }}" class="btn btn-primary btn-xs">Back to Inbox</a>
			<br/><br/>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<strong>Message Details</strong>
				</div>
				<div class="panel-body">
					<p>Sender: <strong><a href="{{ route('profile') }}">{{ $message->sendBy->firstname . ' ' . $message->sendBy->lastname}}</a></strong></p>
					<p>Email: <strong>{{ $message->sendBy->email }}</strong></p>
					<p>Mobile: <strong>{{ $message->sendBy->mobile }}</strong></p>
					<p>Message: <i>{{ $message->message }}</i></p>
					<br/>
					<p>Post Title: <strong>{{ $message->post->title }}</strong></p>
					<br/>
					<p>Date Send: <strong>{{ $message->created_at }}</strong></p>
					
				</div>
			</div>
		</div>
	</div>

</div>
@endsection