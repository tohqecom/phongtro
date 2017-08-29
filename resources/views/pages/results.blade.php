<?php
    $homeactive = '';
    $aboutactive = '';
    $signinactive = '';
    $signupactive = '';
?>

@extends('layouts.app')

@section('title') Search Result @endsection

@section('content')
@include('includes.navout')
<div class="container">
	<br/><br/><br/>
	<h2>Search Result</h2>
	<div class="row">
		@if($posts->isEmpty())
	
			<h3>No Result for your search</h3></br>
			<p>Back to <a href="{{ route('home') }}">search</a></p>
		@endif
		@foreach($posts as $post)
		<div class="col-md-3 post">
			<a href="{{ route('post-guest', $post->id) }}">
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
	<strong>{{ $posts->count() }} of {{ $posts->total() }}</strong>
	{{ $posts->links() }}
</div>

@include('includes.signin-register')

@endsection