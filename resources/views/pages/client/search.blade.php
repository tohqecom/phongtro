@extends('layouts.app')

@section('title') Search for Rooms and Appartments @endsection

@section('content')
@include('includes.navin')
<div class="container searchpost">
	<div class="row">
	<div class="col-md-4 col-md-offset-4">
	<br/><br/><br/>
	<div class="panel panel-info">
		<div class="panel-heading"><b>Search a Room/Appartment</b></div>
		<div class="panel-body">
			<form action="{{ route('searchresult') }}" method="POST" role="form">
				<div class="form-group">
					<label for="room">Room</label>
					<input type="radio" name="type" id="room" value="Room" required="required" />
					<label for="appartment">Appartment</label>
					<input type="radio" name="type" id="appartment" value="Appartment" required="required" />
				</div>
				<div class="form-group">
					<input type="number" value="" name="max_price" id="max_price" class="form-control" placeholder="Maximum Price" required="" />
				</div>
				<div class="form-group">
					<input type="text" value="" name="location" id="location" class="form-control" placeholder="Location" required="" />
				</div>
				<div class="form-group">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<button type="submit" class="btn btn-info">Search</button>
					<button type="reset" class="btn btn-info">Clear Fields</button>
				</div>
			</form>
		</div>
	</div>
	</div>
	</div>
</div>
@endsection