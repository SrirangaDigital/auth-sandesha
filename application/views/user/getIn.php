<script type="text/javascript">

$(document).ready(function() {

	$( ".trigger" ).on('click', function(){

		$(this).css("color", "#4682B4");

		if($(this).attr('id') == 'signIn'){

			$('#signUpForm').hide();
			$('#signInForm').show();
			$('#signUp').css("color", "#6c757d");
		}
		else {

			$('#signInForm').hide();
			$('#signUpForm').show();
			$('#signIn').css("color", "#6c757d");
		}
	});

	var getInType = '<?=$data['type']?>';
	
	if(getInType == 'in')
		$( "#signIn" ).trigger( "click" );
	else
		// Show Registration form by default
		$( "#signUp" ).trigger( "click" );


	$( "#signUpForm" ).submit(submitRegisterForm);
	$( "#signInForm" ).submit(submitLoginForm);
});

</script>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6 form">
			<div class="row gap-above">
				<div class="col-6 custom text-center">
					<h5><a class="trigger" id="signUp">Sign Up</a></h5>
				</div>
				<div class="col-6 custom text-center">
					<h5><a class="trigger" id="signIn">Sign In</a></h5>
				</div>
			</div>
			<form id="signUpForm" method="POST">
				<div id="result" class="hide alert alert-danger">&nbsp;</div>
				<div class="form-group">
					<input required type="text" class="form-control" name="fullname" id="fullname" aria-describedby="fullnameHelp" placeholder="Full name">
					<!-- <small id="fullnameHelp" class="form-text text-muted">Full name.</small> -->
				</div>
				<div class="form-group">
					<input required type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email">
					<!-- <small id="emailHelp" class="form-text text-muted">Email address for registration.</small> -->
				</div>
				<div class="form-group">
					<input pattern="\d*" class="form-control" type="text" name="phone" id="phone" aria-describedby="phoneHelp" placeholder="Contact Number" />
					<!-- <small id="phoneHelp" class="form-text text-muted">Phone accepts only digits without spaces</small> -->
				</div>
				<div class="form-group">
					<input required type="password" class="form-control" name="password" id="password" placeholder="Password">
					<!-- <small id="passwordHelp" class="form-text text-muted">Password</small> -->
				</div>
				<input type="hidden" name="returnUrl" id="returnUrl" value="<?=$data['returnUrl']?>"><br />
				<div class="row">
    				<div class="col-12 text-center mb-3">
						<button id="submit" type="submit" class="btn">Register</button>
					</div>
				</div>
			</form>
			<form id="signInForm" method="POST">
				<div id="lresult" class="hide alert alert-danger">&nbsp;</div>
				<div class="form-group">
					<!-- <label for="lemail">Email</label> -->
					<input required type="text" class="form-control" name="lemail" id="lemail" aria-describedby="emailHelp" placeholder="Email">
					<!-- <small id="emailHelp" class="form-text text-muted">Registered Email.</small> -->
				</div>
				<div class="form-group">
					<!-- <label for="lpassword">Password</label> -->
					<input required type="password" class="form-control" name="lpassword" id="lpassword" placeholder="Password">
					<small id="forgotPasswordHelp" class="text-right form-text text-muted"><a href="<?=BASE_URL?>user/resetPassword">Forgot password?</a></small>
				</div>
				<input type="hidden" name="type" id="type" value="<?=$data['type']?>">
				<input type="hidden" name="lreturnUrl" id="lreturnUrl" value="<?=$data['returnUrl']?>">
				<div class="row">
    				<div class="col-12 text-center mb-3">
						<button id="lsubmit" type="submit" class="btn">Login</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
