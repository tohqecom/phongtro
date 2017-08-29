@extends('layouts.app')

@section('title') Edit Post @endsection

@section('content')
@include('includes.navin')
<div class="container">
	<br/><br/><br/>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			@include('includes.showerrors')
			@include('includes.showerror')
			@include('includes.showsuccess')
			<div class="panel panel-info">
				<div class="panel-heading">
					<b>Update Post Form</b>
				</div>
				<div class="panel-body">
					<form action="{{ route('postupdatepost') }}" method="POST" role="form" enctype="multipart/form-data" autocomplete="off">
						<div class="form-group">
							<input type="text" name="title" id="title" placeholder="Title" value="{{ $title }}" class="form-control" />
						</div>
						<div class="form-group">
							<input type="number" min="0" name="price" id="price" placeholder="Price Rate" value="{{ $price }}" class="form-control" />
						</div>
						<div class="form-group">
							<textarea name="description" id="description" class="form-control" placeholder="Enter Description" rows="8">{{ $description }}</textarea>
						</div>
						<div class="form-group">
							<input type="text" name="location" id="location" value="{{ $location }}" placeholder="City Location Ex: Manila" class="form-control" />
						</div>
						<div class="form-group">
							<input type="file" name="images[]" id="images" accept=".jpg, .jpeg" multiple="" />
						</div>
						<div class="form-group">
							<input type="hidden" name="post_id" value="{{ $id }}" />
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<button class="btn btn-info" type="submit">Update Post</button>
							<button class="btn btn-info" type="reset">Revert Changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection