@extends('layouts.app')

@section('title') Select Payment Method @endsection

@section('content')
@include('includes.navin')
<div class="container-fluid">
	<br/><br/>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			@include('includes.showerrors')
			@include('includes.showsuccess')
			<h3>Payment Method</h3>
			<hr/>
			@if(empty($payment))
			<form action="{{ route('payment_method') }}" method="POST">
				<div class="form-group">
					<label for="paypal">Paypal</label>
					<input type="radio" name="payment" id="paypal" value="paypal" />
					<label for="remittance">Remittance</label>
					<input type="radio" name="payment" id="remittance" value="remittance" />
				</div>
				<div class="form-group">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<button class="btn btn-primary">Continue</button>
				</div>
			</form>
			@endif
			@if(!empty($payment))
				<strong>Reference Number:</strong>{{ $payment->reference_number }}
				<br/>
				<strong>Payment Method:</strong> {{ ucwords($payment->payment_method) }}
				@if($payment->payment_method == 'paypal')
					<br/>
					<a href="https://www.paypal.me/Joparpards/1" target="_blank" class="btn btn-primary btn-xs">Click here to pay to Paypal</a>
				@endif
				<p><i>Note: Email Admin once payed.</i></p>
			@endif
			<hr/>
			<h4>Paypal </h4>
			<p>This link will open new tab on Paypal where you can pay your activation fee. This will also generate reference number, that will use to activate your account. Send a screenshot of the payment and reference number to admin email for activation</p>
			<hr/>
			<h4>Remittance Center</h4>
			<p>This will generate a reference number, that you will use to activate your account. Pay at any Cebuana or LBC branch scan the copy of remittance/sending slip and send it together with the reference number of your account activation to email of the admin for activation</p>
		</div>
	</div>
</div>
@endsection