@extends('layouts.app')

@section('title') Active Posts @endsection

@section('content')
@include('pages.admin.adminnav')
<div class="container">

	<div class="row">
		@if($posts->isEmpty())
			<h3>No Available Active Posts</h3>
		@else
			<h3>Active Posts</h3>
		@endif
		@foreach($posts as $post)
		<div class="col-md-3 post">
			<div class="panel panel-default">
				<div class="panel-body">
					<strong>{{ $post->title }}</strong>
				
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
							<td>Created:</td>
							<td>{{ date('m-d-Y',strtotime($post->created_at)) }}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<strong>{{ $posts->count() }} of {{ $posts->total() }}</strong>
	{{ $posts->render() }}
	</div>
</div>
@endsection