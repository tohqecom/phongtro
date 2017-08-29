start for owner privilege -->
@if(Auth::user()->privelege == 'Member')
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#appNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('home_user') }}">Neofita's Rooms & Apartelle</a>
		</div>
		<div class="collapse navbar-collapse" id="appNavbar">
			<div class="container-fluid">
				<ul class="nav navbar-nav">	
					<li><span class="icon-bar">&nbsp;&nbsp;&nbsp;&nbsp;</span></li>
					<li class=""><a href="{{ route('home_user') }}">Home</a></li>
					<li class=""><a href="{{ route('browse') }}">Browse Posts</a></li>
					<li class=""><a href="{{ route('search') }}">Search</a></li>
					<!-- Active -->
					@if(Auth::user()->status == 'Active')
					<li class="dropdown">
						<a id="dLabel" data-target="#"  href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						    My Posts
						    <span class="caret"></span>
						</a>

						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li><a href="{{ route('addpost') }}">Add Post</a></li>
							<li><a href="{{ route('myposts') }}">View Posts</a></li>
							<li><a href="{{ route('showposttodelete') }}">Delete</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a id="dLabel" data-target="#" href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<?php $unread = App\Message::where('recipient', Auth::user()->id)->where('status', 'Unread')->orderby('created_at', 'desc')->get() ?>
						    My Messages <span class="label label-danger label-as-badge">{{ count($unread) }}</span>
						    <span class="caret"></span>
						</a>

						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li><a href="{{ route('inbox') }}">Inbox <span class="label label-danger label-as-badge">{{ count($unread) }}</span></a></li>
							<!-- <li><a href="{{ route('sent_msg') }}">Sent Inquiry Message</a></li> -->
						</ul>
					</li>
					@endif
					<!-- Active -->
					<!-- Inactive -->
					@if(Auth::user()->status == 'Inactive')
					<li><a href="{{ route('select_payment') }}">Activate Account</a></li>
					@endif
					<!-- Inactive -->
					<li class=""><a href="{{ route('client_about') }}">About</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a id="dLabel" data-target="#" href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="{{ Auth::user()->firstname }}">
						    {{ Auth::user()->firstname }} <img src="/uploads/profiles/{{ Auth::user()->profile }}" style="width:20px; height:20px;border-radius: 50%;">
						    <span class="caret"></span>
						</a>

						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li><a href="{{ route('profile') }}">Member Profile</a></li>
							<li><a href="{{ route('changepass') }}">Change Password</a></li>
							<li><a href="{{ route('user_log') }}">Member Log</a></li>
							<li role="separator" class="divider"></li>
							@if(Auth::user()->status == 'Inactive')
							<li><a href="{{ route('select_payment') }}"><span  class="btn btn-warning btn-xs">Account Inactive</span></a>
							@endif
							@if(Auth::user()->status == 'Active')
							<li><a href="javascript:void(0)"><span  class="btn btn-success btn-xs">Account Active</span></a>
							@endif
							</li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('logout') }}">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>
@endif
<!-- end condition for owner privelege -->

<!-- start of border privilege -->
@if(Auth::user()->privelege == 'Border')
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#appNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('home_user') }}">Neofita's Rooms & Apartelle</a>
		</div>
		<div class="collapse navbar-collapse" id="appNavbar">
			<div class="container-fluid">
				<ul class="nav navbar-nav">	
					<li><span class="icon-bar">&nbsp;&nbsp;&nbsp;&nbsp;</span></li>
					<li class=""><a href="{{ route('home_user') }}">Home</a></li>
					<li class=""><a href="{{ route('browse') }}">Browse Posts</a></li>
					<li class=""><a href="{{ route('search') }}">Search</a></li>
					<li class=""><a href="{{ route('sent_msg') }}">My Inquiry</a></li>
					<li class=""><a href="{{ route('client_about') }}">About</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a id="dLabel" data-target="#" href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						    {{ Auth::user()->firstname }} <img src="/uploads/profiles/{{ Auth::user()->profile }}" style="width:20px; height:20px;border-radius: 50%;">
						    <span class="caret"></span>
						</a>

						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li><a href="{{ route('profile') }}">User Profile</a></li>
							<li><a href="{{ route('changepass') }}">Change Password</a></li>
							<li><a href="{{ route('user_log') }}">User Log</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('logout') }}">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>
@endif
<!-- end of border privilege -->