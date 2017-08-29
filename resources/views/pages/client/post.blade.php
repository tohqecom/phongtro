@extends('layouts.app')

@section('title') {{ $post->title }} @endsection

@section('content')
@include('includes.navin')
<div class="container postrest">
	<a href="{{ route('search') }}">Search</a> or <a href="{{ route('browse') }}">Browse</a>
	<div class="row">
	@include('includes.showsuccess')
	@include('includes.showerrors')
		<div class="col-md-8" ng-app ng-init="price={{ $post->price }}" >
			<div class="row">
				<div class="col-md-8">
					<br/>
					@if($post->availability == 'Available')
						<span class="btn btn-info btn-md">Available</span>
					@endif

					@if($post->availability == 'Not Available')
						<span class="btn btn-warning btn-md">Reserved</span>
					@endif

					<h3>{{ $post->title }}</h3>
					<p>by <a href="{{ route('post-user-profile', $post->user_id) }}" target="_blank"><strong>{{ $post->user->firstname . ' ' . $post->user->lastname }}</strong></a></p>
					<p>Email: <strong>{{ $post->user->email }}</strong></p>
					<p>Mobile: <strong>{{ $post->user->mobile }}</strong></p>
					<p>Type:  <strong>{{ $post->type }}</strong></p>
					<p>Location:  <strong>{{ $post->location }}</strong></p>
					<p>Monthly:  <strong>‎₱{{ $post->price }}</strong></p>
					<p>Dexcription:  <u><i>{{ $post->description }}</i></u></p>
				</div>
				<div class="col-md-4">
					<label>Month of Stay: <br>
					(please input 1 for 1 month
					and for half of a month or 15 days just put .5)<br>For example: 1 and a half month just put 1.5</label>
					<input type="number" min="0.01" step="0.01" name="number" id="number" value=0 ng-model="month_num" autofocus=""  required="numbers" />
					<!-- <input type="hidden" name="value" value={{ $post->price }} ng-model="price" /> -->
					<h3>Estimated Cost: @{{ month_num * price }}</h3>
				</div>
			</div>
			<div class="row">
				@foreach($post->postImage as $img)
					<div class="col-md-6 col-xs-6 post-img">
						<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal{{ $img->id }}"><img src="/uploads/posts/{{ $img->name }}" alt="{{ $post->title }}" class="img-posts" /></a> 

						<div class="modal fade" id="myModal{{ $img->id }}" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									<div class="modal-body">
										<img src="/uploads/posts/{{ $img->name }}" alt="{{ $post->title }}" class="img-responsive" />
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>

		</div>
		<div class="col-md-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<b>Send Message to Owner</b>
				</div>
				<div class="panel-body">
					<form action="{{ route('send_msg_post_owner') }}" method="POST" role="form">
						<div class="form-group">
							<input type="text" name="title" id="title" class="form-control uppercase" value="{{ $post->title }} @ {{ $post->location }}" readonly="" />
						</div>	
<!-- 						<div class="form-group">
							<input type="text" name="name" id="name" class="form-control" placeholder="Name" required="" />
						</div>
						<div class="form-group">
							<input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number" required="" />
						</div>
						<div class="form-group">
							<input type="text" name="email" id="email" class="form-control" placeholder="Email" required="" />
						</div> -->
						<div class="form-group">
						<textarea class="form-control" rows="10" name="message" id="message" placeholder="You message here..." required=""></textarea>
						</div>
						<div class="form-group text-right">
							<input type="hidden" name="id" value="{{ $post->user->id }}" />
							<input type="hidden" name="post_id" value="{{ $post->id }}" />
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<button type="sumbit" class="btn btn-info">Send</button>
							<button type="reset" class="btn btn-info">Clear</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection