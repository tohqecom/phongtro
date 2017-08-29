@extends('layouts.app')

@section('title') Browse Rooms and Appartments @endsection

@section('content')
@include('includes.navin')
<div class="container browsepage">
	<br/><br/>
	@if(count($posts) > 0)
		<strong>Room and Appartments</strong>
	@endif
	<div class="row">
		@if(count($posts) < 1)
			<h3>No Available Post</h3>
		@endif

		@foreach($posts as $post)
		<div class="col-md-3 post">

			@if($post->availability == 'Available')
				<span class="btn btn-success btn-xs">Available</span>
			@endif
			@if($post->availability == 'Not Available')
				<span class="btn btn-warning btn-xs">Reserved</span>
			@endif
			@if($post->availability == 'Occupied')
				<span class="btn btn-danger btn-xs">Occupied</span>
			@endif
			<br/><br/>
			<a href="{{ route('post', ['id' => $post->id]) }}">
			@foreach($post->postImage as $img)
				<img src="/uploads/posts/{{ $img->name }}" alt="{{ $post->title }}" class="img-posts" /> 
				@break
			@endforeach
			<h3>{{ $post->title }}</h3>
			</a>
			<table class="table">
				<tr>
					<td>Type:</td>
					<td>{{ $post->type }}</td>
				</tr>
				<tr>
					<td>Price:</td>
					<td>{{ $post->price }}</td>
				</tr>
				<tr>
					<td>Location:</td>
					<td>{{ $post->location }}</td>
				</tr>
				
			</table>
		</div>
		@endforeach
	</div>
	<br/>
	<strong>{{ $posts->count() }} of {{ $posts->total() }}</strong>
	{{ $posts->render() }}
</div>
@endsection