@extends('layouts.app')

@section('title') Home @endsection

@section('content')
@include('includes.navout')
<div class="container conbody">
<div class="col-md-6 col-xs-6 headline" >Make your move</div>
	<div class="col-md-6 col-xs-6 sub-headline">Search and apply to Hundreds of apartments</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 searchbox">
		<!-- @if (count($errors) > 0)
		    <div class="alert alert-danger">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif -->
			<form action="{{ route('guest-search') }}" method="POST" role="form">
				<div class="form-group">
					<div class="input-group ">

						<input type="text" name="keyword" id="keyword" class="form-control" placeholder="Find your Home now! e.g Tagbilaran">

						<span class="input-group-btn">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<button class="btn btn-info" type="submit">Go!</button>
						</span>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>
<div class="container break">
		<div class="row">
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-12">
						<h3>About</h3>
						<p>A good Apartelle shouldn’t be necessarily expensive. Check this out yourself.</p>
						<p> Book a room and get all possible comfort We offer. We work for you to enjoy your stay.</p>	
					</div>
					<div class="col-lg-12" style="padding-top:50px;">
						<p class="p-font"><span class="glyphicon glyphicon-map-marker icon"></span> 6300 Booy District,Tagbilaran City Bohol</p>
						<p class="p-font"><span class="glyphicon glyphicon-earphone icon"></span> 0950-2810-005</p>
						<p class="p-font"><span class="glyphicon glyphicon-envelope icon"></span> joshuapards@gmail.com</p>
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="row">
					<div class="col-lg-6 pad-top">
							<p>&nbsp; &nbsp;Neofita Apartelle & Rooms Advertisement And Informtion System is a small and wildly ambitious startup tackling a problem that affects over Millions renters across the Philippines.We believe that renters shouldn't engage with technology only to search for their next home or apartment rental.</p>
<p>&nbsp; &nbsp; We believe that you should be able to walk into an open house or appointment, pull out your phone, and make a binding application and offer for that unit right there. This is how the next generation of the rental market will function, and Neofita Apartelle & Rooms Adverticement And Informtion System  — with a unique twinned B2B (business-to-business) and Consumer approach — is leading the way.</p>
					<br>
					<br>
				<center><b><h5 class="gr">© By Neofita Room And Apartel 2016</h5></b></center>
					</div>
					<div class="col-lg-6 ">
						<div class="pad-top">
							<!-- <div class="boxshadow"> -->
							<img src="img/sample.png" alt="processing" class="img-responsive boxshadow">
							<!-- </div> -->

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <hr/> -->
		</div>
<!-- 		<div class="row">
	<section class="footer">
   			<div class="container">
   				<div class="row">
   					<div class="col-lg-3">
   						<ul class="nav navbar-sidebar sidebar">
   							<li><a href="">Home Page</a></li>
   							<li><a href="">About Us</a></li>
   							<li><a href="">Location & Contacts</a></li>
   						</ul>
   					</div>
   					<div class="col-lg-3">
   						<ul class="nav navbar-sidebar sidebar">
   							<li><a href="">Facebook</a></li>
   							<li><a href="">Twitter</a></li>
   							<li><a href="">Instagram</a></li>
   							<li><a href="">Youtube</a></li>
   						</ul>
   					</div>  -->
   		<!-- <div class="col-lg-6">
   						<div class="row">
   							<div class="col-lg-4"></div>
   							<div class="col-lg-8">
   							<h6>Contact Us</h6>
   								<form action="" method="">
   									<div class="form-group">
   										<input type="email" class="form-control gry" id="email" placeholder = "Email" required>
   									</div>
   									<div class="form-group">
   										<textarea class="form-control gry" id="comment" Placeholder="Comment" required></textarea>
   									</div>
   									<div class="form-group">
   										<button class="btn btn-default btns"  style="width:inheret;" type="submit">Submit</button>
   									</div>
   								</form>
   							</div>
   						</div>
   					</div> 
   				</div>-->
   	<!-- 			<div class="row copyright">
   					<div class="col-lg-12">
   						<center><h6 class="gr">© By Neofita Room And Apartel 2016</h6></center>
   					</div>
   				</div>
   			</div> -->
   			</section>

@include('includes.signin-register')

@endsection
