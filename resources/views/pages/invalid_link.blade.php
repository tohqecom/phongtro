@extends('layouts.app')

@section('title') Invalid Link @endsection

@section('content')
<div class="container-fluid">
	<h3><a href="{{ route('home') }}">Go to Home</h3>
	<div class="row">
		<br/>
		<div class="col-md-8 col-md-offset-2">
			@include('includes.showerror')
		</div>
	</div>
</div>
@endsection