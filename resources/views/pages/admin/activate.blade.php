@extends('layouts.app')

@section('title') Admid Dashboard @endsection

@section('content')
@include('pages.admin.adminnav')
<div class="container">
	<div class="row">
		@include('includes.showerrors')
		@include('includes.showerror')
		@include('includes.showsuccess')
		<div class="col-md-4">
			<h3>Search Member to Activate: </h3>
			<form action="{{ route('search_member') }}" method="POST" autocomplete="off">
				<div class="form-group">
					<input type="text" name="ref_num" id="ref_num" class="form-control" placeholder="Search by Reference Number" />
				</div>
				<div class="form-group">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button class="btn btn-primary" type="submit">Search</button>
				</div>
			</form>	
		</div>
	</div>
	@if(!empty($payment))
	<div class="row">
		<div class="col-md-12">
			<h3>Member Request</h3>
			<strong>Name: {{ $payment->member->firstname }} {{ $payment->member->lastname }}</strong>
			<br/>
			<strong>Reference Number: {{ $payment->reference_number }}</strong>
			<br/>
			<form action="{{ route('post_activate_member') }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="payment_id" value="{{ $payment->id }}" />
				<button class="btn btn-primary" type="submit">Activate Member</button>	
			</form>
			

		</div>
	</div>
	@endif
</div>
@endsection