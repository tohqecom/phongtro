<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#appNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('admin_home') }}">Welcome Admin!</a>
		</div>
		<div class="collapse navbar-collapse" id="appNavbar">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li><a href="{{ route('admin_home') }}">Home</a></li>
					<li class="dropdown">
						<a id="dLabel" data-target="#" href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						    Members <span class="caret"></span>
						</a>
						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li><a href="{{ route('members') }}">Member's List</a></li>
							<li><a href="{{ route('search_member') }}">Activate Member</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a id="dLabel" data-target="#" href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						    Member's Posts <span class="caret"></span>
						</a>
						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li><a href="{{ route('pending-posts') }}">Pending Posts</a></li>
							<li><a href="{{ route('active-posts') }}">Active Posts</a></li>
						</ul>
					</li>
					
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a id="dLabel" data-target="#" href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						    <img src="/uploads/profiles/{{ Auth::user()->profile }}" style="width:20px; height:20px;border-radius: 50%;">
						    <span class="caret"></span>
						</a>

						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li><a href="{{ route('admin_profile') }}">Admin Profile</a></li>
							<li><a href="{{ route('change_admin_password') }}">Change Password</a></li>
							<li><a href="{{ route('admin_log') }}">Admin Log</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('logout') }}">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>