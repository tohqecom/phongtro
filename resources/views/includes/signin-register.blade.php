<div id="authentication" class="w3-modal">
		<!-- <span
			onclick="document.getElementById('authentication').style.display='none'"
			class="w3-closebtn w3-grey w3-hover-red w3-container w3-padding-16 w3-display-topright">X</span> -->

		<div class="w3-modal-content w3-card-8 w3-animate-zoom"
			style="max-width: 600px">

			<div class="col-md-6 w3-card-8 w3-blue" onclick="openForm('Login')">
				<h3>Sign In</h3>
			</div>
			<div class="col-md-6 w3-card-8 w3-blue"
				onclick="openForm('Register')">
				<h3>Sign Up</h3>
			</div>
			<div style="margin-top: 25px !important;">
				<div id="Login" class="w3-container form">
					<div class="w3-container ">
						<div class="w3-section">
							<br/><br/>
							<div class="panel-body">
							@include('includes.showerror')
							@include('includes.showerrors')
							@include('includes.showsuccess')
								<form action="{{ route('user_signin') }}" method="post" role="form" autocomplete="off">
									<div class="form-group">
										<input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email" required="required" {{ session('signin')? 'autofocus' : '' }} autofocus="" />
									</div>
									<div class="form-group">
										<input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required" />
									</div>
									<div class="form-group">
									<!-- 	<input type="checkbox" name="remember" id="remember"/>
										<label for="remember">Remember Me?</label> -->
										<a href="{{ route('forgot_password') }}" class="pull-right"><label>Forgot Password?</label></a>
									</div>
									<div class="form-group">
										<input type="hidden" name="_token" value="{{ csrf_token() }}" />
										<button type="submit" class="btn btn-info">Login</button>
										<!-- <button type="reset" class="btn btn-info">Clear Fields</button> -->
										<button
										onclick="document.getElementById('authentication').style.display='none'"
										type="button" class="btn btn-info">Cancel</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="w3-container w3-border-top w3-padding-16 ">
						<!-- <button
							onclick="document.getElementById('authentication').style.display='none'"
							type="button" class="w3-btn w3-red">Cancel</button> -->
					</div>
				</div>
			</div>
			<div id="Register" class="w3-container form ">
				<div class="w3-container">
					<div class="w3-section">
						<br/><br/>
						<div class="panel-body">
						@include('includes.showerror')
						@include('includes.showerrors')
						@include('includes.showsuccess')
						<form action="{{ route('user_signup') }}" method="POST" role="form" autocomplete="off">
							<div class="form-group">
								<select name="user_type" id="user_type" class="form-control">
									<option value="">User Type</option>
									<option value="Border">Border</option>
									<option value="Member">Member</option>
								</select>
							</div>
							<div class="form-group">
								<input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email" required="required" class="form-control" />
							</div>
							<div class="form-group">
								<input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" placeholder="First Name" required="required" class="form-control" />
							</div>
							<div class="form-group">
								<input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" placeholder="Last Name" required="required" class="form-control" />
							</div>
							<div class="form-group">
								<input type="text" name="bday" id="datepicker1" data-date="" data-date-format="dd-mm-yyyy" value="{{ old('bday') }}" placeholder="mm/dd/yy e.g 4/28/1995" readonly="" required="required" class="form-control" />
							</div>
							<div class="form-group">
								<label for="gender-male">Male</label>
								<input type="radio" name="gender" id="gender-male" value="Male" required="required" />
								<label for="gender-female">Female</label>
								<input type="radio" name="gender" id="gender-female" value="Female" />
							</div>
							<div class="form-group">
								<input type="number" name="mobile" id="mobile" value="{{ old('mobile') }}" placeholder="Mobile Number Ex: 09234567890" required="required" class="form-control" />
							</div>
							<div class="form-group">
								<input type="password" name="password" id="password" placeholder="Password" required="required" class="form-control" />
							</div>
							<div class="form-group">
								<input type="password" name="password_confirmation" id="password_confirmation" placeholder="Re-enter Password" required="required" class="form-control" />
							</div>
							<div class="form-group">
								<input type="hidden" name="_token" value="{{ csrf_token() }}" />
								<button type="submit" class="btn btn-info">Singup</button>
								<!-- <button type="reset" class="btn btn-info">Clear Fields</button> -->
								<button
						onclick="document.getElementById('authentication').style.display='none'"
						type="button" class="btn btn-info">Cancel</button>
							</div>
						</form>
					</div>
					</div>
				</div>
				<div class="w3-container w3-border-top w3-padding-16 ">
					<!-- <button
						onclick="document.getElementById('authentication').style.display='none'"
						type="button" class="w3-btn w3-red">Cancel</button> -->
				</div>
			</div>
		</div>
	</div>
	<div class="fluid-container"></div>
<script>
	$('#datepicker1').datepicker({
		format: 'mm-dd-yyyy'
	});
</script>
<script>	
openForm("Login");
function openForm(formName) {
    
    var x = document.getElementsByClassName("form");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    document.getElementById(formName).style.display = "block";  
}
</script>
@if(session('error_msg'))
	<script>
		$(document).ready(function(){
		  $('#auth').click();
		});
	</script>
@endif
@if (count($errors) > 0)
	<script>
		$(document).ready(function(){
		  $('#auth').click();
		  openForm('Register');
		});
	</script>
@endif
@if (session('message'))
	<script>
		$(document).ready(function(){
		  $('#auth').click();
		  openForm('Register');
		});
	</script>

@endif