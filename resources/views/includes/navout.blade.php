<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#appNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="javascript:void(0);">Neofita's Rooms & Apartelle</a>
		</div>
		<div class="collapse navbar-collapse" id="appNavbar">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<!-- <li><img src="img/logo.png" alt="processing" class="img-responsive rest"></a></li>
					<li><span class="icon-bar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li> -->
					<li class="{{ $homeactive }}"><a href="{{ route('home') }}">Home</a></li>
					<li class="{{ $aboutactive }}"><a href="{{ route('about') }}">About</a></li>
					
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<!-- <li class="{{ $signinactive }}"><a href="{{ route('signin') }}">Signin</a></li>
					<li class="{{ $signupactive }}"><a href="{{ route('signup') }}">Signup</a></li> -->

					<li class="w3-right"><a class="" href="javascript:void(0)" id="auth"
			onclick="document.getElementById('authentication').style.display='block'">SignIn/SignUp</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>