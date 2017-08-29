@extends('layouts.app')

@section('title') Pending Posts @endsection

@section('content')
@include('pages.admin.adminnav')
<div class="container">
@include('includes.showerror')
@include('includes.showsuccess')
	<div class="row">
		@if($posts->isEmpty())
			<h3>No Available Pending Posts</h3>
		@endif
		@foreach($posts as $post)
		<div class="col-md-3 post">
			<div class="panel panel-default">
				<div class="panel-body">
					
					@foreach($post->postImage as $img)
						<img src="/uploads/posts/{{ $img->name }}" alt="{{ $post->title }}" class="img-posts" /> 
						@break
					@endforeach
					<h3>{{ $post->title }}</h3>
				
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
						<tr>
							<form action="{{ route('aprove-post',$post->id) }}" method="GET">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<td><button class="btn btn-info btn-sm">Aprove</button></td>
							</form>
							<form action="{{ route('delete-pending-post', $post->id) }}" method="GET">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<td><button class="btn btn-info btn-sm">Delete</button></td>
							</form>
						</tr>
					</table>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<strong>{{ $posts->count() }} of {{ $posts->total() }}</strong>
	{{ $posts->links() }}
</div>
@endsection