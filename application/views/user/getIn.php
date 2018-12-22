<script type="text/javascript">

$(document).ready(function() {

	$( ".trigger" ).on('click', function(){

		if($(this).attr('id') == 'signIn'){

			$('#signUpForm').hide();
			$('#signInForm').show();
		}
		else {

			$('#signInForm').hide();
			$('#signUpForm').show();
		}
	});

	var getInType = '<?=$data['type']?>';

	if(getInType == 'in')
		$( "#signIn" ).trigger( "click" );
	else
		// Show Registration form by default
		$( "#signUp" ).trigger( "click" );


	$( "#registerForm" ).submit(submitRegisterForm);
	$( "#loginForm" ).submit(submitLoginForm);
});

</script>

<div class="container">
	<div id="signUpForm" class="row justify-content-center">
		<div class="col-md-12 text-center">
			<div id="signUpHead">
				<h4>Sign Up</h4>
				<h5>Already registered? <a class="trigger" id="signIn">Sign In</a></h5>
			</div>
		</div>
		<div class="col-md-6">
			<div id="result" class="hide alert alert-danger">&nbsp;</div>
			<form id="registerForm" method="POST">
				<div class="form-group">
					<label for="exampleInputEmail1">Full Name</label>
					<input required type="text" class="form-control" name="fullname" id="fullname" aria-describedby="fullnameHelp" placeholder="Enter Full name">
					<small id="fullnameHelp" class="form-text text-muted">Full name.</small>
				</div>
				<div class="form-group">
					<label for="email">Email address</label>
					<input required type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email address">
					<small id="emailHelp" class="form-text text-muted">Email address for registration.</small>
				</div>
				<div class="form-group">
					<label for="phone" class="col-form-label">Phone</label>
					<input pattern="\d*" class="form-control" type="text" name="phone" id="phone" aria-describedby="phoneHelp" placeholder="Enter Contact Number" />
					<small id="phoneHelp" class="form-text text-muted">Phone accepts only digits without spaces</small>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input required type="password" class="form-control" name="password" id="password" placeholder="Password">
					<small id="passwordHelp" class="form-text text-muted">Password</small>
				</div>
				<input type="hidden" name="returnUrl" id="returnUrl" value="<?=$data['returnUrl']?>"><br />
				<button id="submit" type="submit" class="btn btn-primary">Register</button>
			</form>
		</div>
	</div>
	<div id="signInForm" class="row justify-content-center">
		<div class="col-md-12 text-center">
			<div id="signInHead">
				<h4>Sign In</h4>
				<h5>New to this place? <a class="trigger" id="signUp">Sign Up</a></h5>
			</div>
		</div>
		<div class="col-md-6">
			<!-- <h3>Login</h3> -->
			<div id="lresult" class="hide alert alert-danger">&nbsp;</div>
			<form id="loginForm" method="POST">
				<div class="form-group">
					<label for="lemail">Email</label>
					<input required type="text" class="form-control" name="lemail" id="lemail" aria-describedby="emailHelp" placeholder="Enter Email">
					<small id="emailHelp" class="form-text text-muted">Registered Email.</small>
				</div>
				<div class="form-group">
					<label for="lpassword">Password</label>
					<input required type="password" class="form-control" name="lpassword" id="lpassword" placeholder="Password">
					<small id="forgotPasswordHelp" class="text-right form-text text-muted"><a href="<?=BASE_URL?>user/resetPassword">Forgot password?</a></small>
				</div>
				<input type="hidden" name="type" id="type" value="<?=$data['type']?>">
				<input type="hidden" name="lreturnUrl" id="lreturnUrl" value="<?=$data['returnUrl']?>">
				<button id="lsubmit" type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>
