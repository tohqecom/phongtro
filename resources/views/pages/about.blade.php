@extends('layouts.app')

@section('title') About @endsection

@section('content')
@yield('navigation')
<br>
<br>
<br>
	<div class="container">
	<div class="col-md-12"><hr></div>
</div>
<div class="container">
	<div class="col-md-9">
	<script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script><div style='overflow:hidden;height:440px;width:800px;'><div id='gmap_canvas' style='height:440px;width:850px;'></div><div><small><a href="http://www.embedgooglemaps.com/en/">Generate your map here, quick and easy!									Give your customers directions									Get found</a></small></div><div><small><a href="https://binaireoptieservaringen.nl/">Wilt u geld verdienen met de handel in binaire opties, maar is het allemaal onduidelijk hoe dit precies werkt, en welke aanbieders betrouwbaar zijn? Lees dan verder op onze site: wij vergelijken aanbieders op betrouwbaarheid en kwaliteit. Zo komt u nooit voor verrassingen te staan. Wij van binaireoptieservaringen.nl helpen u graag!</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><script type='text/javascript'>function init_map(){var myOptions = {zoom:12,center:new google.maps.LatLng(9.6616165,123.84950149999997),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(9.6616165,123.84950149999997)});infowindow = new google.maps.InfoWindow({content:'<strong>My Location</strong><br>booy tagbilaran city<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>

	<br>
		<div class="caption">
        <h2>Neofita Apartelle & Rooms Advertisement And Informtion</h2>
        <p class="text">
        	<p class="p-indent"> Neofita Apartelle & Rooms Advertisement And Informtion System is a small and wildly ambitious startup tackling a problem that affects over Millions renters across the Philippines.We believe that renters shouldn't engage with technology only to search for their next home or apartment rental.</p>

	<p class="p-indent">We believe that you should be able to walk into an open house or appointment, pull out your phone, and make a binding application and offer for that unit right there. This is how the next generation of the rental market will function, and Neofita Apartelle & Rooms Adverticement And Informtion System  — with a unique twinned B2B (business-to-business) and Consumer approach — is leading the way.</p>
        </p>

      </div>
	</div>
<div class="col-md-3 form_bg">
		<h4>Neofitas's Rooms & Apartelle</h4>
		<hr/>
		<div>
			<p class="p-font"><span class="glyphicon glyphicon-map-marker icon"></span> 6300 Booy Dstrict,Tagbilaran &nbsp;&nbsp;&nbsp;&nbsp;City Bohol</p>
			<p class="p-font"><span class="glyphicon glyphicon glyphicon-phone-alt"></span> Landline: Coming Soon...</p>
			<p class="p-font"><span class="glyphicon glyphicon glyphicon-phone"></span> Mobile No:+639502810005</p>
			<p class="p-font"><span class="glyphicon glyphicon-envelope icon"></span> Mail: joshuapards@gmail.com</p>

		</div>
		<hr/>
		</div>
		<div class="col-md-3 form_bg2">
		<center><h4>Social</h4>
		<hr/>
			<div>
			  <a class="btn btn-block btn-social btn-facebook">
    <span class="fa fa-facebook"></span> Facebook Coming Soon</a>
		
			  <a class="btn btn-block btn-social btn-twitter">
    <span class="fa fa-twitter"></span> Twitter Coming Soon</a>

     <a class="btn btn-block btn-social btn-adn">
    <span class="fa fa-adn"></span> Instagram Coming Soon</a>
    	</div>
		<hr/> 
		
@include('includes.signin-register')

@endsection
