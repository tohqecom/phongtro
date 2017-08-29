<!DOCTYPE html>
<html lang="en" font="CastroScript">
<head>
	<title>@yield('title') Neofita's Appartment and Room Rental</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="Keywords" content="appartment, room, rentals, rental, board, bording, house" />
	<meata name="description" content="Online Posting and Rentals of Appartments and Rooms" />
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
	<link rel="stylesheet" href="{{asset('css/bootstrap-social.css') }}"/>
	<link rel="stylesheet" href="{{asset('css/font-awesome.css') }}"/>
	<link rel="stylesheet" href="{{asset('css/font-awesome.min.css') }}"/> 
	<link rel="stylesheet" href="{{ asset('css/custom.css')}}" />
	<script src="{{ asset('js/angular.min.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('css/w3.css') }}">
	<link rel="stylesheet" href="{{ asset('fonts/CastroScript.ttf') }}"/>
	<script src="{{ asset('js/modernizr.min.js') }}"></script>
	<script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/bootstrap.js') }}"></script>

	<!-- Bootstrap Datepicker -->
	<link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
	<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
	
</head>
<body>

	@yield('content')
	<div style="display:none" id="popup">
		<br/><br/><br/><br/>
		<div id="popup_msg">
		<!-- <br/><br/><br/><br/><br/><br/><br/><br/>	<h3 class="text-center">"Welcome to Neofita's Rooms &amp; Apartelle we will Help you find your Sweet Home"</h3> -->
		</div>
	</div>
	<script>
		$(document).ready(function() {

		    if(localStorage.getItem('popState') != 'shown'){
		        $("#popup").delay(2000).fadeIn();
		        localStorage.setItem('popState','shown')
		    }

		    $('#popup-close').click(function(e) // You are clicking the close button
		    {
		    $('#popup').fadeOut(); // Now the pop up is hiden.
		    });
		    $('#popup').click(function(e) 
		    {
		    $('#popup').fadeOut(); 
		    });
		});
	</script>
</body>
</html>