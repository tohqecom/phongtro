@extends('layouts.app')

@section('title') My Posts @endsection

@section('content')
@include('includes.navin')
<div class="container">
	<br/><br/>
	@if($posts->isEmpty())
		<h3>No Post to Show</h3>
		<a href="{{ route('addpost') }}" class="btn btn-link">Create Post</a>
	@endif
	@if(count($posts) > 0)
		<h3>My Posts</h3>
	@endif
	@include('includes.showerror')
	@include('includes.showsuccess')
	@include('includes.showerrors')	
	<div class="row"> 
	
		@foreach($posts as $post)
		<div class="col-md-3">
			@if($post->availability == 'Available')
				<form action="{{ route('make_reserved') }}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="hidden" name="post_id" value="{{ $post->id }}" />
					<button type="submit" class="btn btn-warning btn-xs">Mark as Reserved</button>
				</form>
				<form action="{{ route('make_occupied') }}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="hidden" name="post_id" value="{{ $post->id }}" />
					<button type="submit" class="btn btn-danger btn-xs">Mark as Occupied</button>
				</form>
			@endif

			@if($post->availability == 'Not Available')
				<form action="{{ route('make_available') }}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="hidden" name="post_id" value="{{ $post->id }}" />
					<button type="submit" class="btn btn-info btn-xs">Mark as Available</button>
				</form>
				<form action="{{ route('make_occupied') }}"" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="hidden" name="post_id" value="{{ $post->id }}" />
					<button type="submit" class="btn btn-info btn-xs">Mark as Occupied</button>
				</form>
			@endif

			@if($post->availability == 'Occupied')
				<form action="{{ route('make_reserved') }}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="hidden" name="post_id" value="{{ $post->id }}" />
					<button type="submit" class="btn btn-info btn-xs">Mark as Reserved</button>
				</form>
				<form action="{{ route('make_available') }}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="hidden" name="post_id" value="{{ $post->id }}" />
					<button type="submit" class="btn btn-info btn-xs">Mark as Available</button>
				</form>
			@endif
			<br/>
			

			@foreach($post->postImage as $img)
				<img src="/uploads/posts/{{ $img->name }}" alt="{{ $post->title }}" class=" round img-posts " /> 
				@break
			@endforeach

			</br><br/>
			@if($post->availability == 'Available')
				<span class="btn btn-success btn-xs">Available</span>
			@endif
			
			@if($post->availability == 'Not Available')
				<span class="btn btn-warning btn-xs">Reserved</span>
			@endif

			@if($post->availability == 'Occupied')
				<span class="btn btn-danger btn-xs">Occupied</span>
			@endif

			<br/>
			Title: <strong>{{ $post->title }}</strong>
			<br/>
			Type: <strong>{{ $post->type }}</strong>
			<br/>
			Monthly: <strong>‎₱{{ $post->price }}</strong>
			<br/>
			Location: <strong>{{ $post->location }}</strong>
			<br/>
			<div style="float:left;">
			Description: <p><i>‎{{ $post->description }}</i></p>
			</div>
			Status: <strong>{{ $post->status }}</strong>
			<br/>
			<a href="{{ route('edit-post',$post->id) }}"><button class="btn btn-info btn-xs">Update</button></a>
			<a href="{{ route('delete-post', $post->id) }}"><button class="btn btn-info btn-xs">Delete</button></a>
		</div>
		@endforeach
	</div>
	<div class="center-div">
		<br/>
		<strong>{{ $posts->count() }} of {{ $posts->total() }}</strong>
		{{ $posts->render() }}
	</div>
</div>
@endsection