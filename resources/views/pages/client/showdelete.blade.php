@extends('layouts.app')

@section('title') Delete Multiple Posts @endsection

@section('content')
@include('includes.navin')
<div class="container">
	@if(empty($posts))
		<br/>
		<h3>No Post to Delete</h3>
	@endif
	@include('includes.showerror')
	@include('includes.showsuccess')
	@if(!empty($posts))
	<form action="{{ route('delete_multiple_post') }}" method="POST"> 
	<div class="row">
		<br/><br/><br/>
	@foreach($posts as $post)
		<div class="col-md-2">
		<div class="form-group">
			<input type="checkbox" name="postid[]" id="post{{ $post->id }}" value="{{ $post->id }}" />
			<label for="post{{ $post->id }}">{{$post->title}}</label>
			<br/>
			<b>{{ $post->price }}</b>
			<br/>
			<b>{{ $post->location }}</b>
		</div>
		</div>
	@endforeach
	</div>
	<br/>
	<br/>
	@if(count($posts) < 1)
		<h3>No Post to Delete</h3>
	@else
		<div class="form-group">
			<input type="checkbox" name="confirm" id="confirm" required="required" />
			<label for="confirm">Check This Box For Confirm Deletion</label>
		</div>
		<div class="form-group">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<button type="submit" class="btn btn-danger btn-large">Delete</button>
		</div>
	@endif
	</form>
	@endif
</div>
@endsection