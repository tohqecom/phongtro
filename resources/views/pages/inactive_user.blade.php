@extends('layouts.app')

@section('title') Inactive User Account @endsection

@section('content')
<div class="container text-center">
	<div class="col-md-6 col-md-offset-3">
		<h3>Activate Member Account</h3>
		<a href="{{ route('select_payment') }}" class="btn btn-primary btn-xs">Click Here To Activate Account</a>
		<hr/>
		<a href="{{ route('home') }}">Go to Home</a>
	</div>
</div>
@endsection